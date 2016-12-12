<?php

namespace app\modules\account\models;

use yii;
use yii\base\Model;
use yii\db\Query;
use yii\base\Exception;

/**
 * OperatorForm.
 */
class OperatorForm extends Model
{
    public $operatorId;
    public $login;
    public $password;
    public $name;
    public $email;
    public $status;
    public $gender;
    public $createTime;
    public $updateTime;
    public $roles;

    public function rules()
    {
        return [
            [['id'], 'required', 'on' => 'update'],
            [['login', 'password', 'name' ,'status'], 'validateLogin', 'on' => 'create'],
            [['login', 'name', 'phone', 'email', 'qq', 'tel','gender', 'role'], 'safe'],
        ];
    }

    public function validateLogin($attribute, $params)
    {
        $query = new Query();
        $count = $query
            ->from('operator')
            ->where(['login'=>$this->login])
            ->count();

        if ($count > 0) {
            $this->addError($attribute, '该账号已经存在！');
        }
    }

    public function attributeLabels()
    {
        return [
            'operatorId' => '用户ID',
            'login' => '账号',
            'password' => '密码',
            'name' => '姓名',
            'email' => '电子邮箱',
            'status' => '状态',
            'gender' => '性别',
            'createTime' => '创建时间',
            'updateTime' => '修改时间'
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
            ->select(['operator_id', 'login', 'name', 'email', 'status', 'create_time', 'update_time'])
            ->from('operator')
            ->where(['id'=>$id])
            ->one();

        $this->operatorId = $row['operator_id'];
        $this->login = $row['login'];
        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->status = $row['status'];
        $this->createTime = $row['create_time'];
        $this->updateTime = $row['update_time'];

        $rows = $query
            ->select(['item_id'])
            ->from('auth_assignment')
            ->where(['operator_id' => $this->operatorId])
            ->indexBy('item_id')
            ->column();

        $this->roles = $rows;
        return true;
    }

    /**
     * 修改用户
     * @return bool
     */
    public function update()
    {
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();

        try {
            $columns = [
                'login' => $this->login,
                'name' => $this->name,
                'email' => $this->email,
                'status' => $this->status,
                'update_time' => date("Y-m-d H:i:s")
            ];

            ($this->password != null ) && ($columns['password'] = Yii::$app->getSecurity()->generatePasswordHash($this->password));

            $condition = [
                'operator_id' => $this->operatorId,
            ];
            $connection->createCommand()->update('operator', $columns, $condition)->execute();

            $condition = [
                'operator_id' => $this->operatorId,
            ];
            $connection->createCommand()->delete('auth_assignment', $condition)->execute();

            if(is_array($this->roles) && count($this->roles)>0){
                $columns = [];
                $date=date("Y-m-d H:i:s");
                foreach($this->roles as $role){
                    $column = [];
                    $column[] = $this->operatorId;
                    $column[] = $role;
                    $column[] = $date;
                    $columns[] = $column;
                }
                $connection->createCommand()->batchInsert('auth_assignment', ['operator_id','item_id','create_time'], $columns)->execute();
            }

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
}
