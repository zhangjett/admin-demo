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
<div class="modal fade" id="updateDictionaryItemModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<script>
    <?php $this->beginBlock('JS_END');?>
    $(function(){
        $("#updateDictionaryItemModal").on("hidden.bs.modal", function() {
            $(this).removeData("bs.modal");
        });
        $('.box-body').on("click",".mailbox-controls button.add",function(){
            var url = '<?php echo Url::to(['//account/menu/create']); ?>';
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
        //编辑
        $(document).on('submit','#updateDictionaryItem',function(e){
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
