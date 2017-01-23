<?php

namespace app\modules\account\controllers;

use Yii;
use app\components\Controller;
use app\modules\account\models\DictionaryItemForm;
use app\modules\account\models\DictionaryItemSearchForm;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

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

    /**
     * 字典列表
     * @param null $typeId
     * @return string
     * @throws ForbiddenHttpException
     */
    public function actionIndex($typeId = null)
    {
        if (! Yii::$app->user->can('viewDictionaryItemList')) {
            throw new ForbiddenHttpException('您没有权限查看字典列表！');
        }

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

    /**
     * 创建字典
     * @return int
     * @throws ForbiddenHttpException
     */
    public function actionCreate()
    {
        if (! Yii::$app->user->can('createDictionaryItem')) {
            throw new ForbiddenHttpException('您没有权限创建字典！');
        }

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

    /**
     * 修改字典
     * @param $id
     * @return int
     * @throws ForbiddenHttpException
     */
    public function actionUpdate($id)
    {
        $model = new DictionaryItemForm();
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post())) {
            if (! Yii::$app->user->can('updateDictionaryItem')) {
                throw new ForbiddenHttpException('您没有权限修改字典！');
            }
            if ($model->validate() && $model->update()) {
                Yii::$app->session->setFlash('updateDictionaryItem','success');
                echo $this->renderPartial("update", ['model' => $model]);
                Yii::$app->end();
            }
            echo $this->renderPartial("update", ['model' => $model]);
            Yii::$app->end();
        }

        if (! Yii::$app->user->can('viewDictionaryItem')) {
            throw new ForbiddenHttpException('您没有权限查看字典详情！');
        }

        $model->get($id);

        echo $this->renderPartial("update", ['model' => $model]);
        Yii::$app->end();
        
        return 0;
    }
}