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

    /**
     * 创建角色
     * @return string|\yii\web\Response
     */
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
     * 删除角色
     * @param $name
     * @return string|\yii\web\Response
     */
    public function actionDelete($name)
    {
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
     */
    public function actionUpdate($name)
    {
        $model = new RoleForm();
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->update($name)) {
                Yii::$app->session->setFlash('updateRole','success');
                return $this->redirect(['//account/role/update', 'name' => $model->name]);
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