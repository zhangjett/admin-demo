<?php

namespace app\modules\account\models;

use yii;
use yii\base\Model;
use yii\db\Query;
use yii\base\Exception;

/**
 * DictionaryItemForm
 */
class DictionaryItemForm extends Model
{
    public $itemId;
    public $typeId;
    public $code;
    public $name;
    public $updateTime;
    public $createTime;

    public function rules()
    {
        return [
            [['typeId', 'code', 'name'], 'required', 'on' => 'create'],
            [['itemId', 'code', 'name'], 'required', 'on' => 'update'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'typeId' => '类型ID',
            'code' => '名称CODE',
            'name' => '名称',
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
            ->select(['item_id', 'type_id', 'code', 'name'])
            ->from('dictionary_item')
            ->where(['item_id' => $id])
            ->one();

        $this->itemId = $row['item_id'];
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
                'name' => $this->name,
            ];
            $condition = [
                'item_id' => $this->itemId,
            ];
            $connection->createCommand()->update('dictionary_item', $columns, $condition)->execute();
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
                'type_id' => $this->typeId,
                'create_time' => $date,
                'update_time' => $date,
            ];
            $connection->createCommand()->insert('dictionary_item', $columns)->execute();
            $transaction->commit();

            return true;
        } catch(Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }
}
