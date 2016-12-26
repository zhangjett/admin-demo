<?php

namespace app\modules\account\models;

use yii;
use yii\base\Model;
use yii\data\Pagination;
use yii\db\Query;

/**
 * DictionaryItemSearchForm.
 */
class DictionaryItemSearchForm extends Model
{
    public $typeId;
    public $status;
    public $pageSize = 5;

    public function search()
    {

        $condition = ['and'];

        if($this->typeId != null){
            $condition[] = 'type_id = '.(int)$this->typeId;
        }

        $query = new Query();
        $count = $query
            ->from('dictionary_item')
            ->where($condition)
            ->count();

        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $this->pageSize]);

        $rows = $query
            ->select(['item_id AS itemId', 'code', 'name','create_time AS createTime'])
            ->from('dictionary_item')
            ->where($condition)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return ["rows" => $rows,"pages" => $pages];
    }
}
