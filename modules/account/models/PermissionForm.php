<?php

namespace app\modules\account\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use yii\rbac\Item;
use yii\rbac\Permission;
/**
 * PermissionForm
 */
class PermissionForm extends Model
{
    public $name;
    public $type = Item::TYPE_PERMISSION;
    public $description;
    public $ruleName;
    public $data;
    public $createdAt;
    public $updatedAt;

    public $permission;

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
     * 验证权限名称是否重复
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
            $this->addError($attribute, '该权限已经存在了，请修改！');
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
     * 添加权限
     * @return bool
     */
    public function create()
    {
        $auth = Yii::$app->authManager;

        $permission = $auth->createPermission($this->name);
        $permission->description = $this->description;
        $permission->ruleName = $this->ruleName;

        return $auth->add($permission);

    }

    /**
     * 获取权限详情
     * @param $name
     * @return bool
     */
    public function get($name)
    {
        $auth = Yii::$app->authManager;

        $permission = $auth->getPermission($name);
        $this->name = $permission->name;
        $this->description = $permission->description;
        $this->ruleName = $permission->ruleName;

        return true;
    }

    /**
     * 修改权限
     * @param $name
     * @return bool
     */
    public function update($name)
    {
        $auth = Yii::$app->authManager;

        $permission = new Permission();
        $permission->name = $this->name;
        $permission->description = $this->description;
        $permission->ruleName = $this->ruleName;

        return $auth->update($name, $permission);

    }

    /**
     * 删除权限
     * @param $name
     * @return bool
     */
    public function delete($name)
    {
        $auth = Yii::$app->authManager;

        $permission = new Permission();
        $permission->name = $name;

        return $auth->remove($permission);

    }
}
