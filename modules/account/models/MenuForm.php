<?php

namespace app\modules\account\models;

use yii;
use yii\base\Model;
use yii\db\Query;
use yii\base\Exception;

/**
 * MenuForm
 */
class MenuForm extends Model
{
    public $menuId;
    public $name;
    public $group;
    public $module;
    public $controller;
    public $action;
    public $status;

    public function rules()
    {
        return [
            [['menuId'], 'required', 'on' => 'update'],
            [['name', 'group', 'module', 'controller', 'action', 'status'], 'required'],
            ['action', 'validateName', 'on' => 'create'],
        ];
    }

    /**
     * 验证权限名称是否重复
     * @param $attribute
     * @param $params
     */
    public function validateName($attribute, $params)
    {
        $description = $this->module."/".$this->controller."/".$this->action;

        $query = new Query();
        $count = $query
            ->from('auth_item')
            ->where(['description' => $description, 'type' => 2])
            ->count();

        if ($count > 0) {
            $this->addError($attribute, '该权限已经存在！');
        }
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
            ->select(['item_id AS menu_id', 'name', 'description', 'group_id', 'status'])
            ->from('auth_item')
            ->where(['item_id' => $id])
            ->one();

        list($this->module, $this->controller, $this->action) = explode("/",$row['description']);

        $this->menuId = $row['menu_id'];
        $this->name = $row['name'];
        $this->group = $row['group_id'];
        $this->status = $row['status'];

        return true;
    }

    /**
     * 修改菜单
     * @return bool
     * @throws yii\db\Exception
     */
    public function update()
    {
        $description = $this->module."/".$this->controller."/".$this->action;

        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $columns = [
                'name' => $this->name,
                'group_id' => (int)$this->group,
                'description' => $description,
                'update_time' => date("Y-m-d H:i:s")
            ];
            $condition = [
                'item_id' => $this->menuId,
            ];
            $connection->createCommand()->update('auth_item', $columns, $condition)->execute();
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
