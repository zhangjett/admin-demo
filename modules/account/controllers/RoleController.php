<?php

namespace app\modules\account\controllers;

use Yii;
use app\components\Controller;
use app\modules\account\models\RoleForm;
use yii\web\ForbiddenHttpException;

/**
 * Role controller for the `account` module
 */
class RoleController extends Controller
{
    public $cssFile = [
        'icheck/green.css'
    ];

    public $jsFile = [
        'icheck/icheck.min.js'
    ];

    /**
     * 角色列表
     * @return string
     * @throws ForbiddenHttpException
     */
    public function actionIndex()
    {
        if (! Yii::$app->user->can('viewRoleList')) {
            throw new ForbiddenHttpException('您没有权限查看角色列表！');
        }

        $auth = Yii::$app->authManager;

        $content = $this->renderPartial("__roleList", ['roleList' => $auth->getRoles()]);

        return $this->render('index', [
            'content' => $content
        ]);
    }

    /**
     * 创建角色
     * @return string|\yii\web\Response
     * @throws ForbiddenHttpException
     */
    public function actionCreate()
    {
        if (! Yii::$app->user->can('createRole')) {
            throw new ForbiddenHttpException('您没有权限创建角色！');
        }

        $model = new RoleForm();
        $model->setScenario('create');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->create()) {
                Yii::$app->session->setFlash('createRole', 'success');
                return $this->refresh();
            }
        }

        return $this->render('update', [
            "model" => $model,
        ]);
    }

    /**
     * 删除角色
     * @param $name
     * @return string|\yii\web\Response
     * @throws ForbiddenHttpException
     */
    public function actionDelete($name)
    {
        if (! Yii::$app->user->can('deleteRole')) {
            throw new ForbiddenHttpException('您没有权限删除角色！');
        }

        $model = new RoleForm();

        if ($model->validate() && $model->delete($name)) {
            Yii::$app->session->setFlash('deleteRole', 'success');
        }

        return $this->redirect(['//account/role/index']);
    }

    /**
     * 修改角色
     * @param $name
     * @return string|\yii\web\Response
     * @throws ForbiddenHttpException
     */
    public function actionUpdate($name)
    {
        $model = new RoleForm();
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post())) {
            if (! Yii::$app->user->can('updateRole')) {
                throw new ForbiddenHttpException('您没有权限修改角色！');
            }
            if ($model->validate() && $model->update($name)) {
                Yii::$app->session->setFlash('updateRole','success');
                return $this->redirect(['//account/role/update', 'name' => $model->name]);
            }
            return $this->render('update', [
                "model" => $model,
            ]);
        }

        if (! Yii::$app->user->can('viewRole')) {
            throw new ForbiddenHttpException('您没有权限查看角色详情！');
        }

        $model->get($name);

        return $this->render('update', [
            "model" => $model,
        ]);
    }

    /**
     * 增加子权限/角色
     * @param $name
     * @return string|\yii\web\Response
     * @throws ForbiddenHttpException
     */
    public function actionAddChild($name)
    {
        $model = new RoleForm();

        if ($model->load(Yii::$app->request->post())) {
            if (! Yii::$app->user->can('addPermissionOrChildRole')) {
                throw new ForbiddenHttpException('您没有权限添加权限或着子角色！');
            }
            if ($model->validate() && $model->updateChild($name)) {
                Yii::$app->session->setFlash('updateChild', 'success');

                return $this->renderPartial('addChild', [
                    "model" => $model,
                ]);
            }
        }

        if (! Yii::$app->user->can('viewRole')) {
            throw new ForbiddenHttpException('您没有权限查看角色详情！');
        }

        $model->get($name);

        return $this->renderPartial('addChild', [
            "model" => $model,
        ]);
    }
}