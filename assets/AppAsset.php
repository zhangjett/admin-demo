<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/font-awesome.min.css',
        'css/AdminLTE.min.css',
        'css/skin-green-light.min.css',
        'css/pace/pace.min.css',
        'css/app.css'
    ];
    public $js = [
        'js/jquery.slimscroll.min.js',
        'js/AdminLTE.min.js',
        'js/layer/layer.js',
        'js/tool.js',
        'js/iconfont/iconfont.js',
        'js/pace/pace.min.js',
        'js/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    //定义按需加载CSS方法，注意加载顺序在最后
    public static function addCss(View $view, $cssFile) {
        if(is_array($cssFile)&&count($cssFile)>0){
            foreach($cssFile as $css){
                $view->registerCssFile('@web/css/'.$css, [AppAsset::className(), 'depends' => 'app\assets\AppAsset']);
            }
        }
    }

    //定义按需加载JS方法，注意加载顺序在最后
    public static function addScript(View $view, $jsFile) {
        if(is_array($jsFile)&&count($jsFile)>0){
            foreach($jsFile as $js){
                $view->registerJsFile('@web/js/'.$js, [AppAsset::className(), 'depends' => 'app\assets\AppAsset']);
            }
        }
    }
}
