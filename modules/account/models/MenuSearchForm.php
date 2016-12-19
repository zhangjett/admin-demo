<?php

namespace app\modules\account\models;

use yii;
use yii\base\Model;
use yii\data\Pagination;
use yii\db\Query;

/**
 * MenuSearchForm.
 */
class MenuSearchForm extends Model
{
    public $status;
    public $filter;
    public $pageSize = 5;

    public function search()
    {

        $condition = [];
        $condition['auth_item.type'] = 2;

        $query = new Query();
        $count = $query
            ->from('auth_item')
            ->where($condition)
            ->count();

        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $this->pageSize]);

        $rows = $query
            ->select(['item_id AS menuId', 'auth_item.name', 'description', 'group.name AS groupName', 'status', 'update_time AS updateTime'])
            ->from('auth_item')
            ->leftJoin('group', 'group.group_id = auth_item.group_id')
            ->where($condition)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return ["rows" => $rows,"pages" => $pages];
    }
    }
