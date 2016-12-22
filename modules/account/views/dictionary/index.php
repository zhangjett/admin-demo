<?php
use yii\helpers\Url;
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
<!-- Modal -->
<div class="modal fade" id="updateDictionaryModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<script>
    <?php $this->beginBlock('JS_END');?>
    $(function(){
        $("#updateDictionaryModal").on("hidden.bs.modal", function() {
            $(this).removeData("bs.modal");
            $('div.mailbox-controls button.refresh').trigger('click');
        });
        $(document).on("click","table tr td span.item",function(){
            window.open($(this).attr("href"));
        });
        $(document).on("click",".mailbox-controls button.add",function(){
            var remoteUrl = '<?php echo Url::to(['//account/dictionary/create']); ?>';
            $('#updateDictionaryModal').modal({
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
        $(document).on('submit','#updateDictionaryType',function(e){
            tool.ajax({
                url:$(this).attr('action'),
                data:$(this).serialize(),
                dataType:'html',
                success:function(response){
                    $('#updateDictionaryModal').find("div.modal-content").html(response);
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
