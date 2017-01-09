<?php

/* @var $content */

use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<div class="row">
    <!-- /.col -->
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">字典列表</h3>
                <div class="box-tools pull-right">
                    <?php $form = ActiveForm::begin([
                        'id' => 'searchForm',
                        'enableClientValidation' => true,
                        'options' => [
                            'method' => 'post',
                            'role' => "form"
                        ],
                        'layout' => 'inline',
                    ]); ?>
                    <?php echo $form->field($model, 'typeId')->hiddenInput()->label(false); ?>
                    <?php ActiveForm::end(); ?>
                </div>
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
<div class="modal fade" id="updateDictionaryItemModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<script>
    <?php $this->beginBlock('JS_END');?>
    $(function(){
        $("ul.sidebar-menu a").each(function(index,value){
            if($(this).attr("href")=='<?php echo Url::to(['//account/dictionary/index']); ?>'){
                $(this).closest("li").addClass("active").closest("ul").css("display","block").closest("li").addClass("active");
            }
        });
        $("#updateDictionaryItemModal").on("hidden.bs.modal", function() {
            $(this).removeData("bs.modal");
            $('div.mailbox-controls button.refresh').trigger('click');
        });
        $(document).on("click",".mailbox-controls button.add",function(){
            var remoteUrl = '<?php echo Url::to(['//account/dictionary-item/create']); ?>';
            $('#updateDictionaryItemModal').modal({
                remote: remoteUrl
            });
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
        //编辑
        $(document).on('submit','#updateDictionaryItem',function(e){
            $('input[name="DictionaryItemForm[typeId]"]').val($('input[name="DictionaryItemSearchForm[typeId]"]').val());
            tool.ajax({
                url:$(this).attr('action'),
                data:$(this).serialize(),
                dataType:'html',
                success:function(response){
                    $('#updateDictionaryItemModal').find("div.modal-content").html(response);
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
