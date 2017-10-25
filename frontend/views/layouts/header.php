<?php

use frontend\controllers\PurchaseOrderController;
use frontend\models\Menu;
use frontend\models\SiteParam;
use yii\helpers\Url;

$menu = Menu::getTopParents();
$cart = Yii::$app->session->get(PurchaseOrderController::CART_KEY, []);
$cart_count = count($cart);
?>
<header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i><?= ($p = SiteParam::findOneByName(SiteParam::PARAM_PHONE_NUMBER)) ? "$p->value" : 'javascript:;'?></p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="<?= SiteParam::findOneByName(SiteParam::PARAM_FACEBOOK)->value?>"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="<?= SiteParam::findOneByName(SiteParam::PARAM_TWITTER)->value?>"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="<?= SiteParam::findOneByName(SiteParam::PARAM_LINKED_IN)->value?>"><i class="fa fa-linkedin"></i></a></li> 
                                <li><a href="<?= SiteParam::findOneByName(SiteParam::PARAM_DRIBBBLE)->value?>"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="<?= SiteParam::findOneByName(SiteParam::PARAM_SKYPE)->value?>"><i class="fa fa-skype"></i></a></li>
                            </ul>
                            <div class="search">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= Url::home(true) ?>"><img src="images/logo.png" alt="logo"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                         <?php
                foreach ($menu as $item) {
                    $children = $item->getChildren();
                    ?>
                    <li<?= $item->isCurrent() ? ' class="active"' : '' ?>>
                        <li class="active"><a href="index.html">Home</a></li>
                        <li><a href="about-us.html">About Us</a></li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="portfolio.html">Portfolio</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="blog-item.html">Blog Single</a></li>
                                <li><a href="pricing.html">Pricing</a></li>
                                <li><a href="404.html">404</a></li>
                                <li><a href="shortcodes.html">Shortcodes</a></li>
                            </ul>
                        </li>
                        <li><a href="blog.html">Blog</a></li> 
                        <li><a href="contact-us.html">Contact</a></li>  
                <?php } ?>
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header-->
<div class="container" id="top-bar">
    <div class="wrap clr">
        <div class="menu clr">
            <button class="menu-toggle" onclick="
                web.toggleClassName(document.querySelector('#top-bar .menu'), 'active');
                document.querySelector('#top-bar .search-box').classList.remove('active');
            ">
                <i class="icon menu-icon">
                    <b></b>
                    <b></b>
                    <b></b>
                </i>
                <span>&nbsp;<?= ($m = Menu::getCurrent()) ? $m->label : 'Danh mục' ?></span>
            </button>
            <ul>
                <?php
                foreach ($menu as $item) {
                    $children = $item->getChildren();
                    ?>
                    <li<?= $item->isCurrent() ? ' class="active"' : '' ?>>
                        <?php
                        if (empty($children)) {
                            echo $item->a();
                        } else {
                            ?>
                            <button class="menu-toggle" onclick="web.toggleClassName(this, 'active')"></button>
                            <?= $item->a() ?>
                            <ul>
                                <?php
                                foreach ($children as $child) {
                                    ?>
                                    <li<?= $child->isCurrent() ? ' class="active"' : '' ?>>
                                        <?php
                                        $grandchildren = $child->getChildren();
                                        if (empty($grandchildren)) {
                                            echo $child->a();
                                        } else {
                                        ?>
                                            <button class="menu-toggle" onclick="web.toggleClassName(this, 'active')"></button>
                                            <?= $child->a() ?>
                                            <ul>
                                                <?php
                                                foreach ($grandchildren as $grandchild) {
                                                    echo ($grandchild->isCurrent() ? '<li class="active">' : '<li>') . "{$grandchild->a()}</li>";
                                                }
                                                ?>
                                            </ul>
                                        <?php
                                        }
                                        ?>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <?php
                        }
                        ?>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <div class="top-modal" onclick="this.previousElementSibling.classList.remove('active')"></div>
        <div class="search-box">
            <gcse:search></gcse:search>
        </div>
        <div class="top-modal" onclick="this.previousElementSibling.classList.remove('active')"></div>
        <button class="search-toggle" onclick="
                        web.toggleClassName(document.querySelector('#top-bar .search-box'), 'active');
                        document.querySelector('#top-bar .menu').classList.remove('active');
                        /* @TODO: Focus on input */
                        document.querySelector('.search-box .gsc-search-box-tools .gsc-search-box input.gsc-input').focus();
                    "><i class="icon magnifier-icon"></i>
        </button>
        <script>
            window.addEventListener("load", function () {
                var search_input = document.querySelector('.search-box .gsc-search-box-tools .gsc-search-box input.gsc-input');
                search_input.placeholder = 'Tìm kiếm...';
            });
        </script>
    </div>
</div>