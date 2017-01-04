<?php

/* @var $model app\modules\account\models\PermissionForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\Dictionary;

if (Yii::$app->session->getFlash('createPermission') == 'success') {
    echo Html::hiddenInput("createPermission", "success");
}
if (Yii::$app->session->getFlash('updatePermission') == 'success') {
    echo Html::hiddenInput("updatePermission", "success");
}
?>
<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Select2</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <?php $form = ActiveForm::begin([
        'id' => 'updateForm',
        'enableClientValidation'=>true,
        'options' => [
            'method' => 'post',
            'role'=>"form"
        ],
        'layout' => 'horizontal',
    ]); ?>
    <!-- /.box-header -->
    <div class="box-body">
        <?php if(count($model->getFirstErrors()) > 0) { ?>
            <div class="alert alert-danger alert-dismissible">
                <?php echo $form->errorSummary($model); ?>
            </div>
        <?php }; ?>
        <?php echo $form
            ->field($model, 'name', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-sm-3',
                ],
                'inputOptions' => [
                    'type' => 'text',
                    'placeholder' =>'',
                ],
            ]
        )->label($model->getAttributeLabel('name')); ?>
        <?php echo $form
            ->field($model, 'description', [
                    'horizontalCssClasses' => [
                        'wrapper' => 'col-sm-3',
                    ],
                    'inputOptions' => [
                        'type' => 'text',
                        'placeholder' =>'',
                    ],
                ]
            )->label($model->getAttributeLabel('description')); ?>
        <?php echo $form
            ->field($model, 'ruleName', [
                'horizontalCssClasses' => [
                    'wrapper' => 'col-sm-2',
                ]
            ])
            ->dropDownList(Dictionary::getRules(), ['prompt' => '--规则--'])
            ->label($model->getAttributeLabel('ruleName')); ?>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $model->getAttributeLabel('childPermission'); ?></label>
                <div class="col-sm-8">
                    <div class="form-group">
                        <?php foreach (Yii::$app->authManager->getPermissions() as $index => $permission) {
                            if ($model->name == $index) {
                                continue;
                            }

                            echo $form->field($model, 'childPermission[]', [
                                'inputOptions' => [
                                    'type' => 'checkbox',
                                    'value' => $index,
                                    'checked' => isset($model->childPermission[$index])?'checked':false
                                ],
                                'options' => [
                                    'tag' => false
                                ],
                                'labelOptions' => ['class' => false],
                                'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n{endLabel}\n{hint}\n&nbsp;&nbsp;",
                            ])->label($permission->description);
                        } ?>
                    </div>
                </div>
            </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <?php echo Html::submitButton('提交', ['class' => 'btn btn-success pull-right']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>


<script>
    <?php $this->beginBlock('JS_END');?>
    $(function(){
        //遍历左菜单,增加active
        $("ul.sidebar-menu a").each(function(index, value){
            if($(this).attr("href")=='<?php echo Url::to(['//account/menu/index']); ?>'){
                $(this).closest("li").addClass("active").closest("ul").css("display","block").closest("li").addClass("active");
            }
        });
        if($('input[name="createPermission"]').val() == 'success'){
            setTimeout(function(){layer.msg('新建成功了呦', {icon: 6});}, 1000);
        }
        if($('input[name="updatePermission"]').val() == 'success'){
            setTimeout(function(){layer.msg('修改成功了呦', {icon: 6});}, 1000);
        }
    });
    <?php
    $this->endBlock();
    $this->registerJs($this->blocks['JS_END'],\yii\web\view::POS_END);
    ?>
</script>