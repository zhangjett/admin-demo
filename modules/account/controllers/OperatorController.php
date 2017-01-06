<?php

namespace app\modules\account\controllers;

use Yii;
use app\components\Controller;
use app\modules\account\models\OperatorForm;
use app\modules\account\models\OperatorSearchForm;
use yii\filters\AccessControl;

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
//                        'roles' => [Yii::$app->controller->action->uniqueId],
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $model = new OperatorSearchForm();

        if (Yii::$app->request->isAjax) {
            $model->load(Yii::$app->request->post());
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
     */
    public function actionCreate()
    {
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
     */
    public function actionUpdate($id)
    {
        $model = new OperatorForm();
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->update($id)) {
                Yii::$app->session->setFlash('updateOperator','success');
                return $this->refresh();
            }
            return $this->render('update', [
                "model" => $model,
            ]);
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
     */
    public function actionAssign($id)
    {
        $model = new OperatorForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->assign($id)) {
                Yii::$app->session->setFlash('assign', 'success');

                return $this->renderPartial('assign', [
                    "model" => $model,
                ]);
            }
        }

        $model->get($id);

        return $this->renderPartial('assign', [
            "model" => $model,
        ]);
    }
}
