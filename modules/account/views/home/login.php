<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

<!--        <form action="../../index2.html" method="post">-->
        <?php $form = ActiveForm::begin([
            'id' => 'updateForm',
            'enableClientValidation'=>true,
            'options' => [
                'method' => 'post',
                'role'=>"form"
            ],
//            'layout' => 'horizontal',
        ]); ?>
            <?php echo $form->field($model, 'username', [
                    'options' => ['class' => 'form-group has-feedback'],
                    'inputTemplate' => '{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span>',
                    'inputOptions' => [
                        'type'=>'text',
                        'placeholder' => $model->getAttributeLabel('username'),
                    ],
                ]
            )->label(false); ?>
            <?php echo $form->field($model, 'password', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => '{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>',
                'inputOptions' => [
                    'type'=>'password',
                    'placeholder' => $model->getAttributeLabel('password'),
                ],
            ]
            )->label(false); ?>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <?= $form->field($model, 'rememberMe',[
                            'options' => [
                                'tag' => false,
                            ],
                            'checkboxTemplate' => "{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{error}\n{hint}",
                        ])->checkbox(['uncheck' => null])->label($model->getAttributeLabel('rememberMe')); ?>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-success btn-block btn-flat">登陆</button>
                </div>
                <!-- /.col -->
            </div>
<!--        </form>-->
            <?php ActiveForm::end(); ?>
    </div>
    <!-- /.login-box-body -->
</div>
