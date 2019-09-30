<?php

use markmoskalenko\mailing\common\models\templateTelegram\TemplateTelegram;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="tariff-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, TemplateTelegram::ATTR_LANG)->dropDownList(TemplateTelegram::$languagesName) ?>
            <?= $form->field($model, TemplateTelegram::ATTR_AFFILIATE_DOMAIN)->hint('Домен партнера без http://. Пример: mybase.pro') ?>
            <?= $form->field($model, TemplateTelegram::ATTR_PICTURE) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, TemplateTelegram::ATTR_SUBJECT) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, TemplateTelegram::ATTR_BODY)->textarea(['id' => 'redactor']) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, TemplateTelegram::ATTR_KEYBOARD)->textarea() ?>
            <?= $form->field($model, TemplateTelegram::ATTR_IS_INLINE_KEYBOARD)->checkbox() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
