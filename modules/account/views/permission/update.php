<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
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
        <?php $form = ActiveForm::begin([
            'id' => 'updateForm',
            'enableClientValidation'=>true,
            'options' => [
                'method' => 'post',
                'role'=>"form"
            ],
            'layout' => 'horizontal',
        ]); ?>
        <div class="row">
            <div class="col-md-6">
                <?php if(count($model->getFirstErrors())>0){ ?>
                    <div class="alert alert-danger alert-dismissible">
                        <?php echo $form->errorSummary($model); ?>
                    </div>
                <?php }; ?>
                <?php
                if (Yii::$app->session->getFlash('updateOperator') == 'success'){
                    echo Html::hiddenInput("updateOperator","success",['id'=>'updateOperator']);
                }
                if (Yii::$app->session->getFlash('createOperator') == 'success'){
                    echo Html::hiddenInput("createOperator","success",['id'=>'createOperator']);
                }
                ?>
                <?php echo $form
                    ->field($model,'login',[
                        'inputOptions' => [
                            'type' => 'text',
                            'placeholder' =>'',
                        ],
                    ]
                )->label($model->getAttributeLabel('login')); ?>
                <?php echo $form
                    ->field($model,'password',[
                        'inputOptions' => [
                            'type' => 'password',
                            'placeholder' =>'',
                        ],
                    ]
                )->label($model->getAttributeLabel('password')); ?>
                <?php echo $form
                    ->field($model,'name',[
                        'inputOptions' => [
                            'type' => 'text',
                            'placeholder' => '',
                        ],
                    ]
                )->label($model->getAttributeLabel('name')); ?>
                <?php echo $form
                    ->field($model,'email',[
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
                        ['1' => '男', '2' => '女', '0' => '保密']
                    )
                    ->label($model->getAttributeLabel('gender')); ?>
                <?php echo $form
                    ->field($model,'status', [
                        'horizontalCssClasses' => [
                            'wrapper' => 'col-sm-3',
                        ]
                    ])
                    ->dropDownList([0 => '停用', 1 => '正常'], ['prompt' => '状态'])
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
        console.log($('label.radio-inline').contents());
    });
    <?php
    $this->endBlock();
    $this->registerJs($this->blocks['JS_END'],\yii\web\view::POS_END);
    ?>
</script>