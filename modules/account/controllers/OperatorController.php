<?php

namespace app\modules\account\controllers;

use Yii;
use app\components\Controller;
use app\modules\account\models\OperatorSearchForm;

/**
 * Operator controller for the `account` module
 */
class OperatorController extends Controller
{
    public $cssFile = [
        'icheck/green.css'
    ];

    public $jsFile = [
        'icheck/icheck.min.js'
    ];

    public function actionIndex()
    {
        $model = new OperatorSearchForm();

        if (Yii::$app->request->isAjax){
            $model->load(Yii::$app->request->post());
            $result = $model->search();
            echo $this->renderPartial("__operatorList", ['operatorList' => $result['rows'],'pages' => $result['pages']]);
            Yii::$app->end();
        } else {
            $model->status = 1;
            $result = $model->search();
            $content = $this->renderPartial("__operatorList", ['operatorList' => $result['rows'],'pages' => $result['pages']]);
        }

        return $this->render('index', [
            "content" => $content,
            'model' => $model
        ]);
    }
}
