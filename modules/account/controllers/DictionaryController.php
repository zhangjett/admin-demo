<?php

namespace app\modules\account\controllers;

use Yii;
use app\components\Controller;
use app\modules\account\models\DictionaryTypeForm;
use app\modules\account\models\DictionaryTypeSearchForm;
use yii\helpers\Json;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
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
     * 字典类型列表
     * @return string
     * @throws ForbiddenHttpException
     */
    public function actionIndex()
    {
        if (! Yii::$app->user->can('viewDictionaryTypeList')) {
            throw new ForbiddenHttpException('您没有权限查看字典类型列表！');
        }

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
     * @throws ForbiddenHttpException
     */
    public function actionCreate()
    {
        if (! Yii::$app->user->can('createDictionaryType')) {
            throw new ForbiddenHttpException('您没有权限创建字典类型！');
        }

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
     * 修改字典类型
     * @param $id
     * @return int
     * @throws ForbiddenHttpException
     */
    public function actionUpdate($id)
    {
        $model = new DictionaryTypeForm();
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post())) {
            if (! Yii::$app->user->can('updateDictionaryType')) {
                throw new ForbiddenHttpException('您没有权限修改字典类型！');
            }
            if ($model->validate() && $model->update()) {
                Yii::$app->session->setFlash('updateDictionaryType','success');
                echo $this->renderPartial("update", ['model' => $model]);
                Yii::$app->end();
            }
            echo $this->renderPartial("update", ['model' => $model]);
            Yii::$app->end();
        }

        if (! Yii::$app->user->can('viewDictionaryType')) {
            throw new ForbiddenHttpException('您没有权限查看字典类型详情！');
        }

        $model->get($id);

        return $this->renderPartial("update", ['model' => $model]);
    }
}