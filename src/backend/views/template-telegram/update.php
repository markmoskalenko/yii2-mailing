<?php

use markmoskalenko\mailing\common\models\templateTelegram\TemplateTelegram;
use yii\bootstrap4\Html;

/* @var yii\web\View $this */
/* @var TemplateTelegram $model */

$this->title = 'Редактировать шаблон';
$this->params['breadcrumbs'][] = ['label' => 'Письма', 'url' => ['/mailing/template/index']];
$this->params['breadcrumbs'][] = ['label' => $model->template->name, 'url' => ['/mailing/template/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tariff-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
