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
    public $operatorId;
    public $username;
    public $password;
    public $name;
    public $email;
    public $status;
    public $gender;
    public $createTime;
    public $updateTime;
    public $role;

    public function rules()
    {
        return [
            [['operatorId', 'username', 'name', 'gender' ,'status'], 'required', 'on' => 'update'],
            [['username', 'password', 'name', 'gender' ,'status'], 'validateLogin', 'on' => 'create'],
            [['email', 'role'], 'safe'],
        ];
    }

    public function validateLogin($attribute, $params)
    {
        $query = new Query();
        $count = $query
            ->from('operator')
            ->where(['username'=>$this->username])
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
            ->select(['operator_id', 'username', 'name', 'email', 'status', 'gender'])
            ->from('operator')
            ->where(['operator_id'=>$id])
            ->one();

        $this->operatorId = $row['operator_id'];
        $this->username = $row['username'];
        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->status = $row['status'];
        $this->gender = $row['gender'];

        $auth = Yii::$app->authManager;
        $rows = $query
            ->select(['item_id'])
            ->from('auth_assignment')
            ->where(['operator_id' => $this->operatorId])
            ->indexBy('item_id')
            ->column();

        $this->role = $rows;
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
            $columns = [
                'username' => $this->username,
                'name' => $this->name,
                'email' => $this->email,
                'status' => $this->status,
                'gender' => $this->gender
            ];

            ($this->password != null ) && ($columns['password'] = Yii::$app->getSecurity()->generatePasswordHash($this->password));

            $condition = [
                'operator_id' => $id,
            ];
            $connection->createCommand()->update('operator', $columns, $condition)->execute();

//            $condition = [
//                'operator_id' => $this->operatorId,
//            ];
//            $connection->createCommand()->delete('auth_assignment', $condition)->execute();
//
//            if(is_array($this->role) && count($this->role)>0){
//                $columns = [];
//                $date=date("Y-m-d H:i:s");
//                foreach($this->role as $role){
//                    $column = [];
//                    $column[] = $this->operatorId;
//                    $column[] = $role;
//                    $column[] = $date;
//                    $columns[] = $column;
//                }
//                $connection->createCommand()->batchInsert('auth_assignment', ['operator_id','item_id','create_time'], $columns)->execute();
//            }

            $transaction->commit();

        } catch(Exception $e) {
            $transaction->rollBack();

        }

        $this->batchAssign($this->role, $id);

        return true;
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
            $columns=[
                'login' => $this->login,
                'password' => Yii::$app->getSecurity()->generatePasswordHash($this->password),
                'name' => $this->name,
                'email' => $this->email,
                'create_time'=> date("Y-m-d H:i:s"),
                'update_time' => date("Y-m-d H:i:s"),
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
     * 批量分配角色
     * @param $roleList
     * @param $userId
     * @return bool
     */
    public function batchAssign($roleList, $userId)
    {
        $auth = Yii::$app->authManager;

        if ($roleList == null) {
            return true;
        }

        foreach ($roleList as $value) {
            $role = new Role();
            $role->name = $value;

            $auth->assign($role, $userId);
        }

        return true;
    }
}
