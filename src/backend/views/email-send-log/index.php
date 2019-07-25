<?php

use backend\grid\ActionColumn;
use markmoskalenko\mailing\common\models\emailSendLog\EmailSendLog;
use markmoskalenko\mailing\common\models\template\TemplateSearch;
use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel TemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Лог отправки писем';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tariff-group-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager'        => [
            'linkContainerOptions'          => ['class' => 'page-item'],
            'linkOptions'                   => ['class' => 'page-link'],
            'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link']
        ],
        'columns'      => [
            [
                'attribute' => EmailSendLog::ATTR_CREATED_AT,
                'format'    => 'raw',
                'value'     => function (EmailSendLog $item)
                {
                    $html = '<strong>' . $item->theme . '</strong><br>';
                    $html .= 'Создано: ' . $item->createdAtFormatAdmin() . '<br>';
                    $html .= 'Отправлено: ' . $item->sendAtFormatAdmin() . '<br>';
                    $html .= 'Прочитано: ' . $item->openAtFormatAdmin() . '<br>';
                    $html .= 'IP: ' . $item->openIp;

                    return $html;
                }
            ],
            [
                'attribute' => EmailSendLog::ATTR_EMAIL,
            ],
            [
                'format'    => 'raw',
                'attribute' => EmailSendLog::ATTR_ERROR,
            ],
            [
                'class'    => ActionColumn::class,
                'template' => '{view} {update} {delete}'
            ],
        ],
    ]); ?>
</div>

<style>
    code {
        font-size: 10px;
        line-height: 0.7;
        white-space: pre-wrap;
    }
</style>
