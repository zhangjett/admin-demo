<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\App;
?>
<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Select2</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <?php $form = ActiveForm::begin([
                'id' => 'updateForm',
                'enableClientValidation'=>true,
                'options' => [
                    'method' => 'post',
                    'role'=>"form"
                ],
                'layout' => 'horizontal',
            ]); ?>
            <div class="col-md-6">
                <?php if(count($model->getFirstErrors())>0){ ?>
                    <div class="alert alert-danger alert-dismissible">
                        <?php echo $form->errorSummary($model); ?>
                    </div>
                <?php }; ?>
                <?php
                if (Yii::$app->session->getFlash('updatePermission') == 'success'){
                    echo Html::hiddenInput("updateOperator","success",['id'=>'updatePermission']);
                }
                if (Yii::$app->session->getFlash('createPermission') == 'success'){
                    echo Html::hiddenInput("createOperator","success",['id'=>'createPermission']);
                }
                ?>
                <?php
                    $app = new App()
                ?>
                <?php echo $form
                    ->field($model,'name',[
                        'inputOptions' => [
                            'type' => 'text',
                            'placeholder' =>'',
                        ],
                    ]
                )->label($model->getAttributeLabel('name')); ?>
                <?php echo $form
                    ->field($model,'module', [
                        'horizontalCssClasses' => [
//                            'wrapper' => 'col-sm-4',
                        ]
                    ])
                    ->dropDownList($app->getAppModule(), ['prompt' => '---module---'])
                    ->label($model->getAttributeLabel('module')); ?>
                <?php echo $form
                    ->field($model,'controller', [
                        'horizontalCssClasses' => [
//                            'wrapper' => 'col-sm-4',
                        ]
                    ])
                    ->dropDownList($app->getAppModuleController(), ['prompt' => '---controller---', 'disabled' => 'disabled'])
                    ->label($model->getAttributeLabel('controller')); ?>
                <?php echo $form
                    ->field($model,'action', [
                        'horizontalCssClasses' => [
//                            'wrapper' => 'col-sm-4',
                        ]
                    ])
                    ->dropDownList($app->getAppModuleControllerAction(), ['prompt' => '---action---', 'disabled' => 'disabled'])
                    ->label($model->getAttributeLabel('action')); ?>
                <?php echo $form
                    ->field($model,'status', [
                        'horizontalCssClasses' => [
//                            'wrapper' => 'col-sm-3',
                        ]
                    ])
                    ->dropDownList([1 => '正常', 2 => '停用'], ['prompt' => '--状态--'])
                    ->label($model->getAttributeLabel('status')); ?>
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Multiple</label>
                    <select class="form-control" multiple="">
                        <option>Alabama</option>
                        <option>Alaska</option>
                        <option>California</option>
                        <option>Delaware</option>
                        <option>Tennessee</option>
                        <option>Texas</option>
                        <option>Washington</option>
                    </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Disabled Result</label>
                    <select class="form-control">
                        <option selected="selected">Alabama</option>
                        <option>Alaska</option>
                        <option disabled="disabled">California (disabled)</option>
                        <option>Delaware</option>
                        <option>Tennessee</option>
                        <option>Texas</option>
                        <option>Washington</option>
                    </select>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-success pull-right">提交</button>
    </div>
</div>
<script>
    <?php $this->beginBlock('JS_END');?>
    $(function(){
        $("#permissionform-module").on("change", function(){
            if($(this).val() != "") {
                $("#permissionform-controller").attr("disabled",false);
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
                $("#permissionform-action").attr("disabled",false);
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