<?php

use markmoskalenko\mailing\common\models\templateTelegram\TemplateTelegram;
use yii\bootstrap4\Html;


/* @var $this yii\web\View */
/* @var $model TemplateTelegram */

$this->title = 'Добавить шаблон';
?>
<div class="page-header row no-gutters">
    <div class="col-12  text-sm-left mb-0">
        <h3 class="page-title"><?= Html::encode($this->title) ?></h3>
    </div>
</div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
