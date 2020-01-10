<?php

use markmoskalenko\mailing\common\models\templatePush\TemplatePush;
use yii\bootstrap4\Html;

/* @var yii\web\View $this */
/* @var TemplatePush $model */

$this->title = 'Редактировать шаблон';
?>
    <div class="page-header row no-gutters">
        <div class="col-12  text-sm-left mb-0">
            <h3 class="page-title"><?= Html::encode($this->title) ?></h3>
        </div>
    </div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>