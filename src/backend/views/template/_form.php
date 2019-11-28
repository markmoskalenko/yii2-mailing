<?php

use markmoskalenko\mailing\common\models\template\Template;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $model Template */
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
                <?= $form->field($model, Template::ATTR_NAME)->hint('Название для админки') ?>
                <?= $form->field($model, Template::ATTR_KEY)->hint('Идентификатор для отправки') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, Template::ATTR_PRIORITY)->input('number')->hint('Приоритет отправки') ?>

            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
