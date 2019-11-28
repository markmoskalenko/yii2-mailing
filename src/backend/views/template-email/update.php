<?php

use markmoskalenko\mailing\common\models\templateEmail\TemplateEmail;
use yii\bootstrap4\Html;

/* @var yii\web\View $this */
/* @var TemplateEmail $model */

$this->title = 'Редактировать шаблон';
?>
    <div class="page-header row no-gutters py-4">
        <div class="col-12  text-sm-left mb-0">
            <h3 class="page-title"><?= Html::encode($this->title) ?></h3>
        </div>
    </div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>