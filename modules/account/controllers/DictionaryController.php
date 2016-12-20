<?php

namespace app\modules\account\controllers;

use Yii;
use app\components\Controller;
use app\modules\account\models\DictionaryTypeForm;
use app\modules\account\models\DictionaryTypeSearchForm;
use yii\helpers\Json;

/**
 * Dictionary controller for the `account` module
 */
class DictionaryController extends Controller
{
    public $cssFile = [
        'icheck/green.css'
    ];

    public $jsFile = [
        'icheck/icheck.min.js'
    ];

    public function actionIndex()
    {
        $model = new DictionaryTypeSearchForm();

        if (Yii::$app->request->isAjax) {
            $model->load(Yii::$app->request->post());
            $result = $model->search();
            echo $this->renderPartial("__dictionaryTypeList", ['dictionaryTypeList' => $result['rows'],'pages' => $result['pages']]);
            Yii::$app->end();
        } else {
            $model->status = 1;
            $result = $model->search();
            $content = $this->renderPartial("__dictionaryTypeList", ['dictionaryTypeList' => $result['rows'],'pages' => $result['pages']]);
        }

        return $this->render('index', [
            "content" => $content,
            'model' => $model
        ]);
    }

    public function actionCreate()
    {
        $model = new MenuForm();
        $model->setScenario('create');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->create()) {
                Yii::$app->session->setFlash('createMenu', 'success');
                return $this->refresh();
            }
        }

        return $this->render('update', [
            "model" => $model,
        ]);
    }

    /**
     * 删除菜单
     * @return string
     */
    public function actionDelete()
    {
        $model = new MenuForm();
        $permissionId = Yii::$app->request->post("menuId");

        if (is_array($permissionId) && count($permissionId)>0 && $model->delete($permissionId)) {
            return Json::encode(['status'=>'ok','msg'=>'删除成功！']);
        }

        return Json::encode(['status'=>'error','msg'=>'删除失败！']);
    }

    public function actionUpdate()
    {
        $model = new MenuForm();
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->update()) {
                Yii::$app->session->setFlash('updateMenu','success');
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