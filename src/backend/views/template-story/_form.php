<?php

use markmoskalenko\mailing\common\models\story\Story;
use markmoskalenko\mailing\common\models\templateStory\TemplateStory;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model TemplateStory */
?>

<div class="card card-small mb-4">
  <div class="card-header border-bottom">
    <h6 class="m-0">Настройки шаблона</h6>
  </div>
  <div class="card-body">
      <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
      <div class="col-md-6">
          <?= $form->field($model, TemplateStory::ATTR_LANG)->dropDownList(TemplateStory::$languagesName) ?>
          <?= $form->field($model,
              TemplateStory::ATTR_AFFILIATE_DOMAIN)->hint('Домен партнера без http://. Пример: mybase.pro') ?>
          <?= $form->field($model, TemplateStory::ATTR_IMAGE)->fileInput() ?>
          <?= $form->field($model, TemplateStory::ATTR_LOTTIE)->textarea(['rows' => 10]) ?>
          <?= $form->field($model, TemplateStory::ATTR_SUBJECT) ?>
          <?= $form->field($model, TemplateStory::ATTR_YOUTUBE_ID) ?>
      </div>
      <div class="col-md-6">
          <?= $form->field($model, TemplateStory::ATTR_BUTTON_IS_SHOW)->checkbox() ?>
          <?= $form->field($model, TemplateStory::ATTR_BUTTON_TEXT) ?>
          <?= $form->field($model, TemplateStory::ATTR_BUTTON_TYPE)->dropDownList(Story::$buttonStyleLabels,
              ['prompt' => '']) ?>
          <?= $form->field($model,
              TemplateStory::ATTR_BUTTON_CALLBACK)->dropDownList(Story::$callbackActionLabels,
              ['prompt' => '']) ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
          <?= $form->field($model, TemplateStory::ATTR_TEXT)->textarea(['rows' => 8]) ?>
      </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

      <?php ActiveForm::end(); ?>
  </div>
</div>

