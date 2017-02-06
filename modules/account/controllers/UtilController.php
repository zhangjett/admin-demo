<?php

namespace app\modules\account\controllers;

use Yii;
use app\components\Controller;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\validators\FileValidator;
use yii\base\Event;
use yii\web\Response;
use yii\imagine\Image;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use yii\web\BadRequestHttpException;

/**
 * Util controller for the `account` module
 */
class UtilController extends Controller
{

    /**
     * 上传图片
     * @return mixed
     * @throws BadRequestHttpException
     * @throws ForbiddenHttpException
     */
    public function actionUpload()
    {
        Event::on(Response::className(), Response::EVENT_BEFORE_SEND, function ($event) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $response = $event->sender;
            if ($response->data !== null) {
                Yii::$app->response->data = [
                    'success' => $response->isSuccessful,
                    'data' => $response->data,
                    'error' => $response->data
                ];
                Yii::$app->response->statusCode = 200;
            }
        });

        if (! Yii::$app->user->can('upload')) {
            throw new ForbiddenHttpException('您没有权限上传文件！');
        }

        $file = UploadedFile::getInstanceByName("file");

        $validator = new FileValidator([
            'extensions' => ['jpeg', 'jpg', 'txt', 'png']
        ]);

        $error = '';
        $filePath = Yii::$app->basePath.'/uploads/'.$file->baseName.'.' .$file->extension;
        if ($file&&$validator->validate($file, $error)) {
            $file->saveAs($filePath);
        } else {
            throw new BadRequestHttpException('文件上传失败！');
        }

        $thumbnailFilePath = Yii::$app->basePath.'/uploads/thumbnail-'.$file->baseName.'.' .$file->extension;
        Image::thumbnail($filePath, 120, 120)->save($thumbnailFilePath, ['quality' => 100]);

        $auth = new Auth(Yii::$app->params['qiNiu']['accessKey'], Yii::$app->params['qiNiu']['secretKey']);

        $bucket = 'avatar';

        $token = $auth->uploadToken($bucket);

        $key = null;

        $uploadMgr = new UploadManager();

        list($ret, $err) = $uploadMgr->putFile($token, $key, $thumbnailFilePath);
        if ($err !== null) {
            throw new BadRequestHttpException('文件上传失败！');
        } else {
            $ret['url'] = Yii::$app->params['qiNiu']['bucket']['avatar']['domain'].'/'.$ret['key'];
        }

        return $ret;
    }
}
