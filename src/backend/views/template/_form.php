<?php

use markmoskalenko\mailing\common\models\template\Template;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="tariff-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, Template::ATTR_NAME) ?>
            <?= $form->field($model, Template::ATTR_KEY) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, Template::ATTR_PRIORITY)->input('number') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
