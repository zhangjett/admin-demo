<?php

/* @var $this yii\web\View */
/* @var $model app\modules\account\models\PermissionForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

if (Yii::$app->session->getFlash('updateChild') == 'success') {
    echo Html::hiddenInput("createPermission", "success");
}

$this->title = '添加子权限';

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
        <?php if(count($model->getFirstErrors()) > 0) { ?>
            <div class="alert alert-danger alert-dismissible">
                <?php echo $form->errorSummary($model); ?>
            </div>
        <?php }; ?>
        <?php if (Yii::$app->session->getFlash('updateChild') == 'success'){ ?>
            <div class="alert alert-success alert-dismissible">
                修改子权限成功！
            </div>
        <?php } ?>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="form-group">
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
                            'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n&nbsp;&nbsp;{endLabel}\n{hint}",
                        ])->label($permission->description);
                    } ?>
                    <?php echo Html::hiddenInput("PermissionForm[childPermission][]"); ?>
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