<?php

namespace app\modules\account\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use yii\base\Exception;
use yii\rbac\Role;

/**
 * OperatorForm.
 */
class OperatorForm extends Model
{
    const updateContentBase = 'base';
    const updateContentAvatar = 'avatar';

    public $operatorId;
    public $username;
    public $password;
    public $name;
    public $email;
    public $status;
    public $gender;
    public $avatar;
    public $createTime;
    public $updateTime;
    public $role = [];

    public $updateContent;

    public function rules()
    {
        return [
            [['operatorId', 'username', 'name', 'gender' ,'status', 'updateContent'], 'required', 'on' => 'updateBase'],
            [['avatar', 'updateContent'], 'required', 'on' => 'updateAvatar'],
            [['username', 'password', 'name', 'gender' ,'status'], 'validateLogin', 'on' => 'create'],
            [['password', 'email', 'role'], 'safe'],
        ];
    }

    public function validateLogin($attribute, $params)
    {
        $query = new Query();
        $count = $query
            ->from('operator')
            ->where(['username' => $this->username])
            ->count();

        if ($count > 0) {
            $this->addError($attribute, '该账号已经存在！');
        }
    }

    public function attributeLabels()
    {
        return [
            'operatorId' => '用户ID',
            'username' => '账号',
            'password' => '密码',
            'name' => '姓名',
            'email' => '电子邮箱',
            'status' => '状态',
            'gender' => '性别',
            'avatar' => '头像',
            'createTime' => '创建时间',
            'updateTime' => '修改时间',
            'role' => '角色'
        ];
    }

    /**
     * 获取用户
     * @param $id
     * @return bool
     */
    public function get($id)
    {
        $query = new Query();
        $row = $query
            ->select(['operator_id', 'username', 'name', 'email', 'status', 'gender', 'avatar'])
            ->from('operator')
            ->where(['operator_id' => $id])
            ->one();

        $this->operatorId = $row['operator_id'];
        $this->username = $row['username'];
        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->status = $row['status'];
        $this->gender = $row['gender'];
        $this->avatar = $row['avatar'];

        $this->role = Yii::$app->authManager->getAssignments($id);

        return true;
    }

    /**
     * 修改后台用户
     * @param $id
     * @return bool
     */
    public function update($id)
    {
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();

        try {
            $columns = [];
            if ($this->updateContent == static::updateContentBase) {
                $columns = [
                    'username' => $this->username,
                    'name' => $this->name,
                    'email' => $this->email,
                    'status' => $this->status,
                    'gender' => $this->gender,
                    'updated_at' => time()
                ];
            }

            if ($this->updateContent == static::updateContentAvatar) {
                $columns = [
                    'avatar' => $this->avatar,
                    'updated_at' => time()
                ];
            }

            ($this->password != null ) && ($columns['password'] = Yii::$app->getSecurity()->generatePasswordHash($this->password));

            $condition = [
                'operator_id' => $id,
            ];
            $connection->createCommand()->update('operator', $columns, $condition)->execute();

            $transaction->commit();

            return true;

        } catch(Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }

    /**
     * 创建用户
     * @return bool
     */
    public function create()
    {
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();

        try {
            $time = time();
            $columns=[
                'username' => $this->username,
                'password' => Yii::$app->getSecurity()->generatePasswordHash($this->password),
                'name' => $this->name,
                'email' => $this->email,
                'created_at'=> $time,
                'updated_at' => $time
            ];
            $connection->createCommand()->insert('operator', $columns)->execute();

            $transaction->commit();

            return true;
        } catch(Exception $e) {
            $transaction->rollBack();
            return false;
        }
    }

    /**
     * 删除用户
     * @param $operatorIdList
     * @return bool
     */
    public function delete($operatorIdList)
    {
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();

        try {
            $command = $connection->createCommand('UPDATE operator SET status = (ABS(status-2)+1) WHERE id = :id');
            $command->bindParam(':id', $id);
            if(is_array($operatorIdList) && count($operatorIdList) > 0){
                foreach($operatorIdList as $operatorId){
                    $id = $operatorId;
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

    /**
     * 分配角色
     * @param $id
     * @return bool
     */
    public function assign($id)
    {
        if ($this->role == null) {
            return true;
        }

        $auth = Yii::$app->authManager;

        $auth->revokeAll($id);

        foreach ($this->role as $value) {
            $role = new Role();
            $role->name = $value;

            $auth->assign($role, $id);
        }

        return true;
    }
}
