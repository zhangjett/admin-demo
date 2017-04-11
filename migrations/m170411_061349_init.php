<?php

use yii\db\Migration;
use yii\helpers\Console;
use app\components\rbac\OwnerRule;

class m170411_061349_init extends Migration
{
    public function up()
    {
        $time = time();
        $user = console::prompt('input superAdmin username', [
            'default' => 'admin'
        ]);

        $password = console::prompt('input superAdmin password', [
            'default' => 123456
        ]);

        $this->createTable('operator', [
            'operator_id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->defaultValue(''),
            'password' => $this->string(500)->notNull()->defaultValue(''),
            'name' => $this->string(255)->notNull()->defaultValue(''),
            'avatar' => $this->string(255)->notNull()->defaultValue(''),
            'auth_key' => $this->string(255)->notNull()->defaultValue(''),
            'email' => $this->string(255)->notNull()->defaultValue(''),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'gender' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0)
        ]);

        $this->insert('operator', [
            'username' => $user,
            'password' => Yii::$app->getSecurity()->generatePasswordHash($password),
            'name' => 'superAdmin',
            'avatar' => '',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'email' => '',
            'status' => 1,
            'gender' => 1,
            'created_at' => $time,
            'updated_at' => $time
        ]);

        $this->createTable('dictionary_type', [
            'type_id' => $this->primaryKey(),
            'code' => $this->string(255)->notNull()->defaultValue(''),
            'name' => $this->string(255)->notNull()->defaultValue(''),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0)
        ]);

        $this->batchInsert('dictionary_type', [
            'code', 'name', 'created_at', 'updated_at'
        ], [
            ['gender', '性别', $time, $time],
            ['status', '状态', $time, $time],
        ]);

        $this->createTable('dictionary_item', [
            'item_id' => $this->primaryKey(),
            'type_id' => $this->integer()->notNull()->defaultValue(0),
            'name' => $this->string(255)->notNull()->defaultValue(''),
            'value' => $this->string(255)->notNull()->defaultValue(''),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0)
        ]);

        $this->batchInsert('dictionary_item', [
            'type_id', 'name', 'value', 'created_at', 'updated_at'
        ], [
            [1, '男', 1, $time, $time],
            [1, '女', 2, $time, $time],
            [2, '正常', 1, $time, $time],
            [2, '删除', 2, $time, $time],
        ]);

        $auth = Yii::$app->authManager;

        $rule = new OwnerRule();
        $auth->add($rule);

        $this->batchInsert('auth_item', [
            'name', 'type', 'description', 'rule_name', 'created_at', 'updated_at'
        ], [
            ['addChildPermission', 2, '添加子权限', null, $time, $time],
            ['addPermissionOrChildRole', 2, '添加权限或着子角色', null, $time, $time],
            ['assignOperator', 2, '给后台用户分配角色', null, $time, $time],
            ['createDictionaryItem', 2, '创建字典', null, $time, $time],
            ['createDictionaryType', 2, '创建字典类型', null, $time, $time],
            ['createOperator', 2, '创建后台用户', null, $time, $time],
            ['createPermission', 2, '创建权限', null, $time, $time],
            ['createRole', 2, '创建角色', null, $time, $time],
            ['deletePermission', 2, '删除权限', null, $time, $time],
            ['deleteRole', 2, '删除角色', null, $time, $time],
            ['superAdmin', 1, '超级管理员', null, $time, $time],
            ['updateDictionaryItem', 2, '修改字典', null, $time, $time],
            ['updateDictionaryType', 2, '修改字典类型', null, $time, $time],
            ['updateOperatorProfile', 2, '修改后台用户信息', null, $time, $time],
            ['updateOwnerProfile', 2, '修改自己信息', 'isOwner', $time, $time],
            ['updatePermission', 2, '修改权限', null, $time, $time],
            ['updateRole', 2, '修改角色', null, $time, $time],
            ['upload', 2, '上传文件', null, $time, $time],
            ['viewDictionaryItem', 2, '查看字典详情', null, $time, $time],
            ['viewDictionaryItemList', 2, '查看字典列表', null, $time, $time],
            ['viewDictionaryType', 2, '查看字典类型详情', null, $time, $time],
            ['viewDictionaryTypeList', 2, '查看字典类型列表', null, $time, $time],
            ['viewOperatorList', 2, '查看后台用户列表', null, $time, $time],
            ['viewOperatorProfile', 2, '查看后台用户信息', null, $time, $time],
            ['viewPermission', 2, '查看权限详情', null, $time, $time],
            ['viewPermissionList', 2, '查看权限列表', null, $time, $time],
            ['viewRole', 2, '查看角色详情', null, $time, $time],
            ['viewRoleList', 2, '查看角色列表', null, $time, $time]
        ]);

        $this->batchInsert('auth_item_child', [
            'parent', 'child'
        ], [
            ['superAdmin', 'addChildPermission'],
            ['superAdmin', 'addPermissionOrChildRole'],
            ['superAdmin', 'assignOperator'],
            ['superAdmin', 'createDictionaryItem'],
            ['superAdmin', 'createDictionaryType'],
            ['superAdmin', 'createOperator'],
            ['superAdmin', 'createPermission'],
            ['superAdmin', 'createRole'],
            ['superAdmin', 'deletePermission'],
            ['superAdmin', 'deleteRole'],
            ['superAdmin', 'updateDictionaryItem'],
            ['superAdmin', 'updateDictionaryType'],
            ['superAdmin', 'updateOperatorProfile'],
            ['superAdmin', 'updateOwnerProfile'],
            ['superAdmin', 'updatePermission'],
            ['superAdmin', 'updateRole'],
            ['superAdmin', 'upload'],
            ['superAdmin', 'viewDictionaryItem'],
            ['superAdmin', 'viewDictionaryItemList'],
            ['superAdmin', 'viewDictionaryType'],
            ['superAdmin', 'viewDictionaryTypeList'],
            ['superAdmin', 'viewOperatorList'],
            ['superAdmin', 'viewOperatorProfile'],
            ['superAdmin', 'viewPermission'],
            ['superAdmin', 'viewPermissionList'],
            ['superAdmin', 'viewRole'],
            ['superAdmin', 'viewRoleList']
        ]);

        $this->batchInsert('auth_assignment', [
            'item_name', 'user_id', 'created_at'
        ], [
            ['superAdmin', 1, $time],
        ]);
    }

    public function down()
    {
        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
