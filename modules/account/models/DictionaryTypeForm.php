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
    public $name;
    public $createTime;

    public function rules()
    {
        return [
            [['typeId', 'name'], 'required', 'on' => 'update']
        ];
    }


    public function attributeLabels()
    {
        return [
            'permissionId' => '权限ID',
            'name' => '名称',
            'group' => '组别',
            'module' => 'module',
            'controller' => 'controller',
            'action' => 'action',
            'status' => '状态',
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
            ->select(['type_id', 'name'])
            ->from('dictionary_type')
            ->where(['type_id' => $id])
            ->one();

        $this->typeId = $row['type_id'];
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
                'name' => $this->name,
                'type' => 2,
                'description' => $this->module."/".$this->controller."/".$this->action,
                'category' => $this->group,
                'created_at' => $date,
                'updated_at' => $date,
            ];
            $connection->createCommand()->insert('auth_item', $columns)->execute();
            $transaction->commit();

            return true;
        } catch(Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }

    /**
     * 删除菜单
     * @param $menuIdList
     * @return bool
     * @throws yii\db\Exception
     */
    public function delete($menuIdList)
    {
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();

        try {
            $command = $connection->createCommand('DELETE FROM auth_item WHERE id=:id');
            $command->bindParam(':id', $id);

            if(is_array($menuIdList) && count($menuIdList) > 0){
                foreach($menuIdList as $menuId){
                    $id = $menuId;
                    $command->execute();
                }
            }

            $command = $connection->createCommand('DELETE FROM auth_item_child WHERE child=:child');
            $command->bindParam(':child', $child);

            if(is_array($menuIdList) && count($menuIdList) > 0){
                foreach($menuIdList as $menuId){
                    $child = $menuId;
                    $command->execute();
                }
            }

            $transaction->commit();
            return true;
        } catch(Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }
}
