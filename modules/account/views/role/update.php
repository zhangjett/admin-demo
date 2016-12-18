<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\App;
use app\components\Dictionary;
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
    <?php if(count($model->getFirstErrors()) > 0){ ?>
        <div class="alert alert-danger alert-dismissible">
            <?php echo $form->errorSummary($model); ?>
        </div>
    <?php }; ?>
    <?php
    if (Yii::$app->session->getFlash('createRole') == 'success'){
        echo Html::hiddenInput("createOperator","success",['id'=>'createRole']);
    }
    if (Yii::$app->session->getFlash('updateRole') == 'success'){
        echo Html::hiddenInput("updateOperator","success",['id'=>'updateRole']);
    }

    ?>
    <?php
        $app = new App();
        $dictionary = new Dictionary();
    ?>
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
<!--    --><?php //echo $form
//        ->field($model,'module', [
//            'horizontalCssClasses' => [
//                'wrapper' => 'col-sm-3',
//            ]
//        ])
//        ->dropDownList($app->getAppModule(), ['prompt' => '---module---'])
//        ->label($model->getAttributeLabel('module')); ?>
<!--    --><?php //echo $form
//        ->field($model,'controller', [
//            'horizontalCssClasses' => [
//                'wrapper' => 'col-sm-3',
//            ]
//        ])
//        ->dropDownList($app->getAppModuleController(), ['prompt' => '---controller---'])
//        ->label($model->getAttributeLabel('controller')); ?>
<!--    --><?php //echo $form
//        ->field($model,'action', [
//            'horizontalCssClasses' => [
//                'wrapper' => 'col-sm-3',
//            ]
//        ])
//        ->dropDownList($app->getAppModuleControllerAction(), ['prompt' => '---action---'])
//        ->label($model->getAttributeLabel('action')); ?>
    <?php echo $form
        ->field($model,'group', [
            'horizontalCssClasses' => [
                'wrapper' => 'col-sm-2',
            ]
        ])
        ->dropDownList($dictionary->getGroup(), ['prompt' => '--分组--'])
        ->label($model->getAttributeLabel('group')); ?>
    <?php echo $form
        ->field($model,'status', [
            'horizontalCssClasses' => [
                'wrapper' => 'col-sm-2',
            ]
        ])
        ->dropDownList([1 => '正常', 2 => '停用'], ['prompt' => '--状态--'])
        ->label($model->getAttributeLabel('status')); ?>
        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $model->getAttributeLabel('permission'); ?></label>
            <div class="col-sm-8">
                <div class="form-group">
                    <div>
                        <b>1</b>
                    </div>
                <?php
                echo $form->field($model, 'permission[]', [
                    'inputOptions' => [
                        'type' => 'checkbox'
                    ],
                    'options' => [
                        'tag' => false
                    ],
                    'labelOptions' => ['class' => false, 'style' => 'font-size:12px;'],
                    'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n{endLabel}\n{hint}\n&nbsp;&nbsp;",
                ])->label('猜想');
                echo $form->field($model, 'permission[]', [
                    'inputOptions' => [
                        'type' => 'checkbox'
                    ],
                    'options' => [
                        'tag' => false
                    ],
                    'labelOptions' => ['class' => false, 'style' => 'font-size:12px;'],
                    'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n{endLabel}\n{hint}\n&nbsp;&nbsp;",
                ])->label('违法');
                echo $form->field($model, 'permission[]', [
                    'inputOptions' => [
                        'type' => 'checkbox'
                    ],
                    'options' => [
                        'tag' => false
                    ],
                    'labelOptions' => ['class' => false, 'style' => 'font-size:12px;'],
                    'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n{endLabel}\n{hint}\n&nbsp;&nbsp;",
                ])->label('风格豆腐干方便');
                echo $form->field($model, 'permission[]', [
                    'inputOptions' => [
                        'type' => 'checkbox'
                    ],
                    'options' => [
                        'tag' => false
                    ],
                    'labelOptions' => ['class' => false, 'style' => 'font-size:12px;'],
                    'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n{endLabel}\n{hint}\n&nbsp;&nbsp;",
                ])->label('的方式方式');
                echo $form->field($model, 'permission[]', [
                    'inputOptions' => [
                        'type' => 'checkbox'
                    ],
                    'options' => [
                        'tag' => false
                    ],
                    'labelOptions' => ['class' => false, 'style' => 'font-size:12px;'],
                    'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n{endLabel}\n{hint}\n&nbsp;&nbsp;",
                ])->label('豆腐干地方打工的地方官梵蒂冈的个地方');
                echo $form->field($model, 'permission[]', [
                    'inputOptions' => [
                        'type' => 'checkbox'
                    ],
                    'options' => [
                        'tag' => false
                    ],
                    'labelOptions' => ['class' => false, 'style' => 'font-size:12px;'],
                    'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n{endLabel}\n{hint}\n&nbsp;&nbsp;",
                ])->label('发射点发射点发生');
                echo $form->field($model, 'permission[]', [
                    'inputOptions' => [
                        'type' => 'checkbox'
                    ],
                    'options' => [
                        'tag' => false
                    ],
                    'labelOptions' => ['class' => false, 'style' => 'font-size:12px;'],
                    'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n{endLabel}\n{hint}\n&nbsp;&nbsp;",
                ])->label('固定格式规范的规定规范的规定的');
                echo $form->field($model, 'permission[]', [
                    'inputOptions' => [
                        'type' => 'checkbox'
                    ],
                    'options' => [
                        'tag' => false
                    ],
                    'labelOptions' => ['class' => false, 'style' => 'font-size:12px;'],
                    'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n{endLabel}\n{hint}\n&nbsp;&nbsp;",
                ])->label('试试但是犯得上电风扇');
                echo $form->field($model, 'permission[]', [
                    'inputOptions' => [
                        'type' => 'checkbox'
                    ],
                    'options' => [
                        'tag' => false
                    ],
                    'labelOptions' => ['class' => false, 'style' => 'font-size:12px;'],
                    'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n{endLabel}\n{hint}\n&nbsp;&nbsp;",
                ])->label('分身乏术');
                echo $form->field($model, 'permission[]', [
                    'inputOptions' => [
                        'type' => 'checkbox'
                    ],
                    'options' => [
                        'tag' => false
                    ],
                    'labelOptions' => ['class' => false, 'style' => 'font-size:12px;'],
                    'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n{endLabel}\n{hint}\n&nbsp;&nbsp;",
                ])->label('大幅度的地方不大');
                ?>

                </div>
                <div class="form-group">
                    <div>
                        <b>111</b>
                    </div>
                    <label>
                        <input type="checkbox" class="flat-red" checked>
                        Flat green skin checkbox
                    </label>
                    <label>
                        <input type="checkbox" class="flat-red">
                        Flat green skin checkbox
                    </label>
                    <label>
                        <input type="checkbox" class="flat-red" disabled>
                        Flat green skin checkbox
                    </label>
                    <label>
                        <input type="checkbox" class="flat-red" disabled>
                        Flat green skin checkbox
                    </label>
                    <label>
                        <input type="checkbox" class="flat-red" disabled>
                        Flat green skin
                    </label>
                    <label>
                        <input type="checkbox" class="flat-red" disabled>
                        Flat green skin checkbox checkbox
                    </label>
                    <label>
                        <input type="checkbox" class="flat-red" disabled>
                        Flat green skin checkbox checkbox
                    </label>
                </div>
            </div>
        </div>
    <?php echo $form->field($model, 'roleId')->hiddenInput()->label(false); ?>
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
        if(($('#createRole').length > 0) && ($('#createRole').val() == 'success')){
            setTimeout(function(){layer.msg('新建成功了呦', {icon: 6});}, 1000);
        }
        if(($('#updateRole').length > 0) && ($('#updateRole').val() == 'success')){
            setTimeout(function(){layer.msg('修改成功了呦', {icon: 6});}, 1000);
        }
        $("#permissionform-module").on("change", function(){
            if($(this).val() != "") {
                $.each($("#permissionform-controller").find("optgroup"), function () {
                    if ($(this).attr('label') == $("#permissionform-module").val()) {
                        $(this).css('display', 'inline');
                        return true;
                    }
                    $(this).css('display', 'none');
                });
            }
        });

        $("#permissionform-controller").on("change", function(){
            if($(this).val() != "") {
                $.each($("#permissionform-action").find("optgroup"), function () {
                    if ($(this).attr('label') == ($("#permissionform-module").val()+'-'+$("#permissionform-controller").val())) {
                        $(this).css('display', 'inline');
                        return true;
                    }
                    $(this).css('display', 'none');
                });
            }
        });
    });
    <?php
    $this->endBlock();
    $this->registerJs($this->blocks['JS_END'],\yii\web\view::POS_END);
    ?>
</script>