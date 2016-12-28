<?php
namespace app\components;

use yii\rbac\CheckAccessInterface;

class CheckAccess implements CheckAccessInterface
{
    public function checkAccess($userId, $permissionName, $params = []){
        var_dump($userId);exit();
        return true;
    }
}
