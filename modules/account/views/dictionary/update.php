<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title = $model->typeId?'编辑字典类型':'新建字典类型';
?>
<?php $form = ActiveForm::begin([
    'id' => 'updateDictionaryType',
    'enableClientValidation'=>true,
    'options' => [
        'method' => 'post',
        'role'=>"form"
    ],
    'layout' => 'horizontal',
]); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="modalLabel"><?php echo $this->title; ?></h4>
</div>
<div class="modal-body">
    <?php if(count($model->getFirstErrors()) > 0){ ?>
        <div class="alert alert-danger alert-dismissible">
            <?php echo $form->errorSummary($model); ?>
        </div>
    <?php }; ?>
    <?php if (Yii::$app->session->getFlash('createDictionaryType') == 'success'){ ?>
        <div class="alert alert-success alert-dismissible">
            创建字典类型成功！
        </div>
    <?php } ?>
    <?php if (Yii::$app->session->getFlash('updateDictionaryType') == 'success'){ ?>
        <div class="alert alert-success alert-dismissible">
            修改字典类型成功！
        </div>
    <?php } ?>
    <?php echo $form
        ->field($model,'name',[
                'horizontalCssClasses' => [
                    'wrapper' => 'col-sm-3',
                ],
                'inputOptions' => [
                    'type' => 'text',
                    'placeholder' =>'',
                ],
            ]
        )->label($model->getAttributeLabel('name')); ?>
    <?php echo $form->field($model, 'typeId')->hiddenInput()->label(false); ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <?php echo Html::submitButton('提交', ['class' => 'btn btn-primary']); ?>
</div>
<?php ActiveForm::end(); ?>