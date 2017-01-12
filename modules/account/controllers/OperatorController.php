<?php

namespace app\modules\account\controllers;

use Yii;
use app\components\Controller;
use app\modules\account\models\OperatorForm;
use app\modules\account\models\OperatorSearchForm;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * Operator controller for the `account` module
 */
class OperatorController extends Controller
{
    public $cssFile = [
        'icheck/green.css'
    ];

    public $jsFile = [
        'icheck/icheck.min.js'
    ];

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    /**
     * 后台用户列表
     * @return string
     * @throws ForbiddenHttpException
     */
    public function actionIndex()
    {
        if (! Yii::$app->user->can('viewOperatorList')) {
            throw new ForbiddenHttpException('您没有权限查看后台用户列表！');
        }

        $model = new OperatorSearchForm();

        if (Yii::$app->request->isAjax) {
            $model->load(Yii::$app->request->get());
            $result = $model->search();
            echo $this->renderPartial("__operatorList", ['operatorList' => $result['rows'],'pages' => $result['pages']]);
            Yii::$app->end();
        } else {
            $model->status = 1;
            $result = $model->search();
            $content = $this->renderPartial("__operatorList", ['operatorList' => $result['rows'],'pages' => $result['pages']]);
        }

        return $this->render('index', [
            "content" => $content,
            'model' => $model
        ]);
    }

    /**
     * 创建后台用户
     * @return string|\yii\web\Response
     * @throws ForbiddenHttpException
     */
    public function actionCreate()
    {
        if (! Yii::$app->user->can('createOperator')) {
            throw new ForbiddenHttpException('您没有权限创建后台用户！');
        }

        $model = new OperatorForm();
        $model->setScenario('create');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->create()) {
                Yii::$app->session->setFlash('createOperator', 'success');
                return $this->refresh();
            }
        }

        return $this->render('update', [
            "model" => $model,
        ]);
    }

    /**
     * 修改后台用户
     * @param $id
     * @return string|\yii\web\Response
     * @throws ForbiddenHttpException
     */
    public function actionUpdate($id)
    {
        $model = new OperatorForm();
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post())) {
            if (! Yii::$app->user->can('updateOperatorProfile', ['operatorId' => $id])) {
                throw new ForbiddenHttpException('您没有权限修改后台用户信息！');
            }
            if ($model->validate() && $model->update($id)) {
                Yii::$app->session->setFlash('updateOperator', 'success');
                return $this->refresh();
            }
            return $this->render('update', [
                "model" => $model,
            ]);
        }

        if (! Yii::$app->user->can('viewOperatorProfile')) {
            throw new ForbiddenHttpException('您没有权限查看后台用户信息！');
        }

        $model->get($id);

        return $this->render('update', [
            "model" => $model,
        ]);
    }


    /**
     * 分配角色
     * @param $id
     * @return string
     * @throws ForbiddenHttpException
     */
    public function actionAssign($id)
    {
        $model = new OperatorForm();

        if ($model->load(Yii::$app->request->post())) {
            if (! Yii::$app->user->can('assignOperator')) {
                throw new ForbiddenHttpException('您没有权限给后台用户分配角色！');
            }
            if ($model->validate() && $model->assign($id)) {
                Yii::$app->session->setFlash('assign', 'success');

                return $this->renderPartial('assign', [
                    "model" => $model,
                ]);
            }
        }

        if (! Yii::$app->user->can('viewOperatorProfile')) {
            throw new ForbiddenHttpException('您没有权限查看后台用户信息！');
        }

        $model->get($id);

        return $this->renderPartial('assign', [
            "model" => $model,
        ]);
    }
}
