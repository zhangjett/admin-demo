<?php

/* @var $this yii\web\View */
/* @var $model app\modules\account\models\OperatorForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\Dictionary;

$this->title = $model->operatorId?'修改后台用户':'新建后台用户'
?>
<!--<div class="box box-solid">-->
<!--    --><?php //$form = ActiveForm::begin([
//        'id' => 'updateForm',
//        'enableClientValidation'=>true,
//        'options' => [
//            'method' => 'post',
//            'role'=>"form"
//        ],
//        'layout' => 'horizontal',
//    ]); ?>
<!--    <div class="box-header with-border">-->
<!--        <h3 class="box-title">Select2</h3>-->
<!---->
<!--        <div class="box-tools pull-right">-->
<!--            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
<!--            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
<!--        </div>-->
<!--    </div>-->
<!--    <!-- /.box-header -->-->
<!--    <div class="box-body">-->
<!--        --><?php
//        $genderTypeId = Dictionary::getDictionaryTypeIdByCode('gender');
//        $statusTypeId = Dictionary::getDictionaryTypeIdByCode('status');
//        ?>
<!--        --><?php //if(count($model->getFirstErrors())>0){ ?>
<!--            <div class="alert alert-danger alert-dismissible">-->
<!--                --><?php //echo $form->errorSummary($model); ?>
<!--            </div>-->
<!--        --><?php //}; ?>
<!--        --><?php
//        if (Yii::$app->session->getFlash('updateOperator') == 'success'){
//            echo Html::hiddenInput("updateOperator", "success", ['id'=>'updateOperator']);
//        }
//        if (Yii::$app->session->getFlash('createOperator') == 'success'){
//            echo Html::hiddenInput("createOperator", "success", ['id'=>'createOperator']);
//        }
//        ?>
<!--        <div class="form-group field-operatorform-password">-->
<!--            <label class="control-label col-sm-3" for="operatorform-password">头像</label>-->
<!--            <div class="col-sm-3">-->
<!--                <img class="profile-user-img img-responsive img-circle" src="https://img11.360buyimg.com/da/jfs/t3262/212/5618686029/65604/923774e4/587732c3N1f7dc766.gif" alt="User profile picture">-->
<!--                <div class="help-block help-block-error "></div>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--        --><?php //echo $form
//            ->field($model, 'username', [
//                    'horizontalCssClasses' => [
//                        'wrapper' => 'col-sm-3',
//                    ],
//                    'inputOptions' => [
//                        'type' => 'text',
//                        'placeholder' =>'',
//                    ],
//            ]
//        )->label($model->getAttributeLabel('username')); ?>
<!--        --><?php //echo $form
//            ->field($model, 'password', [
//                    'horizontalCssClasses' => [
//                        'wrapper' => 'col-sm-3',
//                    ],
//                    'inputOptions' => [
//                        'type' => 'password',
//                        'placeholder' =>'',
//                    ],
//            ]
//        )->label($model->getAttributeLabel('password')); ?>
<!--        --><?php //echo $form
//            ->field($model, 'name', [
//                    'horizontalCssClasses' => [
//                        'wrapper' => 'col-sm-3',
//                    ],
//                    'inputOptions' => [
//                        'type' => 'text',
//                        'placeholder' => '',
//                    ],
//            ]
//        )->label($model->getAttributeLabel('name')); ?>
<!--        --><?php //echo $form
//            ->field($model, 'email', [
//                    'horizontalCssClasses' => [
//                        'wrapper' => 'col-sm-3',
//                    ],
//                    'inputOptions' => [
//                        'type' => 'text',
//                        'placeholder' => '',
//                    ],
//            ]
//        )->label($model->getAttributeLabel('email')); ?>
<!--        --><?php //echo $form
//            ->field($model, 'gender')
//            ->inline()
//            ->radioList(
//                Dictionary::getDictionaryItemByType($genderTypeId)
//            )
//            ->label($model->getAttributeLabel('gender')); ?>
<!--        --><?php //echo $form
//            ->field($model, 'status', [
//                    'horizontalCssClasses' => [
//                        'wrapper' => 'col-sm-2',
//                    ]
//            ])
//            ->dropDownList(Dictionary::getDictionaryItemByType($statusTypeId), ['prompt' => '状态'])
//            ->label($model->getAttributeLabel('status')); ?>
<!--        --><?php //echo $form->field($model, 'operatorId')->hiddenInput()->label(false); ?>
<!--    </div>-->
<!--    <!-- /.box-body -->-->
<!--    <div class="box-footer">-->
<!--        --><?php //echo Html::button('启动', ['class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#uploadModal', 'href' => Url::to(['//account/operator/upload',])]); ?>
<!--        --><?php //echo Html::submitButton('提交', ['class' => 'btn btn-success pull-right']); ?>
<!--    </div>-->
<!--    --><?php //ActiveForm::end(); ?>
<!--</div>-->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">基本信息</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">头像</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <?php $form = ActiveForm::begin([
                'id' => 'updateForm',
                'enableClientValidation'=>true,
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
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <?php echo Html::submitButton('提交', ['class' => 'btn btn-success']); ?>
                </div>
            </div>
            <?php echo $form->field($model, 'operatorId')->hiddenInput()->label(false); ?>
            <?php ActiveForm::end(); ?>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
            <?php $form = ActiveForm::begin([
                'id' => 'updateForm——1',
                'enableClientValidation'=>true,
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
            <?php
            if (Yii::$app->session->getFlash('updateOperator') == 'success'){
                echo Html::hiddenInput("updateOperator", "success", ['id'=>'updateOperator']);
            }
            if (Yii::$app->session->getFlash('createOperator') == 'success'){
                echo Html::hiddenInput("createOperator", "success", ['id'=>'createOperator']);
            }
            ?>
            <div class="form-group field-operatorform-password">
                <label class="control-label col-sm-3" for="operatorform-password">头像</label>
                <div class="col-sm-3">
                    <div class="small-box bg-gray">
                        <div class="inner">
                            <img class="profile-user-img img-responsive img-circle" src="https://img11.360buyimg.com/da/jfs/t3262/212/5618686029/65604/923774e4/587732c3N1f7dc766.gif" alt="User profile picture">
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
                    <?php echo Html::button('启动', ['class' => 'btn btn-success pull-right', 'data-toggle' => 'modal', 'data-target' => '#uploadModal', 'href' => Url::to(['//account/operator/upload',])]); ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
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