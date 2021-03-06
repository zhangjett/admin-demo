<?php

/* @var $this yii\web\View */
/* @var $model app\modules\account\models\RoleForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = '添加权限/子角色';

?>
<?php $form = ActiveForm::begin([
    'id' => 'updateChildForm',
    'enableClientValidation'=>true,
    'options' => [
        'method' => 'post',
        'role'=>"form"
    ],
    'layout' => 'horizontal',
]); ?>
<div class="modal-body">
    <div class="box-body">
        <?php if(count($model->getFirstErrors()) > 0){ ?>
            <div class="alert alert-danger alert-dismissible">
                <?php echo $form->errorSummary($model); ?>
            </div>
        <?php }; ?>
        <?php if (Yii::$app->session->getFlash('updateChild') == 'success'){ ?>
            <div class="alert alert-success alert-dismissible">
                修改权限/子角色成功！
            </div>
        <?php } ?>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="form-group">
                    <div>
                        <label>权限</label>
                    </div>
                    <?php foreach (Yii::$app->authManager->getPermissions() as $index => $permission) {
                        if ($model->name == $index) {
                            continue;
                        }

                        echo $form->field($model, 'childPermission[]', [
                            'inputOptions' => [
                                'type' => 'checkbox',
                                'value' => $index,
                                'checked' => (isset($model->childPermission[$index])||in_array($index, $model->childPermission))?'checked':false
                            ],
                            'options' => [
                                'tag' => false
                            ],
                            'labelOptions' => ['class' => false],
                            'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n{endLabel}\n{hint}\n&nbsp;&nbsp;",
                        ])->label($permission->description);
                    } ?>
                    <?php echo Html::hiddenInput('RoleForm[childPermission][]')?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="form-group">
                    <div>
                        <label>角色</label>
                    </div>
                    <?php foreach (Yii::$app->authManager->getRoles() as $index => $role) {
                        if ($model->name == $index) {
                            continue;
                        }

                        echo $form->field($model, 'childRole[]', [
                            'inputOptions' => [
                                'type' => 'checkbox',
                                'value' => $index,
                                'checked' => (isset($model->childRole[$index])||in_array($index, $model->childRole))?'checked':false
                            ],
                            'options' => [
                                'tag' => false
                            ],
                            'labelOptions' => ['class' => false],
                            'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n{endLabel}\n{hint}\n&nbsp;&nbsp;",
                        ])->label($role->description);
                    } ?>
                    <?php echo Html::hiddenInput('RoleForm[childRole][]')?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <?php echo Html::submitButton('提交', ['class' => 'btn btn-primary']); ?>
</div>
<?php ActiveForm::end(); ?>
<script type="text/javascript">
    $(function(){
        $(document).trigger('icheck');
    });
</script>