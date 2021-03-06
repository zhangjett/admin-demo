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

        $count = (new Query())
            ->from('dictionary_type')
            ->where($condition)
            ->count();

        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $this->pageSize]);

        $rows = (new Query())
            ->select(['type_id AS typeId', 'code', 'name', 'created_at AS createdAt', 'updated_at AS updatedAt'])
            ->from('dictionary_type')
            ->where($condition)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return ["rows" => $rows,"pages" => $pages];
    }
}
