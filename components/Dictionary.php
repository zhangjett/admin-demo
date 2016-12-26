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
    public function getDictionaryItemByType($type = 1)
    {
        $rows = (new Query())
            ->select(['name'])
            ->from('dictionary_item')
            ->where('type_id = :type_id')
            ->addParams([':type_id' => $type])
            ->indexBy('code')
            ->column();

        return $rows;
    }

    /**
     * 获取菜单
     * @param $group
     * @param $type
     * @return array
     */
    public function getAuthItemByGroup($group, $type = 1)
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
}
