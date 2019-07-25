<?php

use yii\bootstrap4\Html;


/* @var $this yii\web\View */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Письма', 'url' => ['/mailing/template/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tariff-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
