<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<div class="row">
    <!-- /.col -->
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Inbox</h3>
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
        $(document).on("click","table tr td span.delete",function(){
            window.open($(this).attr("href"));
        });


        //删除
        $(document).on("click","table tr td span.add-child",function(){
            tool.ajax({
                url:$(this).attr("href"),
                data:$('#searchForm').serialize(),
                dataType:'html',
                success:function(response){
                    console.log(response);
                }
            });
        });

    });
    <?php
    $this->endBlock();
    $this->registerJs($this->blocks['JS_END'],\yii\web\view::POS_END);
    ?>
</script>
