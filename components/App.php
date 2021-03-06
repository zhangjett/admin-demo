<?php
namespace app\components;

use Yii;
use yii\base\Object;

class App extends Object
{
    public function init()
    {
        $cache = Yii::$app->cache;
        $appModule = $cache->get("appModule");
        $appModuleController = $cache->get("appModuleController");
        $appModuleControllerAction = $cache->get("appModuleControllerAction");

        if (($appModule === false) || ($appModuleController === false) || ($appModuleControllerAction === false)) {

            $moduleControllerList = [];
            $moduleControllerActionList = [];

            $moduleNameSpace = 'app\modules';
            $modules = array_diff(scandir(Yii::getAlias('@'.str_replace('\\', '/', $moduleNameSpace))), ['..', '.']);
            $moduleList = array_combine(array_values($modules),array_values($modules));

            if (is_array($modules) && (count($modules) > 0)) {
                foreach ($modules as $module) {
                    $controllerNameSpace = 'app\modules\\'.$module.'\controllers';
                    $files = array_diff(scandir(Yii::getAlias('@'.str_replace('\\', '/', $controllerNameSpace))), ['..', '.']);
                    if (is_array($files) && count($files) > 0) {
                        foreach ($files as $file) {
                            list($fileName, $ext) = explode(".", $file);
                            $fileNameWithoutController = strtolower(str_replace('Controller', '', $fileName));
                            $moduleControllerList[$module][$fileNameWithoutController] = $fileNameWithoutController;
                            $controller = $controllerNameSpace.'\\'.$fileName;
                            $methods = (new \ReflectionClass($controller))->getMethods();
                            if (is_array($methods) && count($methods) > 0) {
                                foreach ($methods as $method) {
                                    if (($method->class == $controller) && (strpos($method->name, 'action') !== false)) {
                                        $actionWithoutAction = strtolower(str_replace('action', '', $method->name));
                                        $moduleControllerActionList[$module.'-'.$fileNameWithoutController][$actionWithoutAction] = $actionWithoutAction;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $cache->set('appModule', json_encode($moduleList), 7*24*60*60);
            $cache->set('appModuleController', json_encode($moduleControllerList), 7*24*60*60);
            $cache->set('appModuleControllerAction', json_encode($moduleControllerActionList), 7*24*60*60);
        }
    }

    public function getAppModule()
    {
        $cache = Yii::$app->cache;
        return json_decode($cache->get("appModule"), true);
    }

    public function getAppModuleController()
    {
        $cache = Yii::$app->cache;

        return json_decode($cache->get("appModuleController"), true);
    }

    public function getAppModuleControllerAction()
    {
        $cache = Yii::$app->cache;

        return json_decode($cache->get("appModuleControllerAction"), true);
    }
}
