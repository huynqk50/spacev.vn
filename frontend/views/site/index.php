<?php
use frontend\models\Article;
use frontend\models\ArticleCategory;
return;
?>
<div class="left">
    <section id="home-featured" class="clr aspect-ratio _16x9">
        <?php
        if (isset($featured_news[0])) {
            $featured_new = $featured_news[0];
        ?>
        <div class="left">
            <section class="hot">
                <?= $featured_new->a([],
                    '<div class="item-view"><div class="img-wrap">' . $featured_new->img([], Article::IMAGE_HUGE) . '</div></div>'
                    . '<h2 class="name">' . $featured_new->name . '</h2>'
                    . '<div class="intro">' . $featured_new->description . '</div>'
                    )
                ?>
            </section>
            <section class="grid-view g2">
                <b class="clr"></b>
                <ul>
                    <?php
                    foreach (array_slice($featured_news, 1, 2) as $item) {
                        echo "<li>{$item->a([],
                            '<div class="item-view"><div class="img-wrap">' . $item->img([], Article::IMAGE_SMALL) . '</div></div>'
                            . '<h3 class="name">' . $item->name . '</h2>'
                        )}</li>";
                    }
                    ?>
                </ul>
                <b class="clr"></b>
            </section>
        </div>
        <div class="right">
            <h2 class="caption">Thể thao 24h qua</h2>
            <ul>
                <?php
                foreach (array_slice($featured_news, 3, 9) as $item) {
                    if ($category = ArticleCategory::findOneById($item->category_id)) {
                        echo '<li>';
                        echo '<div>';
                        echo $category->a(['class' => 'category-ref']);
                        echo '</div>';
                        echo '<div>';
                        echo $item->a();
                        echo '</div>';
                        echo '</li>';
                    }
                }
                ?>
            </ul>
        </div>
        <?php
        }
        ?>
    </section>
    <?php //echo $this->render('//modules/adsense') ?>
    <section class="clr aspect-ratio _16x9">
        <div class="left" id="home-cat">
            <ul>
            <?php
            $mid = round(count($categories) / 2);
            foreach (array_slice($categories, 0, $mid) as $category) {
//                if ($category->type != ArticleCategory::TYPE_FOOTBALL_TOURNAMENT) {
//                    continue;
//                }
                echo '<li>';
                echo $category->a(['class' => 'category-ref']);
                $news_list = $category->getAllArticles()->orderBy('published_at desc')->limit(3)->allPublished();
                if (isset($news_list[0])) {
                    $news = $news_list[0];
                    echo $news->a([], '<h3 class="name">' . $news->name . '</h3>'
                        . '<div class="clr"><div class="left"><div class="item-view"><div class="img-wrap">'
                        . $news->img([], Article::IMAGE_SMALL)
                        . '</div></div></div><div class="right"><div class="intro">'
                        . $news->description . '</div></div></div>'
                    );
                }
                echo '<ul>';
                foreach (array_slice($news_list, 1, 2) as $item) {
                    echo "<li>{$item->a()}</li>";
                }
                echo '</ul>';
                echo '</li>';
            }
            ?>
            </ul>
        </div>
        <div class="right" id="home-thumb">
            <?php
            $i = 0;
            foreach (array_slice($categories, $mid, $mid + 1) as $item) {
//                if ($item->parent_id) {
//                    continue;
//                }

                ?>
                <section>
                    <ol class="clr">
                        <li><?= $item->a() ?></li>
                        <?php
                        foreach ($item->findChildren() as $child) {
                            ?>
                            <li><?= $child->a() ?></li>
                            <?php
                        }
                        ?>
                    </ol>
                    <ul>
                        <?php
                        foreach ($item->getAllArticles()->orderBy('published_at desc')->limit(5)->allPublished() as $art) {
                            echo '<li>';
                            echo $art->a(['class' => 'clr'],
                                '<div class="image left"><div class="item-view"><div class="img-wrap">'
                                . $art->img([], $this->context->sm_scr ? Article::IMAGE_TINY : Article::IMAGE_SMALL) . '</div></div></div>'
                                . '<h3 class="name right">' . $art->name . '</h3>'
                            );
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </section>
                <?php
            }
            ?>
        </div>
    </section>
    <?php
    $length = count($football_teams);
    if ($length > 0) {
        ?>
        <section class="clr aspect-ratio _16x9" id="home-club">
            <div class="title">Thông tin đội bóng</div>
            <div class="content">
                <?php
                $li = function ($item) {
                    return "<li class=\"clr\">{$item->a([],
                 "<div class=\"image left\"><div class=\"item-view\"><div class=\"img-wrap\">{$item->img([],
                 ArticleCategory::IMAGE_VERY_TINY)}</div></div></div>"
                . "<div class=\"name right\">$item->name</div>")}</li>";
                };
                ?>
                <ul class="left">
                    <?php
                    for ($i = 0; $i < $length; $i += 3) {
                        echo $li($football_teams[$i]);
                    }
                    ?>
                </ul>
                <ul class="left">
                    <?php
                    for ($i = 1; $i < $length; $i += 3) {
                        echo $li($football_teams[$i]);
                    }
                    ?>
                </ul>
                <ul class="left">
                    <?php
                    for ($i = 2; $i < $length; $i += 3) {
                        echo $li($football_teams[$i]);
                    }
                    ?>
                </ul>
            </div>
        </section>
        <?php
    }
    ?>
</div>
<?= $this->render('//layouts/aside') ?>