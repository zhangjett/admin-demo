<?php
use app\components\LinkPager;
use yii\helpers\Url;
?>
<div class="mailbox-controls">
    <!-- Check all button -->
    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
    </button>
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
    </div>
    <!-- /.btn-group -->
    <button type="button" class="btn btn-default btn-sm refresh" href="<?php echo Url::current(['page' => (int)$pages->page+1,'per-page'=>$pages->pageSize]); ?>"><i class="fa fa-refresh"></i></button>
    <button type="button" class="btn btn-default btn-sm add"><i class="fa fa-plus"></i></button>
    <div class="pull-right">
        <?php echo ($pages->getOffset()+1).'-'.($pages->getOffset()+$pages->getPageSize()).'/'.$pages->totalCount; ?>
        <?php
        echo LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>
    </div>
    <!-- /.pull-right -->
</div>
<div class="table-responsive mailbox-messages">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>类型编码</th>
                <th>类型名称</th>
                <th>修改时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if (is_array($dictionaryTypeList) && count($dictionaryTypeList) > 0) {
            foreach ($dictionaryTypeList as $index => $dictionaryType) { ; ?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $dictionaryType['typeId']; ?>"></td>
                    <td><?php echo $dictionaryType['typeId']; ?></td>
                    <td><?php echo $dictionaryType['code']; ?></td>
                    <td><a href="javascript:void(0);"><?php echo $dictionaryType['name']; ?></a></td>
                    <td><?php echo date("Y-m-d H:i:s", $dictionaryType['updatedAt']); ?></td>
                    <td>
                        <span class="label label-success item" href="<?php echo Url::to(['//account/dictionary-item/index','typeId'=>$dictionaryType['typeId']]); ?>">字典内容</span>&nbsp;
                        <span class="label label-success edit" href="<?php echo Url::to(['//account/dictionary/update','id'=>$dictionaryType['typeId']]); ?>" data-toggle="modal" data-target="#updateDictionaryModal">编辑</span>
                    </td>
                </tr>
            <?php }
        }; ?>
        </tbody>
    </table>
    <!-- /.table -->
</div>
<div class="mailbox-controls">
    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
    </button>
    <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
    </div>
    <button type="button" class="btn btn-default btn-sm refresh" href="<?php echo Url::current(['page' => (int)$pages->page+1,'per-page'=>$pages->pageSize]); ?>"><i class="fa fa-refresh"></i></button>
    <button type="button" class="btn btn-default btn-sm add"><i class="fa fa-plus"></i></button>
    <div class="pull-right">
        <?php echo ($pages->getOffset()+1).'-'.($pages->getOffset()+$pages->getPageSize()).'/'.$pages->totalCount; ?>
        <?php
        echo LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>
    </div>
    <!-- /.pull-right -->
</div>