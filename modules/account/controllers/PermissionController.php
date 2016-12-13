<?php

namespace app\modules\account\controllers;

use Yii;
use app\components\Controller;
use app\components\Permission;
use app\modules\account\models\PermissionForm;
use app\modules\account\models\PermissionSearchForm;

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
        $model = new PermissionSearchForm();

        if (Yii::$app->request->isAjax) {
            $model->load(Yii::$app->request->post());
            $result = $model->search();
            echo $this->renderPartial("__permissionList", ['permissionList' => $result['rows'],'pages' => $result['pages']]);
            Yii::$app->end();
        } else {
            $model->status = 1;
            $result = $model->search();
            $content = $this->renderPartial("__permissionList", ['permissionList' => $result['rows'],'pages' => $result['pages']]);
        }

        return $this->render('index', [
            "content" => $content,
            'model' => $model
        ]);
    }

    public function actionCreate()
    {
        $component = new Permission();
        $component->getPermissionList();

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
}