<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model soless\catalogue\models\CatalogueItem */

$this->title = 'Создать новую запись';
$this->params['breadcrumbs'][] = ['label' => 'Записи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogue-article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
