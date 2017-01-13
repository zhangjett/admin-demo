<?php

/* @var $this yii\web\View */
/* @var $model app\modules\account\models\OperatorForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\Dictionary;

$this->title = $model->operatorId?'修改后台用户':'新建后台用户'
?>
<div class="box box-solid">
    <?php $form = ActiveForm::begin([
        'id' => 'updateForm',
        'enableClientValidation'=>true,
        'options' => [
            'method' => 'post',
            'role'=>"form"
        ],
        'layout' => 'horizontal',
    ]); ?>
    <div class="box-header with-border">
        <h3 class="box-title">Select2</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php
        $genderTypeId = Dictionary::getDictionaryTypeIdByCode('gender');
        $statusTypeId = Dictionary::getDictionaryTypeIdByCode('status');
        ?>
        <?php if(count($model->getFirstErrors())>0){ ?>
            <div class="alert alert-danger alert-dismissible">
                <?php echo $form->errorSummary($model); ?>
            </div>
        <?php }; ?>
        <?php
        if (Yii::$app->session->getFlash('updateOperator') == 'success'){
            echo Html::hiddenInput("updateOperator", "success", ['id'=>'updateOperator']);
        }
        if (Yii::$app->session->getFlash('createOperator') == 'success'){
            echo Html::hiddenInput("createOperator", "success", ['id'=>'createOperator']);
        }
        ?>
        <?php echo $form
            ->field($model, 'username', [
                    'horizontalCssClasses' => [
                        'wrapper' => 'col-sm-3',
                    ],
                    'inputOptions' => [
                        'type' => 'text',
                        'placeholder' =>'',
                    ],
            ]
        )->label($model->getAttributeLabel('username')); ?>
        <?php echo $form
            ->field($model, 'password', [
                    'horizontalCssClasses' => [
                        'wrapper' => 'col-sm-3',
                    ],
                    'inputOptions' => [
                        'type' => 'password',
                        'placeholder' =>'',
                    ],
            ]
        )->label($model->getAttributeLabel('password')); ?>
        <?php echo $form
            ->field($model, 'name', [
                    'horizontalCssClasses' => [
                        'wrapper' => 'col-sm-3',
                    ],
                    'inputOptions' => [
                        'type' => 'text',
                        'placeholder' => '',
                    ],
            ]
        )->label($model->getAttributeLabel('name')); ?>
        <?php echo $form
            ->field($model, 'email', [
                    'horizontalCssClasses' => [
                        'wrapper' => 'col-sm-3',
                    ],
                    'inputOptions' => [
                        'type' => 'text',
                        'placeholder' => '',
                    ],
            ]
        )->label($model->getAttributeLabel('email')); ?>
        <?php echo $form
            ->field($model, 'gender')
            ->inline()
            ->radioList(
                Dictionary::getDictionaryItemByType($genderTypeId)
            )
            ->label($model->getAttributeLabel('gender')); ?>
        <?php echo $form
            ->field($model, 'status', [
                    'horizontalCssClasses' => [
                        'wrapper' => 'col-sm-2',
                    ]
            ])
            ->dropDownList(Dictionary::getDictionaryItemByType($statusTypeId), ['prompt' => '状态'])
            ->label($model->getAttributeLabel('status')); ?>
        <?php echo $form->field($model, 'operatorId')->hiddenInput()->label(false); ?>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <?php echo Html::button('启动', ['class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#uploadModal', 'href' => Url::to(['//account/operator/upload',])]); ?>
        <?php echo Html::submitButton('提交', ['class' => 'btn btn-success pull-right']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
    </div>
</div>
<script>
    <?php $this->beginBlock('JS_END');?>
    $(function(){
        $(document).on("hidden.bs.modal", ".modal:not(.local-modal)", function (e) {
            $(e.target).removeData("bs.modal").find(".modal-content").empty();
        });
        if($('#createOperator').val() == 'success'){
            setTimeout(function(){layer.msg('新建成功了呦', {icon: 6});}, 1000);
        }
        if($('#updateOperator').val() == 'success'){
            setTimeout(function(){layer.msg('修改成功了呦', {icon: 6});}, 1000);
        }
        //遍历左菜单,增加active
        $("ul.sidebar-menu a").each(function(index,value){
            if($(this).attr("href")=='<?php echo Url::to(['//account/operator/index']); ?>'){
                $(this).closest("li").addClass("active").closest("ul").css("display","block").closest("li").addClass("active");
            }
        });
    });
    <?php
    $this->endBlock();
    $this->registerJs($this->blocks['JS_END'],\yii\web\view::POS_END);
    ?>
</script>