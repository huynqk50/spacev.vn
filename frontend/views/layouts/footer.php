<?php

use frontend\models\SiteParam;
use yii\helpers\Url;
use frontend\models\ProductCategory;
use frontend\models\Info;

?>


<section id="partner">
        <div class="container">
            <?php $partner = Info::find()->where(['type' => Info::TYPE_PARTNER])->one();   
             echo $partner == null ? '' : $partner->content ?>
        </div><!--/.container-->
    </section><!--/#partner-->

    <section id="conatcat-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <?php $partner = Info::find()->where(['type' => Info::TYPE_CONTACT])->one();   
                    echo $partner == null ? '' : $partner->content ?>
                </div>
            </div>
        </div><!--/.container-->    
    </section><!--/#conatcat-info-->

    <section id="bottom">
        <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="row">
                <?php $partner = Info::find()->where(['type' => Info::TYPE_BOTTOM_INFO])->one();   
                    echo $partner == null ? '' : $partner->content ?>
            </div>
        </div>
    </section><!--/#bottom-->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2017 SpaceV.vn. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="/">Home</a></li>
                        <li><a href="<?= Url::to(['site/about'])?>">Giới thiệu</a></li>
                        <li><a href="<?= Url::to(['contact/index'])?>">Liên hệ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->