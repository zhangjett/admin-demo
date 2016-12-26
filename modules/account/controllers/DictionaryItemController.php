<?php

namespace app\modules\account\controllers;

use Yii;
use app\components\Controller;
use app\modules\account\models\DictionaryItemForm;
use app\modules\account\models\DictionaryItemSearchForm;
use yii\helpers\Json;

/**
 * DictionaryItem controller for the `account` module
 */
class DictionaryItemController extends Controller
{
    public $cssFile = [
        'icheck/green.css'
    ];

    public $jsFile = [
        'icheck/icheck.min.js'
    ];

    public function actionIndex($typeId = null)
    {
        $model = new DictionaryItemSearchForm();

        if (Yii::$app->request->isAjax) {
            $model->load(Yii::$app->request->post());
            $model->typeId = $typeId;
            $result = $model->search();
            echo $this->renderPartial("__dictionaryItemList", ['dictionaryItemList' => $result['rows'],'pages' => $result['pages']]);
            Yii::$app->end();
        } else {
            $model->typeId = $typeId;
            $result = $model->search();
            $content = $this->renderPartial("__dictionaryItemList", ['dictionaryItemList' => $result['rows'],'pages' => $result['pages']]);
        }

        return $this->render('index', [
            "content" => $content,
            'model' => $model
        ]);
    }

    public function actionCreate()
    {
        $model = new DictionaryItemForm();
        $model->setScenario('create');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->create()) {
                Yii::$app->session->setFlash('createDictionaryItem', 'success');
                echo $this->renderPartial("update", ['model' => $model]);
                Yii::$app->end();
            }
        }

        echo $this->renderPartial("update", ['model' => $model]);
        Yii::$app->end();

        return 0;
    }


    public function actionUpdate($id)
    {
        $model = new DictionaryItemForm();
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->update()) {
                Yii::$app->session->setFlash('updateDictionaryItem','success');
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