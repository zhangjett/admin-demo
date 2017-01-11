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

        $count = (new Query())
            ->from('dictionary_item')
            ->where($condition)
            ->count();

        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $this->pageSize]);

        $rows = (new Query())
            ->select(['item_id AS itemId', 'value', 'name', 'created_at AS createdAt', 'updated_at AS updatedAt'])
            ->from('dictionary_item')
            ->where($condition)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return ["rows" => $rows,"pages" => $pages];
    }
}
