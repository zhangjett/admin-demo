<?php

namespace app\modules\account\controllers;

use Yii;
use app\components\Controller;
use app\modules\account\models\PermissionForm;
use app\modules\account\models\MenuSearchForm;
use yii\helpers\Json;

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

    public function actionIndex()
    {
        $auth = Yii::$app->authManager;

        $content = $this->renderPartial("__permissionList", ['permissionList' => $auth->getPermissions()]);

        return $this->render('index', [
            'content' => $content
        ]);
    }

    /**
     * 创建权限
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
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
     *
     * @param $name
     * @return string|\yii\web\Response
     */
    public function actionUpdate($name)
    {
        $model = new PermissionForm();
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->update($name)) {
                Yii::$app->session->setFlash('updatePermission','success');
                return $this->redirect(['//account/permission/update', 'name' => $model->name]);
            }
            return $this->render('update', [
                "model" => $model,
            ]);
        }

        $model->get($name);

        return $this->render('update', [
            "model" => $model,
        ]);
    }
}