<?php
use app\components\LinkPager;
use yii\helpers\Url;
?>
<div class="mailbox-controls">
    <button type="button" class="btn btn-default btn-sm refresh" href="<?php echo Url::current(); ?>"><i class="fa fa-refresh"></i></button>
    <button type="button" class="btn btn-default btn-sm add"><i class="fa fa-plus"></i></button>
</div>
<div class="table-responsive mailbox-messages">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>名称</th>
                <th>路由</th>
                <th>类别</th>
                <th>修改时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($permissionList) > 0) {
            foreach (array_values($permissionList) as $index => $permission) { ; ?>
                <tr>
                    <td><?php echo ++$index; ?></td>
                    <td><?php echo $permission->name; ?></td>
                    <td><a href="javascript:void(0);"><?php echo $permission->description; ?></a></td>
                    <td><?php echo $permission->name; ?></td>
                    <td><?php echo $permission->name; ?></td>
                    <td>
                        <span class="label label-success edit" href="<?php echo Url::to(['//account/permission/update','name'=>$permission->name]); ?>">编辑</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="label label-danger delete" href="<?php echo Url::to(['//account/permission/update','name'=>$permission->name]); ?>"><?php echo $permission->name==0?"恢复":"停用"?></span>
                    </td>
                </tr>
            <?php }
        }; ?>
        </tbody>
    </table>
    <!-- /.table -->
</div>
<div class="mailbox-controls">
    <button type="button" class="btn btn-default btn-sm refresh" href="<?php echo Url::current(); ?>"><i class="fa fa-refresh"></i></button>
    <button type="button" class="btn btn-default btn-sm add"><i class="fa fa-plus"></i></button>
</div>