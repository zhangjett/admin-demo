<?php

/* @var $this yii\web\View */
/* @var $content string */

use yii\helpers\Url;

$this->title = '权限列表'
?>
<div class="row">
    <!-- /.col -->
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">权限列表</h3>
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
            var url = '<?php echo Url::to(['//account/permission/create']); ?>';
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
        $( document).on("click","table tr td span.delete",function(){
            window.open($(this).attr("href"));
        });
        //添加子权限
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


//        //删除
//        $(document).on("click","table tr td span.add-child",function(){
//            tool.ajax({
//                url:$(this).attr("href"),
//                data:$('#searchForm').serialize(),
//                dataType:'html',
//                success:function(response){
//                    console.log(response);
//                }
//            });
//        });

    });
    <?php
    $this->endBlock();
    $this->registerJs($this->blocks['JS_END'],\yii\web\view::POS_END);
    ?>
</script>
