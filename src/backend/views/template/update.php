<?php

use markmoskalenko\mailing\common\models\template\Template;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model Template */

$this->title = 'Редактирование тариф';
$this->params['breadcrumbs'][] = [
    'label' => 'Письма',
    'url'   => ['/mailing/template/index', 'id' => (string)$model->_id]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tariff-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
