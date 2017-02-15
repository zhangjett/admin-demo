<?php

namespace app\modules\account\controllers;

use Yii;
use app\components\Controller;
use app\modules\account\models\PermissionForm;
use yii\web\ForbiddenHttpException;

/**
 * Permission controller for the `account` module
 */
class PermissionController extends Controller
{
    public $cssFile = [
        'icheck/green.css'
    ];

    public $jsFile = [
        'icheck/icheck.min.js'
    ];

    /**
     * 权限列表
     * @return string
     * @throws ForbiddenHttpException
     */
    public function actionIndex()
    {
        if (! Yii::$app->user->can('viewPermissionList')) {
            throw new ForbiddenHttpException('您没有权限查看权限列表！');
        }

        $auth = Yii::$app->authManager;

        $content = $this->renderPartial("__permissionList", ['permissionList' => $auth->getPermissions()]);

        return $this->render('index', [
            'content' => $content
        ]);
    }

    /**
     * 创建权限
     * @return string|\yii\web\Response
     * @throws ForbiddenHttpException
     */
    public function actionCreate()
    {
        if (! Yii::$app->user->can('createPermission')) {
            throw new ForbiddenHttpException('您没有权限创建权限！');
        }

        $model = new PermissionForm();
        $model->setScenario('create');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->create()) {
                Yii::$app->session->setFlash('createPermission', 'success');
                return $this->refresh();
            }
        }

        return $this->render('update', [
            "model" => $model,
        ]);
    }

    /**
     * 修改权限
     * @param $name
     * @return string|\yii\web\Response
     * @throws ForbiddenHttpException
     */
    public function actionUpdate($name)
    {
        $model = new PermissionForm();
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post())) {
            if (! Yii::$app->user->can('updatePermission')) {
                throw new ForbiddenHttpException('您没有权限修改权限！');
            }
            if ($model->validate() && $model->update($name)) {
                Yii::$app->session->setFlash('updatePermission', 'success');
                return $this->redirect(['//account/permission/update', 'name' => $model->name]);
            }

            return $this->render('update', [
                "model" => $model,
            ]);
        }

        if (! Yii::$app->user->can('viewPermission')) {
            throw new ForbiddenHttpException('您没有权限查看权限详情！');
        }

        $model->get($name);

        return $this->render('update', [
            "model" => $model,
        ]);
    }

    /**
     * 删除权限
     * @param $name
     * @return string|\yii\web\Response
     * @throws ForbiddenHttpException
     */
    public function actionDelete($name)
    {
        if (! Yii::$app->user->can('deletePermission')) {
            throw new ForbiddenHttpException('您没有权限删除权限！');
        }

        $model = new PermissionForm();

        if ($model->validate() && $model->delete($name)) {
            Yii::$app->session->setFlash('deletePermission', 'success');
        }

        return $this->redirect(['//account/permission/index']);
    }

    /**
     * 增加子权限
     * @param $name
     * @return string|\yii\web\Response
     * @throws ForbiddenHttpException
     */
    public function actionAddChild($name)
    {
        $model = new PermissionForm();

        if ($model->load(Yii::$app->request->post())) {
            if (! Yii::$app->user->can('addChildPermission')) {
                throw new ForbiddenHttpException('您没有权限添加子权限！');
            }
            if ($model->validate() && $model->updateChild($name)) {
                Yii::$app->session->setFlash('updateChild', 'success');

                return $this->renderPartial('addChild', [
                    "model" => $model,
                ]);
            }
        }

        if (! Yii::$app->user->can('viewPermission')) {
            throw new ForbiddenHttpException('您没有权限查看权限详情！');
        }

        $model->get($name);

        return $this->renderPartial('addChild', [
            "model" => $model,
        ]);
    }
}