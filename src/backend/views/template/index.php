<?php

use markmoskalenko\mailing\backend\grid\ActionColumn;
use markmoskalenko\mailing\common\models\template\Template;
use markmoskalenko\mailing\common\models\template\TemplateSearch;
use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel TemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Письма';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tariff-group-index">
    <h1><?= Html::encode($this->title) ?> <?= Html::a('<i class="fas fa-plus"></i>', ['create'],
            ['class' => 'btn btn-success btn-sm']) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager'        => [
            'linkContainerOptions'          => ['class' => 'page-item'],
            'linkOptions'                   => ['class' => 'page-link'],
            'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link']
        ],
        'columns'      => [
            [
                'attribute' => Template::ATTR_NAME,
                'format'    => 'raw',
                'value'     => function (Template $model)
                {
                    return Html::a($model->name, ['view', 'id' => (string)$model->_id]);
                }
            ],
            [
                'class'    => ActionColumn::class,
                'template' => '{view} {update} {delete}'
            ],
        ],
    ]); ?>
</div>
