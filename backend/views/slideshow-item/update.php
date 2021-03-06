<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SlideshowItem */

$this->title = 'Update Slideshow Item: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Slideshow Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="slideshow-item-update">

<!--    <h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'username' => $username,
        'model' => $model,
    ]) ?>

</div>
