<?php

namespace app\modules\account\controllers;

use Yii;
use app\components\Controller;
use app\modules\account\models\DictionaryTypeForm;
use app\modules\account\models\DictionaryTypeSearchForm;
use yii\helpers\Json;
use yii\filters\AccessControl;
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

    /**
     * 字典类型类别
     * @return string
     */
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
            "content" => $content
        ]);
    }

    /**
     * 创建字典类型
     * @return int
     */
    public function actionCreate()
    {
        $model = new DictionaryTypeForm();
        $model->setScenario('create');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->create()) {
                Yii::$app->session->setFlash('createDictionaryType', 'success');
                echo $this->renderPartial("update", ['model' => $model]);
                Yii::$app->end();
            }
        }

        echo $this->renderPartial("update", ['model' => $model]);
        Yii::$app->end();

        return 0;
    }

    /**
     * 删除字典类型
     * @return string
     */
    public function actionDelete()
    {
        $model = new DictionaryTypeForm();
        $permissionId = Yii::$app->request->post("menuId");

        if (is_array($permissionId) && count($permissionId)>0 && $model->delete($permissionId)) {
            return Json::encode(['status'=>'ok','msg'=>'删除成功！']);
        }

        return Json::encode(['status'=>'error','msg'=>'删除失败！']);
    }

    /**
     * 修改字典类型
     * @param $id
     * @return int
     */
    public function actionUpdate($id)
    {
        $model = new DictionaryTypeForm();
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->update()) {
                Yii::$app->session->setFlash('updateDictionaryType','success');
                echo $this->renderPartial("update", ['model' => $model]);
                Yii::$app->end();
            }
            echo $this->renderPartial("update", ['model' => $model]);
            Yii::$app->end();
        }

        $model->get($id);

        echo $this->renderPartial("update", ['model' => $model]);
        Yii::$app->end();

        return 0;
    }
}