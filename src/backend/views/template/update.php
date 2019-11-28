<?php

use markmoskalenko\mailing\common\models\template\Template;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model Template */

$this->title = $model->name;
?>
<div class="page-header row no-gutters py-4">
    <div class="col-12  text-sm-left mb-0">
        <h3 class="page-title"><?= Html::encode($this->title) ?></h3>
    </div>
</div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
