<?php

use yii\bootstrap4\Html;


/* @var $this yii\web\View */

$this->title = 'Добавить новый шаблон';
?>
<div class="page-header row no-gutters py-4">
    <div class="col-12  text-sm-left mb-0">
        <h3 class="page-title"><?= Html::encode($this->title) ?></h3>
    </div>
</div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

