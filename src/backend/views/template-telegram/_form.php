<?php

use markmoskalenko\mailing\common\models\templateTelegram\TemplateTelegram;
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
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, TemplateTelegram::ATTR_LANG)->dropDownList(TemplateTelegram::$languagesName) ?>
                <?= $form->field($model, TemplateTelegram::ATTR_PICTURE) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, TemplateTelegram::ATTR_SUBJECT) ?>
                <?= $form->field($model, TemplateTelegram::ATTR_VIDEO_FILE)->fileInput() ?>
                <?php if($model->videoUrl):?>
                  <a href="<?= $model->getVideoCdnUrl() ?>">Открыть видео</a>
                <?php endif;?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, TemplateTelegram::ATTR_BODY)->textarea(['rows'=>12]) ?>
            </div>
        </div>

        <div id="keyboardContainer">
            <?php foreach ((array)$model->keyboard as $k=>$item): ?>
                <div class="row mb-2">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Текст кнопки"
                               name="TemplateTelegram[keyboard][<?= $k ?>][text]" value="<?= $item['text'] ?>">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Ссылка"
                               name="TemplateTelegram[keyboard][<?= $k ?>][url]" value="<?= $item['url'] ?>">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Callback id"
                               name="TemplateTelegram[keyboard][<?= $k ?>][callback_data]" value="<?= $item['callback_data'] ?>">
                    </div>
                    <div class="col-action"><i class="fas fa-trash-alt deleteKey"></i></div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            <button type="button" class="btn btn-info" id="addNewKey">Добавить телеграм кнопку</button>

        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<script>
  function bindDeleteKey() {
    $('.deleteKey').click(function () {
      $(this).parents('.row:first').remove();
    })
  }
</script>
<?php $this->registerJs('bindDeleteKey()'); ?>

<?php
$js = <<<JS
$('#addNewKey').click(function () {
    const id = 'f'+(+new Date).toString(16);
    const template = $('<div class="row mb-2"></div>');
    const templateTextInput = $('<div class="col"><input type="text" class="form-control" placeholder="Текст кнопки" name="TemplateTelegram[keyboard]['+id+'][text]" value=""></div>');
    const templateUrlInput = $('<div class="col"><input type="text" class="form-control" placeholder="Ссылка" name="TemplateTelegram[keyboard]['+id+'][url]" value=""></div>');
    const templateCallbackInput = $('<div class="col"><input type="text" class="form-control" placeholder="Callback id" name="TemplateTelegram[keyboard]['+id+'][callback_data]" value=""></div>');

    template.append(templateTextInput);
    template.append(templateUrlInput);
    template.append(templateCallbackInput);


    const templateAction = $('<div class="col-action"><i class="fas fa-trash-alt deleteKey"></i></div>');
    template.append(templateAction);

    
    $('#keyboardContainer').append(template);
    bindDeleteKey();
  })
JS;
?>

<?php $this->registerJs($js); ?>

<style>
    .col-action {
        cursor: pointer;
        justify-content: center;
        align-items: center;
        display: flex;
        margin-right: 20px;
        min-width: 12px;
    }
</style>