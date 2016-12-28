<?php

namespace app\modules\account\models;

use yii;
use yii\base\Model;
use yii\db\Query;
use yii\base\Exception;

/**
 * DictionaryTypeForm
 */
class DictionaryTypeForm extends Model
{
    public $typeId;
    public $code;
    public $name;
    public $updateTime;
    public $createTime;

    public function rules()
    {
        return [
            [['code', 'name'], 'required', 'on' => 'create'],
            [['typeId', 'code', 'name'], 'required', 'on' => 'update']
        ];
    }


    public function attributeLabels()
    {
        return [
            'typeId' => '类型ID',
            'code' => '类型编码',
            'name' => '类型名称',
            'updateTime' => '修改时间',
            'createTime' => '创建时间',
        ];
    }

    /**
     * 获取菜单详情
     * @param $id
     * @return bool
     */
    public function get($id)
    {
        $query = new Query();
        $row = $query
            ->select(['type_id', 'code', 'name'])
            ->from('dictionary_type')
            ->where(['type_id' => $id])
            ->one();

        $this->typeId = $row['type_id'];
        $this->code = $row['code'];
        $this->name = $row['name'];

        return true;
    }

    /**
     * 修改菜单
     * @return bool
     * @throws yii\db\Exception
     */
    public function update()
    {

        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $columns = [
                'code' => $this->code,
                'name' => $this->name,
                'update_time' => date("Y-m-d H:i:s")
            ];
            $condition = [
                'type_id' => $this->typeId,
            ];
            $connection->createCommand()->update('dictionary_type', $columns, $condition)->execute();
            $transaction->commit();
            return true;
        } catch(Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }

    /**
     * 创建菜单
     * @return bool
     * @throws yii\db\Exception
     */
    public function create()
    {
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();

        try {
            $date = date("Y-m-d H:i:s");
            $columns = [
                'code' => $this->code,
                'name' => $this->name,
                'create_time' => $date
            ];
            $connection->createCommand()->insert('dictionary_type', $columns)->execute();
            $transaction->commit();

            return true;
        } catch(Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }
}
