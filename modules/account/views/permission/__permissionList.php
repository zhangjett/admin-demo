<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;

if (Yii::$app->session->getFlash('deletePermission') == 'success') {
    echo Html::hiddenInput("deletePermission", "success");
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
                <th>权限名称</th>
                <th>描述</th>
                <th>规则</th>
                <th>修改时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($permissionList) > 0) {
            foreach (array_values($permissionList) as $index => $permission) { ; ?>
                <tr>
                    <td><?php echo ++$index; ?></td>
                    <td><a href="javascript:void(0);"><?php echo $permission->name; ?></a></td>
                    <td><?php echo $permission->description; ?></td>
                    <td><?php echo $permission->ruleName; ?></td>
                    <td><?php echo date("Y-m-d H:i:s", $permission->updatedAt); ?></td>
                    <td>
                        <span class="label label-success edit" href="<?php echo Url::to(['//account/permission/update','name'=>$permission->name]); ?>">编辑</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="label label-success add-child" href="<?php echo Url::to(['//account/permission/add-child','name'=>$permission->name]); ?>">子权限</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="label label-danger delete" href="<?php echo Url::to(['//account/permission/delete','name'=>$permission->name]); ?>">删除</span>
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
<script>
    <?php $this->beginBlock('LIST_JS_END');?>
    $(function(){
        if($('input[name="deletePermission"]').val() == 'success'){
            setTimeout(function(){layer.msg('删除成功了呦', {icon: 6});}, 1000);
        }
    });
    <?php
    $this->endBlock();
    $this->registerJs($this->blocks['LIST_JS_END'],\yii\web\view::POS_END);
    ?>
</script>