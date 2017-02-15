<?php

/* @var $this yii\web\View */
/* @var $model app\modules\account\models\OperatorForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\Dictionary;

if (Yii::$app->session->getFlash('updateChild') == 'success') {
    echo Html::hiddenInput("createPermission", "success");
}

$this->title = '分配角色';

?>
<?php $form = ActiveForm::begin([
    'id' => 'assignForm',
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
        <?php if (Yii::$app->session->getFlash('assign') == 'success'){ ?>
            <div class="alert alert-success alert-dismissible fade in">
                分配成功！
            </div>
        <?php } ?>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php foreach (Yii::$app->authManager->getRoles() as $index => $role) {
                        if ($model->name == $index) {
                            continue;
                        }
                        echo $form->field($model, 'role[]', [
                            'inputOptions' => [
                                'type' => 'checkbox',
                                'value' => $index,
                                'checked' => (isset($model->role[$index])||in_array($index, $model->role))?'checked':false
                            ],
                            'options' => [
                                'tag' => false
                            ],
                            'labelOptions' => ['class' => false],
                            'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n&nbsp;&nbsp;{endLabel}\n{hint}",
                        ])->label($role->description);
                    } ?>
                    <?php echo Html::hiddenInput('OperatorForm[role][]')?>
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