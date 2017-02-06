<?php

/* @var $this yii\web\View */
/* @var $model app\modules\account\models\OperatorForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\Dictionary;

$this->title = $model->operatorId?'修改后台用户':'新建后台用户'
?>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#baseTab" data-toggle="tab" aria-expanded="true">基本信息</a></li>
        <?php if ($model->operatorId != null) { ?>
            <li class=""><a href="#avatarTab" data-toggle="tab" aria-expanded="false">头像</a></li>
        <?php } ?>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="baseTab">
            <?php $form = ActiveForm::begin([
                'action' => $model->operatorId == null?['//account/operator/create']:['//account/operator/update', 'id' => $model->operatorId, 'scenario' => 'updateBase'],
                'id' => 'updateForm',
                'enableClientValidation' => false,
                'options' => [
                    'method' => 'post',
                    'role'=>"form"
                ],
                'layout' => 'horizontal',
            ]); ?>
            <?php
            $genderTypeId = Dictionary::getDictionaryTypeIdByCode('gender');
            $statusTypeId = Dictionary::getDictionaryTypeIdByCode('status');
            ?>
            <?php if(count($model->getFirstErrors())>0){ ?>
                <div class="alert alert-danger alert-dismissible">
                    <?php echo $form->errorSummary($model); ?>
                </div>
            <?php }; ?>
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
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <?php echo Html::submitButton('提交', ['class' => 'btn btn-success']); ?>
                </div>
            </div>
            <?php echo $form->field($model, 'operatorId')->hiddenInput()->label(false); ?>
            <?php echo $form->field($model, 'updateContent', [
                'inputOptions' => [
                    'value' => 'base',
                ],
            ])->hiddenInput()->label(false); ?>
            <?php
            if (Yii::$app->session->getFlash('createOperator') == 'success'){
                echo Html::hiddenInput("createOperator", "success");
            }
            if (Yii::$app->session->getFlash('updateBase') == 'success'){
                echo Html::hiddenInput("updateBase", "success");
            }
            if (Yii::$app->session->getFlash('updateAvatar') == 'success'){
                echo Html::hiddenInput("updateAvatar", "success");
            }
            ?>
            <?php ActiveForm::end(); ?>
        </div>
        <?php if ($model->operatorId != null) { ?>
            <div class="tab-pane" id="avatarTab">
                <?php $form = ActiveForm::begin([
                    'action' => ['//account/operator/update', 'id' => $model->operatorId, 'scenario' => 'updateAvatar'],
                    'id' => 'avatarUpdateForm',
                    'enableClientValidation' => false,
                    'options' => [
                        'method' => 'post',
                        'role'=>"form"
                    ],
                    'layout' => 'horizontal',
                ]); ?>
                <?php if(count($model->getFirstErrors())>0){ ?>
                    <div class="alert alert-danger alert-dismissible">
                        <?php echo $form->errorSummary($model); ?>
                    </div>
                <?php }; ?>
                <div class="form-group field-operatorform-password">
                    <label class="control-label col-sm-3" for="operatorform-password"><?php echo $model->getAttributeLabel('avatar')?></label>
                    <div class="col-sm-3">
                        <div class="small-box bg-gray">
                            <div class="inner">
                                <img class="profile-user-img img-responsive img-circle" src="<?php echo $model->avatar; ?>" alt="用户头像">
                            </div>
                            <a href="<?php echo Url::to(['//account/operator/upload',]); ?>" class="small-box-footer" data-toggle="modal" data-target="#uploadModal">
                                更换 <i class="fa fa-exchange"></i>
                            </a>
                        </div>
                        <div class="help-block help-block-error "></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <?php echo Html::submitButton('提交', ['class' => 'btn btn-success']); ?>
                    </div>
                </div>
                <?php echo $form->field($model, 'avatar')->hiddenInput()->label(false); ?>
                <?php echo $form->field($model, 'updateContent', [
                    'inputOptions' => [
                        'value' => 'avatar',
                    ],
                ])->hiddenInput()->label(false); ?>
                <?php ActiveForm::end(); ?>
            </div>
        <?php } ?>
    </div>
    <!-- /.tab-content -->
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
        if('<?= $model->scenario ?>' == 'updateAvatar') {
            $('a[href="#baseTab"]').attr('aria-expanded', false).closest('li').attr('class', '');
            $('a[href="#avatarTab"]').attr('aria-expanded', true).closest('li').attr('class', 'active');
            $('div[id="baseTab"]').attr('class', 'tab-pane');
            $('div[id="avatarTab"]').attr('class', 'tab-pane active');
        }
        $(document).on("hidden.bs.modal", ".modal:not(.local-modal)", function (e) {
            $(e.target).removeData("bs.modal").find(".modal-content").empty();
        });
        if($('input[name="createOperator"]').val() == 'success'){
            setTimeout(function(){layer.msg('新建成功了呦', {icon: 6});}, 1000);
        }
        if($('input[name="updateBase"]').val() == 'success'){
            setTimeout(function(){layer.msg('用户信息修改成功了呦', {icon: 6});}, 1000);
        }
        if($('input[name="updateAvatar"]').val() == 'success'){
            setTimeout(function(){layer.msg('头像修改成功了呦', {icon: 6});}, 1000);
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