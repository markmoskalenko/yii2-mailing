<?php

use markmoskalenko\mailing\backend\grid\ActionColumn;
use markmoskalenko\mailing\common\models\telegramSendLog\TelegramSendLog;
use markmoskalenko\mailing\common\models\template\TemplateSearch;
use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel TemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Лог отправки писем в телеграм';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header row no-gutters py-4">
    <div class="col-12 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Список писем которые мы отправляем пользователям</span>
        <h3 class="page-title"><?= $this->title ?></h3>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body">
                <?= $this->render('_search', [
                    'model' => $searchModel
                ]) ?>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card mb-5">
            <div class="card-header border-bottom">
                <h6 class="m-0">Список</h6>
            </div>
            <div class="card-body p-0 pb-3">
                <?= GridView::widget([
                    'layout' => "{items}\n{pager}",
                    'dataProvider' => $dataProvider,
                    'pager'        => [
                        'linkContainerOptions'          => ['class' => 'page-item'],
                        'linkOptions'                   => ['class' => 'page-link'],
                        'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link']
                    ],
                    'columns'      => [
                        [
                            'attribute' => TelegramSendLog::ATTR_CREATED_AT,
                            'format'    => 'raw',
                            'value'     => function (TelegramSendLog $item)
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
                            'attribute' => TelegramSendLog::ATTR_TELEGRAM,
                        ],
                        [
                            'format'    => 'raw',
                            'attribute' => TelegramSendLog::ATTR_ERROR,
                        ],
                        [
                            'class'    => ActionColumn::class,
                            'template' => '{view} {update} {delete}'
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<style>
    code {
        font-size: 10px;
        line-height: 0.7;
        white-space: pre-wrap;
    }
</style>
