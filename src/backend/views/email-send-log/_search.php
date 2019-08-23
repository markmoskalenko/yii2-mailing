<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model markmoskalenko\mailing\common\models\emailSendLog\EmailSendLogSearch */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]); ?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'email') ?>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
    <a href="<?= Url::to(['/mailing/email-send-log/index']) ?>" class="btn btn-default">Сбросить фильтр</a>
</div>

<?php ActiveForm::end(); ?>

