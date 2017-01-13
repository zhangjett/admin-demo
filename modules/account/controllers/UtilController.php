<?php

namespace app\modules\account\controllers;

use Yii;
use app\components\Controller;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * Util controller for the `account` module
 */
class UtilController extends Controller
{
    /**
     * 上传
     * @return string
     * @throws ForbiddenHttpException
     */
    public function actionUpload()
    {
        $file = UploadedFile::getInstanceByName("file");
        $file->saveAs(Yii::$app->basePath.'/uploads/'.$file->baseName.'.' .$file->extension);;
        echo json_encode(['success' => true]);
        exit();
    }
}
