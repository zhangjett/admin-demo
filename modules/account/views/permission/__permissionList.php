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
                <th>权限名称</th>
                <th>权限路由</th>
                <th>类别</th>
                <th>修改时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if (is_array($permissionList) && count($permissionList) > 0) {
            foreach ($permissionList as $index => $permission) { ; ?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $permission['permissionId']; ?>"></td>
                    <td><?php echo $permission['name']; ?></td>
                    <td><a href="javascript:void(0);"><?php echo $permission['description']; ?></a></td>
                    <td><?php echo $permission['groupName']; ?></td>
                    <td><?php echo $permission['updateTime']; ?></td>
                    <td><span class="label <?php echo (int)$permission['status']==1?'label-success':'label-danger';?>"><?php echo (int)$permission['status']==1?'正常':'停用'; ?></span></td>
                    <td>
                        <span class="label label-success edit" data="<?php echo $permission['permissionId']; ?>" href="<?php echo Url::to(['//account/operator/update','id'=>$permission['permissionId']]); ?>">编辑</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="label label-danger delete" data="<?php echo $permission['permissionId']; ?>" href="<?php echo Url::to(['//account/operator/update','id'=>$permission['permissionId']]); ?>"><?php echo $permission['status']==0?"恢复":"停用"?></span>
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