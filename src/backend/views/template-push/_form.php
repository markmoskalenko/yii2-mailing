<?php

use markmoskalenko\mailing\common\helpers\LanguageHelpers;
use markmoskalenko\mailing\common\models\templatePush\TemplatePush;
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
                <?= $form->field($model, TemplatePush::ATTR_LANG)->dropDownList(LanguageHelpers::$languagesName) ?>
                <?= $form->field($model, TemplatePush::ATTR_TITLE) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, TemplatePush::ATTR_BODY)->textarea() ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
