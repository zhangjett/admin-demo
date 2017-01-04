<?php

namespace app\modules\account\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use yii\base\Exception;
use yii\rbac\Item;
use yii\rbac\Role;

/**
 * RoleForm.
 */
class RoleForm extends Model
{
    public $name;
    public $type = Item::TYPE_ROLE;
    public $description;
    public $ruleName;
    public $data;
    public $createdAt;
    public $updatedAt;

    public function rules()
    {
        return [
            [['name', 'description'], 'required', 'on' => 'create'],
            [['name', 'description'], 'required', 'on' => 'update'],
            ['ruleName', 'default', 'value' => null],
            ['name', 'validateName', 'on' => 'create'],
        ];
    }

    /**
     * 验证角色名称是否重复
     * @param $attribute
     * @param $params
     */
    public function validateName($attribute, $params)
    {
        $count = (new Query())
            ->from('item')
            ->where(['name' => $this->$attribute])
            ->count();

        if ($count > 0) {
            $this->addError($attribute, '该该角色已经存在了，请修改！');
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'type' => '类型',
            'description' => '描述',
            'ruleName' => '规则',
            'data' => '数据',
            'createdAt' => '创建时间',
            'updatedAt' => '修改时间'
        ];
    }

    /**
     * 获取角色详情
     * @param $name
     * @return bool
     */
    public function get($name)
    {
        $auth = Yii::$app->authManager;

        $role = $auth->getRole($name);
        $this->name = $role->name;
        $this->description = $role->description;
        $this->ruleName = $role->ruleName;

        return true;
    }

    /**
     * 修改角色
     * @param $name
     * @return bool
     */
    public function update($name)
    {
        $auth = Yii::$app->authManager;

        $role = new Role();
        $role->name = $this->name;
        $role->description = $this->description;
        $role->ruleName = $this->ruleName;

        return $auth->update($name, $role);

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
