<?php
namespace app\components;

use Yii;
use yii\base\Object;
use yii\db\Query;

class Dictionary extends Object
{
    public function getGroup()
    {
        $rows = (new Query())
            ->select(['name'])
            ->from('group')
            ->indexBy('group_id')
            ->column();

        return $rows;
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
