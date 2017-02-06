<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
    <h4 class="modal-title" id="myModalLabel"><?= $this->title; ?></h4>
</div>
<div class="modal-body">
    <div class="error-page">
        <div>
            <h3><i class="fa fa-warning text-yellow"></i> Oops! <?= nl2br(Html::encode($message)) ?></h3>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
</div>

