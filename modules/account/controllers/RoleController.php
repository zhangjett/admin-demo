<?php

namespace app\modules\account\controllers;

use Yii;
use app\components\Controller;
use app\modules\account\models\RoleForm;
use app\modules\account\models\RoleSearchForm;
use yii\helpers\Json;

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
     */
    public function actionIndex()
    {
        $auth = Yii::$app->authManager;

        $content = $this->renderPartial("__roleList", ['roleList' => $auth->getRoles()]);

        return $this->render('index', [
            'content' => $content
        ]);
    }

    public function actionCreate()
    {
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
     * 删除权限
     * @return string
     */
    public function actionDelete()
    {
        $model = new RoleForm();
        $permissionId = Yii::$app->request->post("roleId");

        if (is_array($permissionId) && count($permissionId)>0 && $model->delete($permissionId)) {
            return Json::encode(['status'=>'ok','msg'=>'删除成功！']);
        }

        return Json::encode(['status'=>'error','msg'=>'删除失败！']);
    }

    public function actionUpdate()
    {
        $model = new RoleForm();
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->update()) {
                Yii::$app->session->setFlash('updateRole','success');
                return $this->refresh();
            }
            return $this->render('update', [
                "model" => $model,
            ]);
        }

        $model->get(Yii::$app->request->get("id"));

        return $this->render('update', [
            "model" => $model,
        ]);
    }
}