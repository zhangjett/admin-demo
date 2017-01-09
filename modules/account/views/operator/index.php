<?php

/* @var $model app\modules\account\models\OperatorForm */
/* @var $content */

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
                        'method' => 'POST',
                        'role' => "form"
                    ],
                    'layout' => 'inline',
                ]); ?>
                <?php echo $form
                    ->field($model, 'status', [])
                    ->dropDownList(['1' => '正常', '2' => '正常'], ['prompt' => '选择状态'])
                    ->label($model->getAttributeLabel('status'));
                ?>
                &nbsp;&nbsp;
                <?php echo $form
                    ->field($model, 'type', [])
                    ->dropDownList(['0' => '账号', '1' => '姓名'], ['prompt' => '选择类型'])
                    ->label($model->getAttributeLabel('type'));
                ?>
                <?php echo $form
                    ->field($model, 'filter', [
                            'horizontalCssClasses' => [
                                'wrapper' => 'col-sm-3',
                            ],
                            'inputOptions' => [
                                'type' => 'text',
                                'placeholder' =>'search...',
                            ],
                            'inputTemplate' => "<div class=\"input-group\">\n{input}\n<div class=\"input-group-btn\">\n<button type=\"submit\" class=\"btn btn-default\">\n<i class=\"fa fa-search\">\n</i>\n</button>\n</div>\n</div>"
                        ]
                    )->label($model->getAttributeLabel('filter')); ?>
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
<div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<script>
    <?php $this->beginBlock('JS_END');?>
    $(function(){
        $("#assignModal").on("hidden.bs.modal", function() {
            $(this).removeData("bs.modal");
        });
        $(document).on("click",".mailbox-controls button.add",function(){
            var url = '<?php echo Url::to(['//account/operator/create']); ?>';
            window.open(url);
        });
        //翻页
        $(document).on("click",".pull-right .btn-group button",function(){
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
        $(document).on("click",".mailbox-controls button.refresh",function(){
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
        $(document).on("click","table tr td span.edit",function(){
            window.open($(this).attr("href"));
        });
        //分配角色
        $(document).on('submit','#assignForm',function(e){
            tool.ajax({
                type:"POST",
                url:$(this).attr('action'),
                data:$(this).serialize(),
                dataType:'html',
                success:function(response){
                    $('#assignModal').find("div.modal-content").html(response);
                }
            });
            e.preventDefault();
        });
        /**
         * 搜索
         */
        $(document).on("submit","#searchForm",function(e){
            var url='<?php echo Url::to(['//account/operator/index'])?>';
            tool.ajax({
                type:'POST',
                url:url,
                data:$("#searchForm").serialize(),
                dataType:'html',
                success:function(response){
                    $(".list-box").html(response);
                    $(document).trigger('icheck');
                }
            });
            e.preventDefault();
        });
    });
    <?php
    $this->endBlock();
    $this->registerJs($this->blocks['JS_END'],\yii\web\view::POS_END);
    ?>
</script>
