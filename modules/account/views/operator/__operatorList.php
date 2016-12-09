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
    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
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
        <tbody>
        <?php if (is_array($operatorList) && count($operatorList) > 0) {
            foreach ($operatorList as $index => $operator) { ; ?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $operator['operatorId']; ?>"></td>
                    <td><?php echo $operator['login']; ?></td>
                    <td><?php echo $operator['name']; ?></td>
                    <td><?php echo $operator['email']; ?></td>
                    <td><?php echo $operator['updateTime']; ?></td>
                    <td>
                        <span class="label label-success edit" data="<?php echo $operator['operatorId']; ?>" href="<?php echo Url::to(['//account/operator/update','id'=>$operator['operatorId']]); ?>">编辑</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="label label-danger delete" data="<?php echo $operator['operatorId']; ?>" href="<?php echo Url::to(['//account/operator/update','id'=>$operator['operatorId']]); ?>"><?php echo $operator['status']==0?"恢复":"停用"?></span>
                    </td>
                </tr>
            <?php }
        }; ?>
        <tr>
            <td><input type="checkbox"></td>
            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
            <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
            </td>
            <td class="mailbox-attachment"></td>
            <td class="mailbox-date">5 mins ago</td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
            <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
            </td>
            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
            <td class="mailbox-date">28 mins ago</td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
            <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
            </td>
            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
            <td class="mailbox-date">11 hours ago</td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
            <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
            </td>
            <td class="mailbox-attachment"></td>
            <td class="mailbox-date">15 hours ago</td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
            <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
            </td>
            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
            <td class="mailbox-date">Yesterday</td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
            <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
            </td>
            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
            <td class="mailbox-date">2 days ago</td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
            <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
            </td>
            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
            <td class="mailbox-date">2 days ago</td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
            <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
            </td>
            <td class="mailbox-attachment"></td>
            <td class="mailbox-date">2 days ago</td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
            <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
            </td>
            <td class="mailbox-attachment"></td>
            <td class="mailbox-date">2 days ago</td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
            <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
            </td>
            <td class="mailbox-attachment"></td>
            <td class="mailbox-date">2 days ago</td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
            <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
            </td>
            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
            <td class="mailbox-date">4 days ago</td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
            <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
            </td>
            <td class="mailbox-attachment"></td>
            <td class="mailbox-date">12 days ago</td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
            <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
            </td>
            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
            <td class="mailbox-date">12 days ago</td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
            <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
            </td>
            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
            <td class="mailbox-date">14 days ago</td>
        </tr>
        <tr>
            <td><input type="checkbox"></td>
            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
            <td class="mailbox-subject"><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...
            </td>
            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
            <td class="mailbox-date">15 days ago</td>
        </tr>
        </tbody>
    </table>
    <!-- /.table -->
</div>
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
    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
    <div class="pull-right">
        1-50/200
        <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
        </div>
        <!-- /.btn-group -->
    </div>
    <!-- /.pull-right -->
</div>