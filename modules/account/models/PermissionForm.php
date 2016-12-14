<?php

namespace app\modules\account\models;

use yii;
use yii\base\Model;
use yii\db\Query;
use yii\base\Exception;

/**
 * PermissionForm
 */
class PermissionForm extends Model
{
    public $permissionId;
    public $name;
    public $category;
    public $module;
    public $controller;
    public $action;
    public $status;

    public function rules()
    {
        return [
            [['permissionId'], 'required', 'on' => 'update'],
            [['name', 'category', 'module', 'controller', 'action', 'status'], 'required'],
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
            ->where(['description' => $description,'type' => 2])
            ->count();

        if ($count > 0) {
            $this->addError($attribute, '该权限已经存在！');
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'category' => '类别',
            'module' => 'module',
            'controller' => 'controller',
            'action' => 'action',
        ];
    }

    /**
     * 获取权限详情
     * @param $id
     * @return bool
     */
    public function get($id)
    {
        $query = new Query();
        $row = $query
            ->select(['id','name','description','category','update_time'])
            ->from('auth_item')
            ->where(['id' => $id])
            ->one();

        list($this->module, $this->controller, $this->action) = explode("/",$row['description']);

        $this->permissionId = $row['id'];
        $this->name = $row['name'];
        $this->category = $row['category'];

        return true;
    }

    /**
     * 修改权限
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
                'category' => (int)$this->category,
                'description' => $description,
                'update_time' => date("Y-m-d H:i:s")
            ];
            $condition = [
                'id' => $this->id,
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
     * 创建权限
     * @return bool
     * @throws yii\db\Exception
     */
    public function create()
    {
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();

        try {
            $name = $this->module."/".$this->controller."/".$this->action;
            $date = date("Y-m-d H:i:s");
            $columns = [
                'name' => $this->name,
                'type' => 2,
                'description' => $this->description,
                'category' => $this->category,
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
     * 删除权限
     * @param $permissionIdList
     * @return bool
     * @throws yii\db\Exception
     */
    public function delete($permissionIdList)
    {
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();

        try {
            $command = $connection->createCommand('DELETE FROM auth_item WHERE id=:id');
            $command->bindParam(':id', $id);

            if(is_array($permissionIdList) && count($permissionIdList) > 0){
                foreach($permissionIdList as $permissionId){
                    $id = $permissionId;
                    $command->execute();
                }
            }

            $command = $connection->createCommand('DELETE FROM auth_item_child WHERE child=:child');
            $command->bindParam(':child', $child);

            if(is_array($permissionIdList) && count($permissionIdList) > 0){
                foreach($permissionIdList as $permissionId){
                    $child = $permissionId;
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
