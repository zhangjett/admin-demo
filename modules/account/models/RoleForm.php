<?php

namespace app\modules\account\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use yii\rbac\Item;
use yii\rbac\Role;
use yii\rbac\Permission;

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

    public $childRole;
    public $childPermission;

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

        return $auth->update($name, $role)&&$auth->removeChildren($role)
            &&$this->batchAddChildPermission($role, $this->childPermission)
            &&$this->batchAddChildRole($role, $this->childRole);

    }

    /**
     * 批量添加子权限
     * @param $parent
     * @param $childPermission
     * @return bool
     */
    public function batchAddChildPermission($parent, $childPermission)
    {
        $auth = Yii::$app->authManager;

        if ($childPermission == null) {
            return true;
        }

        foreach ($childPermission as $permission) {
            $child = new Permission();
            $child->name = $permission;

            $auth->addChild($parent, $child);
        }

        return true;
    }

    /**
     * 批量添加子角色
     * @param $parent
     * @param $childRole
     * @return bool
     */
    public function batchAddChildRole($parent, $childRole)
    {
        $auth = Yii::$app->authManager;

        if ($childRole == null) {
            return true;
        }

        foreach ($childRole as $role) {
            $child = new Role();
            $child->name = $role;

            $auth->addChild($parent, $child);
        }

        return true;
    }
}
