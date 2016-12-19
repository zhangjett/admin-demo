<?php

namespace app\modules\account\models;

use yii;
use yii\base\Model;
use yii\db\Query;
use yii\base\Exception;

/**
 * RoleForm.
 */
class RoleForm extends Model
{
    public $roleId;
    public $menu;
    public $name;
    public $group;
    public $status;

    public function rules()
    {
        return [
            [['roleId'], 'required', 'on' => 'update'],
            [['group', 'name', 'status'], 'required'],
            ['name', 'validateName', 'on' => 'create'],
            [['menu'], 'safe'],
        ];
    }

    public function validateName($attribute, $params)
    {
        $count = (new Query())
            ->from('auth_item')
            ->where(['name' => $this->name, 'type' => 1])
            ->count();

        if ($count > 0) {
            $this->addError($attribute, '该角色已经存在！');
        }
    }

    public function attributeLabels()
    {
        return [
            'roleId' => '角色ID',
            'name' => '名称',
            'group' => '组别',
            'menu' => '权限',
            'status' => '状态',
        ];
    }

    public function get($id)
    {
        $query = new Query();
        $row = $query
            ->select(['item_id', 'name', 'group_id'])
            ->from('auth_item')
            ->where(['item_id' => $id])
            ->one();

        $this->roleId = $row['item_id'];
        $this->group = $row['group_id'];
        $this->name = $row['name'];

        $rows = $query
            ->select(['child'])
            ->from('auth_item_child')
            ->where(['parent' => $this->roleId])
            ->indexBy('child')
            ->column();

        $this->menu = $rows;

        return true;
    }

    public function update()
    {

        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $columns = [
                'name' => $this->name,
                'category' => $this->group,
                'description' => $this->name,
                'update_time' => date("Y-m-d H:i:s")
            ];
            $condition = [
                'id' => $this->roleId,
            ];
            $connection->createCommand()->update('auth_item', $columns, $condition)->execute();

            if(is_array($this->menu) && count($this->menu) > 0){
                $condition = [
                    'parent' => $this->roleId,
                ];
                $connection->createCommand()->delete('auth_item_child', $condition)->execute();

                $columns = [];
                foreach($this->menu as $menu){
                    $column = [];
                    $column[] = $this->roleId;
                    $column[] = $menu;
                    $columns[] = $column;
                }

                $connection->createCommand()->batchInsert('auth_item_child', ['parent','child'], $columns)->execute();
            }

            $transaction->commit();
            return true;
        } catch(Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }

    public function create()
    {
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $date = date("Y-m-d H:i:s");
            $columns = [
                'name' => $this->name,
                'type' => 1,
                'description' => $this->name,
                'category' => $this->group,
                'create_time' => $date,
                'update_time' => $date,
            ];
            $connection->createCommand()->insert('auth_item', $columns)->execute();

            if(is_array($this->menu) && count($this->menu) > 0){
                $columns = [];
                foreach($this->menu as $menu){
                    $column = [];
                    $column[] = $this->id;
                    $column[] = $menu;
                    $columns[] = $column;
                }
                $connection->createCommand()->batchInsert('auth_item_child', ['parent','child'], $columns)->execute();
            }

            $transaction->commit();
            return true;
        } catch(Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }

    public function delete($roleIdList)
    {
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $command = $connection->createCommand('DELETE FROM auth_item WHERE id=:id');
            $command->bindParam(':id', $id);

            if(is_array($roleIdList) && count($roleIdList) > 0){
                foreach($roleIdList as $roleId){
                    $id = $roleId;
                    $command->execute();
                }
            }

            $command = $connection->createCommand('DELETE FROM auth_item_child WHERE parent=:parent');
            $command->bindParam(':parent', $parent);

            if(is_array($roleIdList) && count($roleIdList) > 0){
                foreach($roleIdList as $roleId){
                    $parent = $roleId;
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
