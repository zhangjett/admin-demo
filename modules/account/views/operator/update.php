<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\Dictionary;
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
        $roleTypeId = Dictionary::getDictionaryTypeIdByCode('role');
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
            ->field($model, 'login', [
                    'horizontalCssClasses' => [
                        'wrapper' => 'col-sm-3',
                    ],
                    'inputOptions' => [
                        'type' => 'text',
                        'placeholder' =>'',
                    ],
            ]
        )->label($model->getAttributeLabel('login')); ?>
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
        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $model->getAttributeLabel('role'); ?></label>
            <div class="col-sm-8">
                <?php if (($groupList = Dictionary::getDictionaryItemByType($roleTypeId)) > 0) {
                    foreach ($groupList as $groupIndex => $group) {?>
                        <div class="form-group">
                            <div>
                                <b><?php echo $group; ?></b>
                            </div>
                            <?php if (count($roleList = Dictionary::getAuthItemByGroup($groupIndex, 1)) > 0) {
                                foreach ($roleList as $roleIndex => $role) {
                                    echo $form->field($model, 'role[]', [
                                        'inputOptions' => [
                                            'type' => 'checkbox',
                                            'value' => $roleIndex,
                                            'checked' => in_array($roleIndex, $model->role)?'checked':false
                                        ],
                                        'options' => [
                                            'tag' => false
                                        ],
                                        'labelOptions' => ['class' => false, 'style' => 'font-size:12px;'],
                                        'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n{endLabel}\n{hint}\n&nbsp;&nbsp;",
                                    ])->label($role);
                                }
                            } ?>
                        </div>
                    <?php }}?>
            </div>
        </div>
        <?php echo $form->field($model, 'operatorId')->hiddenInput()->label(false); ?>
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