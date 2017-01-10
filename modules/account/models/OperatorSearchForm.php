<?php

namespace app\modules\account\models;

use yii;
use yii\base\Model;
use yii\data\Pagination;
use yii\db\Query;

/**
 * OperatorSearchForm
 */
class OperatorSearchForm extends Model
{
    public $status;
    public $type;
    public $beginTime;
    public $endTime;
    public $filter;
    public $pageSize = 10;

    public function rules()
    {
        return [
            [['status', 'type', 'beginTime', 'endTime', 'filter', 'pageSize'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'status' => '状态',
            'type' => '类型',
            'beginTime' => '开始时间',
            'endTime' => '结束时间',
            'filter' => '账号/姓名'
        ];
    }

    public function search()
    {

        $condition = ['and'];

        if($this->status != null){
            $condition[] = 'status='.$this->status;
        }

        if(($this->beginTime != null) && ($this->endTime) != null){
            $condition[] = ['between', 'approve', $this->beginTime." 00:00:00", $this->endTime." 23:59:59"];
        }

        if($this->filter != ""){
            $condition[] = ['or', ['like', 'username', $this->filter], ['like', 'name', $this->filter]];
        }

        $count = (new Query())
            ->from('operator')
            ->where($condition)
            ->count();

        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $this->pageSize]);

        $rows = (new Query())
            ->select(['operator_id AS operatorId', 'username', 'name', 'email', 'status', 'created_at AS createdAt', 'updated_at AS updatedAt'])
            ->from('operator')
            ->where($condition)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return ["rows" => $rows,"pages" => $pages];
    }
}
