<?php

use yii\db\Migration;
use app\components\rbac\OwnerRule;

class m170103_122825_create_rule extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        $rule = new OwnerRule();
        $auth->add($rule);

    }

    public function down()
    {
        return false;
    }
}
