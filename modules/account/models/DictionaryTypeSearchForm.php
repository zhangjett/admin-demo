<?php

namespace app\modules\account\models;

use yii;
use yii\base\Model;
use yii\data\Pagination;
use yii\db\Query;

/**
 * DictionaryTypeSearchForm.
 */
class DictionaryTypeSearchForm extends Model
{
    public $status;
    public $filter;
    public $pageSize = 5;

    public function search()
    {
        $condition = [];

        $query = new Query();
        $count = $query
            ->from('dictionary_type')
            ->where($condition)
            ->count();

        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $this->pageSize]);

        $rows = $query
            ->select(['type_id AS typeId', 'code', 'name', 'update_time AS updateTime'])
            ->from('dictionary_type')
            ->where($condition)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return ["rows" => $rows,"pages" => $pages];
    }
}
