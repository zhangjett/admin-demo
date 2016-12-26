<?php

namespace app\modules\account\models;

use yii;
use yii\base\Model;
use yii\data\Pagination;
use yii\db\Query;

/**
 * RoleSearchForm.
 */
class RoleSearchForm extends Model
{
    public $status;
    public $filter;
    public $pageSize = 5;

    public function search()
    {
        $condition = [];
        $condition['auth_item.type'] = 1;

        $query = new Query();
        $count = $query
            ->from('auth_item')
            ->where($condition)
            ->count();
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $this->pageSize]);

        $rows = $query
            ->select(['auth_item.item_id AS roleId', 'auth_item.name', 'description', 'dictionary_item.name AS groupName'
                , 'auth_item.status', 'auth_item.update_time AS updateTime'])
            ->from('auth_item')
            ->leftJoin('dictionary_item', 'dictionary_item.type_id = 4 AND dictionary_item.code = auth_item.item_group')
            ->where($condition)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return ["rows" => $rows,"pages" => $pages];
    }
}