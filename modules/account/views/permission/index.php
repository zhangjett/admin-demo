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
        $(document).on("click","table tr td span.add-child",function(){
            tool.ajax({
                type:"GET",
                url:$(this).attr('href'),
                dataType:'html',
                success:function(response){
                    layer.open({
                        type: 1,
                        title: '添加子权限',
                        content: response
                    });
                }
            });

        });
        //添加子权限
        $(document).on('submit','#updateChildForm',function(e){
            var obj = $(this);
            tool.ajax({
                type:"POST",
                url:$(this).attr('action'),
                data:$(this).serialize(),
                dataType:'html',
                success:function(response){
                    obj.closest('div.layui-layer-content').html(response);
                    window.setTimeout(function() {
                        $('.alert').alert('close');
                    }, 3000);
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
