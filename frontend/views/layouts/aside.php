<?php
use frontend\models\Video;
use frontend\models\Contact;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use frontend\models\Article;
use frontend\models\ArticleCategory;
?>
<aside class="right">
    <div class="img-wrap">
        <img src="<?= Yii::getAlias('@web/images/toasoan.jpg') ?>" alt="Liên hệ tòa soạn">
        <br>
    </div>
    <div class="grid-view g2 aspect-ratio _16x9">
        <ul>
            <?php
            $arts1 = Article::find()
                ->andWhere(['>=', 'published_at', strtotime('now')-2*86400])->orderBy('view_count desc')
                ->limit(2)->indexBy('id')->allPublished();
            $not_ids = array_keys($arts1);

            $arts2 = Article::find()->where(['not in', 'id', $not_ids])
                ->andWhere(['>=', 'published_at', strtotime('now')-7*86400])->orderBy('view_count desc')
                ->limit(4 - count($not_ids))->indexBy('id')->allPublished();
            $not_ids = array_merge($not_ids, array_keys($arts2));

            $arts3 = Article::find()->andWhere(['not in', 'id', $not_ids])
                ->orderBy('published_at desc')->limit(8 - count($not_ids))->indexBy('id')->allPublished();
            $not_ids = array_merge($not_ids, array_keys($arts3));

            foreach (array_merge($arts1, $arts2, $arts3) as $item) {
                echo "<li>{$item->a([],
                        '<div class="image"><div class="item-view"><div class="img-wrap">'
                        . $item->img([], Article::IMAGE_SMALL) . '</div></div></div>'
                        . '<h3 class="name">' . $item->name . '</h3>'
                    )}</li>";
            }
            ?>
        </ul>
    </div>