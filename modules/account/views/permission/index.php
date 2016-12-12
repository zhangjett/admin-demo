<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<div class="row">
    <!-- /.col -->
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <?php $form = ActiveForm::begin([
                    'id' => 'searchForm',
                    'enableClientValidation' => true,
                    'options' => [
                        'method' => 'post',
                        'role' => "form"
                    ],
                    'layout' => 'inline',
                ]); ?>
                <?php echo $form
                    ->field($model,'status', [])
                    ->dropDownList(['1' => '正常', '2' => '删除'], ['prompt' => '选择状态'])
                    ->label($model->getAttributeLabel('status'));
                ?>
                &nbsp;&nbsp;
                <?php echo $form
                    ->field($model,'filter',[
                            'inputOptions' => [
                                'placeholder' =>'search...',
                            ],
                            'inputTemplate' => '<div class="has-feedback">{input}<span class="glyphicon glyphicon-search form-control-feedback"></span></div>'
                        ]
                    )
                    ->label($model->getAttributeLabel('filter')); ?>
                <?php ActiveForm::end(); ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding list-box">
                <?php echo $content; ?>
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
            <!-- /...-->
            </div>
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->
</div>
<script>
    <?php $this->beginBlock('JS_END');?>
    $(function(){
        $('.box-body').on("click",".mailbox-controls button.add",function(){
            var url = '<?php echo Url::to(['//account/permission/create']); ?>';
            window.open(url);
        });
        //翻页
        $('.box-body').on("click",".pull-right .btn-group button",function(){
            tool.ajax({
                url:$(this).attr("href"),
                data:$('#searchForm').serialize(),
                dataType:'html',
                success:function(response){
                    $(".list-box").html(response);
                    $(document).trigger('icheck');
                }
            });
        });
        //刷新
        $('.box-body').on("click",".mailbox-controls button.refresh",function(){
            tool.ajax({
                url:$(this).attr("href"),
                data:$('#searchForm').serialize(),
                dataType:'html',
                success:function(response){
                    $(".list-box").html(response);
                    $(document).trigger('icheck');
                }
            });
        });
    });
    <?php
    $this->endBlock();
    $this->registerJs($this->blocks['JS_END'],\yii\web\view::POS_END);
    ?>
</script>
