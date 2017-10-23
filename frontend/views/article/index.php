<?php
use frontend\models\Article;
use yii\helpers\Url;

$share_box = "<ul class=\"multi-share-box\">
                <li class=\"share-facebook\">
                    <a href=\"https://www.facebook.com/sharer/sharer.php?u=" . urldecode(Url::current([], true)) . "&t=$model->meta_title\"
                       onclick=\"javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;\"
                       target=\"_blank\" title=\"Share on Facebook\"
                    >
                        <i class=\"facebook-icon\"></i>
                        <span>Facebook</span>
                    </a>
                </li><li class=\"share-linkedin\">
                    <a href=\"https://www.linkedin.com/shareArticle?mini=true&url=" . urldecode(Url::current([], true)) . "&title=$model->meta_title&summary=$model->meta_description&source=" . Yii::$app->request->hostInfo . "\"
                       onclick=\"javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;\"
                       target=\"_blank\" title=\"Share on Linkedin\"
                    >
                        <i class=\"linkedin-icon\"></i>
                        <span>Linkedin</span>
                    </a>
                </li><li class=\"share-twitter\">
                    <a href=\"http://twitter.com/share?url=" . urldecode(Url::current([], true)) . "\"
                       onclick=\"javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;\"
                       target=\"_blank\" title=\"Share on Twitter\"
                    >
                        <i class=\"twitter-icon\"></i>
                        <span>Twitter</span>
                    </a>
                </li><li class=\"email\">
                    <a href=\"javascript:;\" title=\"Email\">
                        <i class=\"envelope-icon\"></i>
                        <span>Email</span>
                    </a>
                </li><li class=\"print\">
                    <a href=\"javascript:window.print()\" title=\"Print\">
                        <i class=\"printer-icon\"></i>
                        <span>Print</span>
                    </a>
                </li>
            </ul>";
?>
<style>

    .multi-share-box {
        padding: 0;
        margin: 10px 0 0;
    }
    .multi-share-box li {
        display: inline-block;
        list-style: none;
        background: #999;
        position: relative;
        width: 19%;
        margin: 0.5%;
        border-radius: 3px;
    }
    .multi-share-box li a {
        display: inline-block;
        color: #fff;
        text-transform: uppercase;
        font-weight: bold;
        font-family: Helvetica,Arial,sans-serif;
        font-size: 11px;
        line-height: 28px;
        height: 28px;
        text-align: center;
        padding-left: 35%;
    }
    .multi-share-box li i {
        position: absolute;
        display: inline-block;
        left: 10px;
        top: 0;
        bottom: 0;
        margin: auto;
    }
    .multi-share-box li.share-facebook {
        background: #306199;
    }
    .multi-share-box li.share-facebook:hover {
        background: #244872;
    }
    .multi-share-box li.share-linkedin {
        background: #005983;
    }
    .multi-share-box li.share-linkedin:hover {
        background: #007bb6;
    }
    .multi-share-box li.share-twitter {
        background: #26c4f1;
    }
    .multi-share-box li.share-twitter:hover {
        background: #0eaad6;
    }
    .multi-share-box li.email {
        background: #555;
    }
    .multi-share-box li.email:hover {
        background: #444;
    }
    .multi-share-box li.print {
        background: #999;
    }
    .multi-share-box li.print:hover {
        background: #888;
    }
    .envelope-icon {
        background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAMCAMAAACKnBfWAAAAPFBMVEUAAAD////////////////////////////////////////////////////////////////////////////YSWgTAAAAFHRSTlMA3tLXJxlXIss+OBvQY0tCFAqrdmTuoW0AAABaSURBVAjXXc5LEoAgDAPQ2FCKX0Dvf1dFYAbN7mWTwE9jPLg69LiVEOXcGKkCgfF4edBQDN38Q78pqpHCjj0kdJuEM9B1G2O+8kJXbW2gFDLuLWVv0s+f/98b17sCO+AlUvUAAAAASUVORK5CYII=");
        width: 15px;
        height: 12px;
    }
    .facebook-icon {
        background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAMAAAAMCGV4AAAAPFBMVEUAAAD////////////////////////////////////////////////////////////////////////////YSWgTAAAAE3RSTlMAPPp3hcO7lwzv4s/Lt6RwYlgsCUE/uwAAAEtJREFUCNeVzzsOwCAMA1AnpED/H9//rlWHBoTEgLc3WLJhyhI1OJdkBxU/1wwI6b6Q5awsCGTXE75I13N8cMet7Y/b96ewk9T23wvoHQymL8HHkwAAAABJRU5ErkJggg==");
        width: 15px;
        height: 15px;
    }
    .linkedin-icon {
        background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAANCAMAAABFNRROAAAAS1BMVEUAAAD///////////////////////////////////////////////////////////////////////////////////////////////+DmQsHAAAAGHRSTlMA8eLDeEsPhhL5xZJW9OnUe2teQj8uCQGc4lttAAAATElEQVQI153KSQ6AIBQE0Q8os/NU9z+pBjWytpNevKQkdU6+KXSlKc6VrLeyX7frdtylo88KjH1EAEhFI0S/gC5qIIsMhFetiIG/OgHYLgYaouHIjgAAAABJRU5ErkJggg==");
        width: 13px;
        height: 13px;
    }
    .twitter-icon {
        background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABsAAAAPCAMAAAAiTUTqAAAAY1BMVEUAAAD///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////+aRQ2gAAAAIHRSTlMA4X73/UcKwJ4T6syyqqeLYlguIhsSB/nb2tOVdmxqOgWg9bYAAAB6SURBVBjTjcxHFoMwDEVRScaNTiCkJ97/KgM+tO8Rb6CB7pHoRNc4jTCL/hqkUuaFhDnuwPw91NoTR1M12FhNK+tUtMqDXYqw1xKaOliHNjbZRtmPsHY/LAYk48KWUNprffroE2lcuViuKelzW66ekbBeLOds3wOd6w+RPA45wIkO8gAAAABJRU5ErkJggg==");
        width: 27px;
        height: 15px;
    }
    .printer-icon {
        background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAMAAAAMCGV4AAAAP1BMVEUAAAD///////////////////////////////////////////////////////////////////////////////9Du/pqAAAAFHRSTlMA74daRaqZVfTdMgbju7J5aSwek7TEYikAAABgSURBVAjXdc/BEoAgCEVRUCtBzbL+/1sTGYZVd+HMeawEgJ5xls8CWojyXnUN7v7MwR0zvt29pvBnJiJWV8IIhZkLRKQKKPe7tXbLHdWaOSQtqNNmJfVuqcdhjSn5nJc/dvADLoQzKGIAAAAASUVORK5CYII=");
        width: 15px;
        height: 15px;
    }
    @media (max-width: 640px) {
        .multi-share-box li {
            /*width: auto;*/
        }
        .multi-share-box li a span {
            display: none;
        }
    }
</style>
<div class="left clr news-page">
    <div class="left">
        <section class="news news-text">
            <h2 class="name"><?= $model->name ?></h2>
            <div class="info">
                <em><?= $model->date() ?></em>
                | <em><span class="icon comment-icon"></span> <?= $model->comment_count ?> bình luận</em>
                <!--| <em><span class="icon view-icon"></span> <span class="number-kmb"><?= $model->view_count ?></span> xem</em>-->
            </div>
            <?= $share_box ?>
            <div class="intro">
                <?= $model->description ?>
            </div>
            <article class="content fit-content content-popup-images">
                <?= $model->content ?>
            </article>
            <?= $share_box ?>
        </section>
        <section class="hot-news">
            <div class="title">Tin tức mới nhất</div>
            <div class="content clr news-text details-view d41 aspect-ratio _16x9">
                <?php
                $li = function ($item) {
                    return "<li>{$item->a(['class' => 'clr'],
                        '<div class="image"><div class="item-view"><div class="img-wrap">'
                        . $item->img([], Article::IMAGE_SMALL) . '</div></div></div>'
                        . '<h3 class="name">' . $item->name . '</h3>'
                        )}</li>";
                };
                ?>
                <ul class="left">
                <?php
                for ($i = 0; $i < 10; $i+=2) {
                    if (isset($hot_items[$i])) {
                        echo $li($hot_items[$i]);
                    }
                }
                ?>
                </ul>
                <ul class="right">
                <?php
                for ($i = 1; $i < 10; $i+=2) {
                    if (isset($hot_items[$i])) {
                        echo $li($hot_items[$i]);
                    }
                }
                ?>
                </ul>
            </div>
        </section>
        <section>
            <?= $this->render('//modules/comment') ?>
        </section>
    </div>
    <div class="right">
        <div class="rel-news">
            <div class="title"><strong>Tin liên quan</strong></div>
            <ul>
                <?php
                $i = 0;
                foreach (array_slice($related_items, 0, 5) as $item) {
                    $i++;
                    echo '<li>';
                    if ($i == 1) {
                        echo "<div class=\"image\"><div class=\"item-view aspect-ratio _16x9\"><div class=\"img-wrap\">{$item->img()}</div></div></div>";
                    }
                    echo $item->a() . '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<?= $this->render('//layouts/aside') ?>