<?php

namespace app\modules\account\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use yii\rbac\Item;
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

    public function rules()
    {
        return [
            [['name', 'description'], 'required', 'on' => 'create'],
            [['name', 'description'], 'required', 'on' => 'update'],
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
            ->where(['name' => $this->$attribute, 'type' => Item::TYPE_PERMISSION])
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
            'ruleName' => '规则名称',
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

        $createPost = $auth->createPermission($this->name);
        $createPost->description = $this->description;

        return $auth->add($createPost);

    }
}
