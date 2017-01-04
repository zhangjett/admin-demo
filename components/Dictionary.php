<?php
namespace app\components;

use Yii;
use yii\base\Object;
use yii\db\Query;

class Dictionary extends Object
{
    /**
     * 获取组别
     * @param int $type
     * @return array
     */
    public static function getDictionaryItemByType($type = 1)
    {
        $rows = (new Query())
            ->select(['name'])
            ->from('dictionary_item')
            ->where('type_id = :type_id')
            ->addParams([':type_id' => $type])
            ->indexBy('value')
            ->column();

        return $rows;
    }

    public static function getDictionaryTypeIdByCode($code = '')
    {
        $id = (new Query())
            ->select(['type_id AS typeId'])
            ->from('dictionary_type')
            ->where('code = :code')
            ->addParams([':code' => $code])
            ->scalar();

        return $id;
    }

    /**
     * 获取菜单
     * @param $group
     * @param $type
     * @return array
     */
    public static function getAuthItemByGroup($group, $type = 1)
    {
        $rows = (new Query())
            ->select(['name'])
            ->from('auth_item')
            ->where('item_group = :group')
            ->andWhere('type = :type')
            ->addParams([':group' => $group, ':type' => $type])
            ->indexBy('item_id')
            ->column();

        return $rows;
    }

    /**
     * 获取权限列表
     * @return array
     */
    public static function getPermissions()
    {
        $auth = Yii::$app->authManager;

        $rows = [];
        foreach ($auth->getPermissions() as $index => $permission) {
            $rows[$index] = $permission->description;
        }

        var_dump($rows);exit();

        return $rows;
    }
    /**
     * 获取规则列表
     * @return array
     */
    public static function getRules()
    {
        $auth = Yii::$app->authManager;

        $rows = [];
        foreach ($auth->getRules() as $index => $rule) {
            $rows[$index] = $index;
        }

        return $rows;
    }
}
