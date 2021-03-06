<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
use app\components\NavMenu;

AppAsset::register($this);

AppAsset::addCss($this, Yii::$app->controller->getCssFile());
AppAsset::addScript($this, Yii::$app->controller->getJsFile());
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= Html::encode($this->title) ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?= Html::csrfMetaTags() ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <?php $this->registerJsFile("@web/js/html5shiv.min.js")?>
    <?php $this->registerJsFile("@web/js/respond.min.js")?>
    <![endif]-->

    <?php $this->head() ?>
</head>
<body class="hold-transition skin-green-light sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <!-- end message -->
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                AdminLTE Design Team
                                                <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Developers
                                                <small><i class="fa fa-clock-o"></i> Today</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Sales Department
                                                <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <h4>
                                                Reviewers
                                                <small><i class="fa fa-clock-o"></i> 2 days</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                            page and may cause design problems
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-red"></i> 5 new members joined
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user text-red"></i> You changed your username
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 9 tasks</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Design some buttons
                                                <small class="pull-right">20%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Create a nice theme
                                                <small class="pull-right">40%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">40% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Some task I need to do
                                                <small class="pull-right">60%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">60% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                    <li><!-- Task item -->
                                        <a href="#">
                                            <h3>
                                                Make beautiful transitions
                                                <small class="pull-right">80%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">80% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <!-- end task item -->
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
<!--                            <img src="img/user2-160x160.jpg" class="user-image" alt="User Image">-->
                            <svg class="icon user-image" aria-hidden="true">
                                <use xlink:href="#icon-dao"></use>
                            </svg>
                            <span class="hidden-xs">
                                <?= Yii::$app->user->identity->name ?>
                            </span>
                        </a>

                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
<!--                                <img src="img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-dao"></use>
                                </svg>
                                <p>
                                    Alexander Pierce - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?php echo Url::to(['//account/operator/update', 'id' => Yii::$app->user->identity->getId()])?>" class="btn btn-default btn-flat">个人中心</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo Url::to(['//account/home/logout'])?>" class="btn btn-default btn-flat">退出</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <?php echo NavMenu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'MAIN NAVIGATION', 'options' => ['class' => 'header']],
                        [
                            'label' => 'Dashboard',
                            'icon' => 'fa fa-dashboard',
                            'url' => '#',
                            'options' => ['class' => 'treeview'],
                            'items' => [
                                ['label' => ' Dashboard v1', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/carousel/index'],],
                                ['label' => ' Dashboard v2', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                            ],
                        ],
                        [
                            'label' => '系统',
                            'icon' => 'fa fa-dashboard',
                            'url' => '#',
                            'options' => ['class' => 'treeview'],
                            'items' => [
                                ['label' => ' 后台用户', 'icon' => 'fa fa-circle-o', 'url' => ['//account/operator/index'],],
                                ['label' => ' 角色', 'icon' => 'fa fa-circle-o', 'url' => ['//account/role/index'],],
                                ['label' => ' 权限', 'icon' => 'fa fa-circle-o', 'url' => ['//account/permission/index'],],
                                ['label' => ' 字典维护', 'icon' => 'fa fa-circle-o', 'url' => ['//account/dictionary/index'],],
                            ],
                        ],
                        [
                            'label' => 'Layout Options',
                            'icon' => 'fa fa-files-o',
                            'url' => '#',
                            'options' => ['class' => 'treeview'],
                            'items' => [
                                ['label' => ' Top Navigation', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/carousel/index'],],
                                ['label' => ' Boxed', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                                ['label' => ' Fixed', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                                ['label' => ' Collapsed Sidebar', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                            ],
                        ],
                        [
                            'label' => 'Widgets',
                            'icon' => 'fa fa-th',
                            'url' => '#',
                        ],
                        [
                            'label' => 'Charts',
                            'icon' => 'fa fa-pie-chart',
                            'url' => '#',
                            'options' => ['class' => 'treeview'],
                            'items' => [
                                ['label' => ' ChartJS', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/carousel/index'],],
                                ['label' => ' Morris', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                                ['label' => ' Flot', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                                ['label' => ' Inline charts', 'icon' => 'fa fa-circle-o', 'url' => ['//account/post/index'],],
                            ],
                        ],
                        [
                            'label' => 'UI Elements',
                            'icon' => 'fa fa-laptop',
                            'url' => '#',
                            'options' => ['class' => 'treeview'],
                            'items' => [
                                ['label' => ' General', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/carousel/index'],],
                                ['label' => ' Icons', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                                ['label' => ' Buttons', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                                ['label' => ' Sliders', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                                ['label' => ' Timeline', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                                ['label' => ' Modals', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                            ],
                        ],
                        [
                            'label' => 'Forms',
                            'icon' => 'fa fa-edit',
                            'url' => '#',
                            'options' => ['class' => 'treeview'],
                            'items' => [
                                ['label' => ' General Elements', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/carousel/index'],],
                                ['label' => ' Advanced Elements', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                                ['label' => ' Editors', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                            ],
                        ],
                        [
                            'label' => 'Tables',
                            'icon' => 'fa fa-table',
                            'url' => '#',
                            'options' => ['class' => 'treeview'],
                            'items' => [
                                ['label' => ' Simple tables', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/carousel/index'],],
                                ['label' => ' Data tables', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                            ],
                        ],
                        [
                            'label' => 'Calendar',
                            'icon' => 'fa fa-calendar',
                            'url' => '#',
                            'options' => ['id' => 'sidebar-menu-calendar']
                        ],
                        [
                            'label' => 'Mailbox',
                            'icon' => 'fa fa-envelope',
                            'url' => '#',
                        ],
                        [
                            'label' => 'Examples',
                            'icon' => 'fa fa-folder',
                            'url' => '#',
                            'options' => ['class' => 'treeview'],
                            'items' => [
                                ['label' => ' Invoice', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/carousel/index'],],
                                ['label' => ' Profile', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                                ['label' => ' Login', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/carousel/index'],],
                                ['label' => ' Register', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                                ['label' => ' Lockscreen', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/carousel/index'],],
                                ['label' => ' 404 Error', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                                ['label' => ' 500 Error', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/carousel/index'],],
                                ['label' => ' Blank Page', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                                ['label' => ' Pace Page', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                            ],
                        ],
                        [
                            'label' => 'Multilevel',
                            'icon' => 'fa fa-share',
                            'url' => '#',
                            'options' => ['class' => 'treeview'],
                            'items' => [
                                ['label' => ' Level Two', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/carousel/index'],],
                                [
                                    'label' => ' Level Two',
                                    'icon' => 'fa fa-circle-o',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => ' Level Three', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/carousel/index'],],
                                        ['label' => ' Level Three', 'icon' => 'fa fa-circle-o', 'url' => ['//account/default/index'],],
                                    ],
                                ],
                                ['label' => ' Level One', 'icon' => 'fa fa-circle-o', 'url' => ['//admin/post/index'],],
                            ],
                        ],
                        [
                            'label' => 'Documentation',
                            'icon' => 'fa fa-book',
                            'url' => '#',
                            'options' => ['id' => 'sidebar-menu-documentation']
                        ],
                        [
                            'label' => 'MAIN NAVIGATION',
                            'options' => ['class' => 'header']
                        ],
                        [
                            'label' => 'Important',
                            'icon' => 'fa fa-circle-o text-red',
                            'url' => '#',
                        ],
                        [
                            'label' => 'Warning',
                            'icon' => 'fa fa-circle-o text-yellow',
                            'url' => '#',
                        ],
                        [
                            'label' => 'Information',
                            'icon' => 'fa fa-circle-o text-aqua',
                            'url' => '#',
                        ],
                    ],
                ]
            ); ?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Version 2.0</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php echo $content; ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.8
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
