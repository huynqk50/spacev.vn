<?php

use frontend\controllers\PurchaseOrderController;
use frontend\models\Menu;
use yii\helpers\Url;
use frontend\models\SiteParam;

$menu = Menu::getTopParents();
$cart = Yii::$app->session->get(PurchaseOrderController::CART_KEY, []);
$cart_count = count($cart);
?>
<div class="container page-title">
    <div class="wrap">
        <h1 class="content"><?= $this->context->h1 ? $this->context->h1 : ($this->context->page_title ? $this->context->page_title : Yii::$app->name) ?></h1>
    </div>
</div>
<div class="container" id="header">
    <div class="wrap clr">
        <!--<div class="nav">
            <a href="<?/*= ($p = SiteParam::findOneByName(SiteParam::PARAM_PHONE_NUMBER)) ? "tel:$p->value" : 'javascript:;' */?>" title="Hotline">
                <i class="icon phone-icon"></i>
                <span class="sm-hidden">Hotline:&nbsp;</span>
                <b class="text-blue"><?/*= $p ? $p->value : '' */?></b>
            </a>
            <a href="<?/*= Url::to(['purchase-order/cart-checkout'], true) */?>" title="Giỏ hàng">
                <i class="icon cart-icon"></i> Giỏ hàng
                (<b class="text-blue cart-counter"><?/*= $cart_count */?></b><span class="sm-hidden">&nbsp;sản phẩm</span>)
            </a>
        </div>-->
        <div class="logo-block">
            <a href="<?= Url::home(true) ?>" title="<?= Yii::$app->name ?>"><i class="icon logo-icon"></i></a>
        </div>
    </div>
</div>
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