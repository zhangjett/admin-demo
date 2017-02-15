<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;

if (Yii::$app->session->getFlash('deleteRole') == 'success') {
    echo Html::hiddenInput("deleteRole", "success");
}

?>
<div class="mailbox-controls">
    <button type="button" class="btn btn-default btn-sm refresh"><i class="fa fa-refresh"></i></button>
    <button type="button" class="btn btn-default btn-sm add"><i class="fa fa-plus"></i></button>
</div>
<div class="table-responsive mailbox-messages">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>角色名称</th>
                <th>描述</th>
                <th>规则</th>
                <th>修改时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($roleList) > 0) {
            foreach (array_values($roleList) as $index => $role) { ; ?>
                <tr>
                    <td><?php echo ++$index; ?></td>
                    <td><a href="javascript:void(0);"><?php echo $role->name; ?></a></td>
                    <td><?php echo $role->description; ?></td>
                    <td><?php echo $role->ruleName; ?></td>
                    <td><?php echo date("Y-m-d H:i:s", $role->updatedAt); ?></td>
                    <td>
                        <span class="label label-success edit" href="<?php echo Url::to(['//account/role/update', 'name'=>$role->name]); ?>">编辑</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="label label-success add-child" href="<?php echo Url::to(['//account/role/add-child','name'=>$role->name]); ?>">权限/子角色</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="label label-danger delete" href="<?php echo Url::to(['//account/role/delete', 'name'=>$role->name]); ?>">删除</span>
                    </td>
                </tr>
            <?php }
        }; ?>
        </tbody>
    </table>
    <!-- /.table -->
</div>
<div class="mailbox-controls">
    <button type="button" class="btn btn-default btn-sm refresh"><i class="fa fa-refresh"></i></button>
    <button type="button" class="btn btn-default btn-sm add"><i class="fa fa-plus"></i></button>
</div>