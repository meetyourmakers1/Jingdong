<?php
    use app\assets\AdminAsset;
    use yii\helpers\Html;
    /*use yii\widgets\Breadcrumbs;*/
    AdminAsset::register($this);
?>
<?php
    $this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?php /*echo Yii::$app->language;*/ ?>">
<head>
    <title>
        <?php 
            echo Html::encode($this->title); 
        ?> 
        - 后台管理
    </title>
    <?php 
        $this->registerMetaTag(["http-equiv" => "Content-type", "content" => "text/html;charset=utf-8"]); 
        $this->registerMetaTag(["name" => "viewport", "content" => "width=device-width, initial-scale=1.0"]); 
        $this->head();
    ?>
</head>
<body>
    <?php 
        $this->beginBody(); 
    ?>
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <button type="button" class="btn btn-navbar visible-phone" id="menu-toggler">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="<?php echo yii\helpers\Url::to(['/index/index']) ?>" style="font-weight:700;font-family:Microsoft Yahei">
                商城 - 后台管理
            </a>
            <ul class="nav pull-right">                
                <li class="hidden-phone">
                    <input class="search" type="text" />
                </li>
                <li class="notification-dropdown hidden-phone">
                    <a href="#" class="trigger">
                        <i class="icon-warning-sign"></i>
                        <span class="count">
                            6
                        </span>
                    </a>
                    <div class="pop-dialog">
                        <div class="pointer right">
                            <div class="arrow"></div>
                            <div class="arrow_border"></div>
                        </div>
                        <div class="body">
                            <a href="#" class="close-icon">
                                <i class="icon-remove-sign"></i>
                            </a>
                            <div class="notifications">
                                <h3>
                                    你有 6 个新通知
                                </h3>
                                <a href="#" class="item">
                                    <i class="icon-signin"></i> 
                                    新用户注册
                                    <span class="time">
                                        <i class="icon-time"></i> 
                                        13 分钟前.
                                    </span>
                                </a>
                                <a href="#" class="item">
                                    <i class="icon-signin"></i> 
                                    新用户注册
                                    <span class="time">
                                        <i class="icon-time"></i> 
                                        18 分钟前.
                                    </span>
                                </a>
                                <a href="#" class="item">
                                    <i class="icon-signin"></i> 
                                    新用户注册
                                    <span class="time">
                                        <i class="icon-time"></i> 
                                        49 分钟前.
                                    </span>
                                </a>
                                <a href="#" class="item">
                                    <i class="icon-download-alt"></i> 
                                    新订单
                                    <span class="time">
                                        <i class="icon-time"></i> 
                                        1 天前.
                                    </span>
                                </a>
                                <div class="footer">
                                    <a href="#" class="logout">
                                        查看所有通知
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="notification-dropdown hidden-phone">
                    <a href="#" class="trigger">
                        <i class="icon-envelope-alt"></i>
                    </a>
                    <div class="pop-dialog">
                        <div class="pointer right">
                            <div class="arrow"></div>
                            <div class="arrow_border"></div>
                        </div>
                        <div class="body">
                            <a href="#" class="close-icon">
                                <i class="icon-remove-sign"></i>
                            </a>
                            <div class="messages">
                                <a href="#" class="item">
                                    <img src="/admin/img/contact-img.png" class="display" />
                                    <div class="name">
                                        Alejandra Galván
                                    </div>
                                    <div class="msg">
                                        There are many variations of available, but the majority have suffered alterations.
                                    </div>
                                    <span class="time">
                                        <i class="icon-time"></i> 
                                        13 min.
                                    </span>
                                </a>
                                <a href="#" class="item">
                                    <img src="/admin/img/contact-img2.png" class="display" />
                                    <div class="name">
                                        Alejandra Galván
                                    </div>
                                    <div class="msg">
                                        There are many variations of available, have suffered alterations.
                                    </div>
                                    <span class="time">
                                        <i class="icon-time"></i> 
                                        26 min.
                                    </span>
                                </a>
                                <a href="#" class="item last">
                                    <img src="/admin/img/contact-img.png" class="display" />
                                    <div class="name">
                                        Alejandra Galván
                                    </div>
                                    <div class="msg">
                                        There are many variations of available, but the majority have suffered alterations.
                                    </div>
                                    <span class="time">
                                        <i class="icon-time"></i> 
                                        48 min.
                                    </span>
                                </a>
                                <div class="footer">
                                    <a href="#" class="logout">
                                        View all messages
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle hidden-phone" data-toggle="dropdown">
                        账户管理
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo yii\helpers\Url::to(['manager/modadminemail']) ?>">
                                修改邮箱
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo yii\helpers\Url::to(['manager/modadminpass']); ?>">
                                修改密码
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                订单管理
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="settings hidden-phone">
                    <a href="personal-info.html" role="button">
                        <i class="icon-cog"></i>
                    </a>
                </li>
                <li class="settings hidden-phone">
                    <a href="<?php echo yii\helpers\Url::to(['public/logout']) ?>" role="button">
                        <i class="icon-share-alt"></i>
                    </a>
                </li>
            </ul>            
        </div>
    </div>
    <div id="sidebar-nav">
        <ul id="dashboard-menu">
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-user"></i>
                    <span>
                        管理员管理
                    </span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="<?php echo yii\helpers\Url::to(['manager/list']); ?>">
                            管理员列表
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo yii\helpers\Url::to(['manager/add']); ?>">
                            加入新管理员
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-group"></i>
                    <span>
                        会员管理
                    </span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="<?php echo yii\helpers\Url::to(['user/list']); ?>">
                            会员列表
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo yii\helpers\Url::to(['user/add']); ?>">
                            加入新会员
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-group"></i>
                    <span>
                        商品分类管理
                    </span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="<?php echo yii\helpers\Url::to(['category/list']); ?>">
                            商品分类列表
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo yii\helpers\Url::to(['category/add']); ?>">
                            加入新商品分类
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-group"></i>
                    <span>
                        商品管理
                    </span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="<?php echo yii\helpers\Url::to(['product/list']); ?>">
                            商品列表
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo yii\helpers\Url::to(['product/add']); ?>">
                            加入新商品
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-edit"></i>
                    <span>
                        订单管理
                    </span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="<?php echo yii\helpers\Url::to(['order/list']); ?>">
                            订单列表
                        </a>
                    </li>
                </ul>
            </li>
            <?php
                /*$controller = Yii::$app->controller->id;
                $action = Yii::$app->controller->action->id;
                foreach (Yii::$app->params['adminmenu'] as $menu) {
                    $show = "hidden";
                    if (Yii::$app->admin->can($menu['module']. '/*')) {
                        $show = "show";
                    } else {
                        if (empty($menu['submenu']) && !Yii::$app->admin->can($menu['url'])) {
                            continue;
                        } else {
                            foreach ($menu['submenu'] as $sub) {
                                if (Yii::$app->admin->can($menu['module']. '/'. $sub['url'])) {
                                    $show = "show";
                                }
                            }
                        }
                    }*/                
            ?>
            <li class="<?php /*echo $controller == $menu['module'] ? 'active' : ''; echo $show;*/ ?>">
                <a <?php /*echo !empty($menu['submenu']) ? 'class="dropdown-toggle"' : '';*/ ?> href="<?php /*echo $menu['url'] == '#' ? '#' : yii\helpers\Url::to([$menu['url']]);*/ ?>">
                    <i class="<?php /*echo $menu['icon']*/ ?>"></i>
                    <span>
                        <?php 
                            /*echo $menu['label'];*/ 
                        ?>
                    </span>
                    <?php 
                        /*if (!empty($menu['submenu'])) :*/ 
                    ?>
                    <i class="icon-chevron-down"></i>
                    <?php 
                        /*endif;*/ 
                    ?>
                </a>
                <ul class="submenu <?php /*echo $controller == $menu['module'] && !empty($menu['submenu']) ? 'active' : '';*/ ?>">
                    <?php 
                        /*foreach ($menu['submenu'] as $sub):*/ 
                    ?>
                    <?php 
                        /*if (!Yii::$app->admin->can($menu['module']. '/*') && !Yii::$app->admin->can($menu['module']. '/'. $sub['url'])) continue;*/ 
                    ?>
                    <li>
                        <a href="<?php /*echo yii\helpers\Url::to([$menu['module']. '/'. $sub['url']]);*/ ?>">
                            <?php 
                                /*echo $sub['label']*/ 
                            ?>
                        </a>
                    </li>
                    <?php 
                        /*endforeach;*/ 
                    ?>
                </ul>
            </li>
            <?php
                /*}*/
            ?>
        </ul>
    </div>
    <div class="content">
        <?php 
            /*echo Breadcrumbs::widget([
                'homeLink' => ['label' => '首页', 'url' => '/admin/default/index'],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]);*/
        ?>
        <?php 
            echo $content ; 
        ?>
    </div>
    <?php
        $js = <<<JS
        $(".wysihtml5").wysihtml5({
            "font-styles": false
        });
JS;
        /*$this->registerJs($js);*/
    ?>
    <?php 
        $this->endBody(); 
    ?>
</body>
</html>
<?php 
    $this->endPage(); 
?>

