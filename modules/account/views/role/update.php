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
    <?php
    $dictionary = new Dictionary();
    ?>
    <?php echo $form
        ->field($model,'group', [
            'horizontalCssClasses' => [
                'wrapper' => 'col-sm-2',
            ]
        ])
        ->dropDownList($dictionary->getGroup(2), ['prompt' => '--分组--'])
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
            <label class="col-sm-3 control-label"><?php echo $model->getAttributeLabel('menu'); ?></label>
            <div class="col-sm-8">
                <?php if (($groupList = $dictionary->getGroup(1)) > 0) {
                    foreach ($groupList as $groupIndex => $group) {?>
                        <div class="form-group">
                            <div>
                                <b><?php echo $group; ?></b>
                            </div>
                            <?php if (count($menuList = $dictionary->getMenuByGroup($groupIndex)) > 0) {
                                foreach ($menuList as $menuIndex => $menu) {
                                    echo $form->field($model, 'menu[]', [
                                        'inputOptions' => [
                                            'type' => 'checkbox',
                                            'value' => $menuIndex,
                                            'checked' => in_array($menuIndex, $model->menu)?'checked':false
                                        ],
                                        'options' => [
                                            'tag' => false
                                        ],
                                        'labelOptions' => ['class' => false, 'style' => 'font-size:12px;'],
                                        'template' => "{beginLabel}\n{input}\n&nbsp;{labelTitle}\n{endLabel}\n{hint}\n&nbsp;&nbsp;",
                                    ])->label($menu);
                                }
                            } ?>
                        </div>
                    <?php }}?>
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
    });
    <?php
    $this->endBlock();
    $this->registerJs($this->blocks['JS_END'],\yii\web\view::POS_END);
    ?>
</script>