<?php
namespace app\components;

use Yii;
use yii\base\Object;

class Permission extends Object
{
    public function getPermissionList()
    {
        $moduleNameSpace = 'app\modules';
        $modules = array_diff(scandir(Yii::getAlias('@'.str_replace('\\', '/', $moduleNameSpace))), ['..', '.']);
        if (is_array($modules) && count($modules) > 0) {
            foreach ($modules as $module) {
                    $controllerNameSpace = 'app\modules\\'.$module.'\controllers';
                    $files = array_diff(scandir(Yii::getAlias('@'.str_replace('\\', '/', $controllerNameSpace))), ['..', '.']);
                    if (is_array($files) && count($files) > 0) {
                        foreach ($files as $file) {
                            list($fileName, $ext) = explode(".", $file);
                            $controllerName = $controllerNameSpace.'\\'.$fileName;
                            $methods = (new \ReflectionClass($controllerName))->getMethods();
                            if (is_array($methods) && count($methods) > 0) {
                                foreach ($methods as $method) {
                                    if (($method->class == $controllerName) && (strpos($method->name, 'action') !== false)) {
                                        print_r($method);
                                    }
                                }
                            }

                        }
                    }

            }
        }

//        $className = $modules['account']->controllerNamespace;
//
//
//        $class = $modules['account']->controllerNamespace.'\\'.'OperatorController';
//        $class = new \ReflectionClass($class);
//        $properties = $class->getMethods();
////        print_r($files);exit;
//        foreach ($files as $index => $file) {
//            if(! in_array($file, ['.', '..'])) {
//
////                print_r(get_class_methods(new ('\\'.$modules['account']->controllerNamespace.'\\'.'DefaultController')));
////                print_r(Yii::getAlias('@' . str_replace('\\', '/', $className).DIRECTORY_SEPARATOR.$file));
//            }
//
////            print_r(($modules['account']->controllerNamespace.DIRECTORY_SEPARATOR.$file)).PHP_EOL;
//        }
        exit;
    }
}
