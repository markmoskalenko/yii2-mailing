<?php

use markmoskalenko\mailing\common\models\templateEmail\TemplateEmail;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
?>
<div class="card card-small mb-4">
    <div class="card-header border-bottom">
        <h6 class="m-0">Настройки шаблона</h6>
    </div>
    <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, TemplateEmail::ATTR_LANG)->dropDownList(TemplateEmail::$languagesName) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, TemplateEmail::ATTR_SUBJECT) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, TemplateEmail::ATTR_BODY)->textarea(['id' => 'redactor']) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
