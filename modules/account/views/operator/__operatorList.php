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
                <th>账号</th>
                <th>姓名</th>
                <th>电子邮箱</th>
                <th>修改时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if (is_array($operatorList) && count($operatorList) > 0) {
            foreach ($operatorList as $index => $operator) { ; ?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $operator['operatorId']; ?>"></td>
                    <td><a href="javascript:void(0);"><?php echo $operator['username']; ?></a></td>
                    <td><?php echo $operator['name']; ?></td>
                    <td><?php echo $operator['email']; ?></td>
                    <td><?php echo $operator['updateTime']; ?></td>
                    <td><span class="label <?php echo (int)$operator['status']==1?'label-success':'label-danger';?>"><?php echo (int)$operator['status']==1?'正常':'停用'; ?></span></td>
                    <td>
                        <span class="label label-success edit" href="<?php echo Url::to(['//account/operator/update','id'=>$operator['operatorId']]); ?>">编辑</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="label label-success assign" href="<?php echo Url::to(['//account/operator/assign','id'=>$operator['operatorId']]); ?>" data-toggle="modal" data-target="#assignModal">分配角色</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="label label-danger delete" href="<?php echo Url::to(['//account/operator/update','id'=>$operator['operatorId']]); ?>"><?php echo $operator['status']==0?"恢复":"停用"?></span>
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