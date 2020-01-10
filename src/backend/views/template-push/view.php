<?php

use markmoskalenko\mailing\common\models\template\Template;
use yii\bootstrap4\Html;

/* @var yii\web\View $this */
/* @var Template $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны', 'url' => ['/mailing/template/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tariff-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--    --><? //= $this->render('_form', [
    //        'model' => $model,
    //    ]) ?>

</div>
