<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = '角色列表'
?>
<div class="row">
    <!-- /.col -->
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">角色列表</h3>
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
<div class="modal fade" id="addChild" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<script>
    <?php $this->beginBlock('JS_END');?>
    $(function(){
        $("#addChild").on("hidden.bs.modal", function() {
            $(this).removeData("bs.modal");
        });
        $(document).on("click",".mailbox-controls button.add",function(){
            var url = '<?php echo Url::to(['//account/role/create']); ?>';
            window.open(url);
        });
        //刷新
        $(document).on("click",".mailbox-controls button.refresh",function(){
            window.location.reload();
        });
        //编辑
        $(document).on("click","table tr td span.edit",function(){
            window.open($(this).attr("href"));
        });
        //删除
        $(document).on("click","table tr td span.delete",function(){
            window.open($(this).attr("href"));
        });
        //添加权限/子角色
        $(document).on('submit','#updateChildForm',function(e){
            tool.ajax({
                type:"POST",
                url:$(this).attr('action'),
                data:$(this).serialize(),
                dataType:'html',
                success:function(response){
                    $('#addChild').find("div.modal-content").html(response);
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
