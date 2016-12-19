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
    public function getGroup($type = 1)
    {
        $rows = (new Query())
            ->select(['name'])
            ->from('group')
            ->where('type = :type')
            ->addParams([':type' => $type])
            ->indexBy('group_id')
            ->column();

        return $rows;
    }

    /**
     * 获取菜单
     * @param $groupId
     * @return array
     */
    public function getMenuByGroup($groupId)
    {
        $rows = (new Query())
            ->select(['name'])
            ->from('auth_item')
            ->where('group_id = :group_id')
            ->addParams([':group_id' => $groupId])
            ->indexBy('item_id')
            ->column();

        return $rows;
    }
}
