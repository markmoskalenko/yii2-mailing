<?php

use markmoskalenko\mailing\common\models\emailSendLog\EmailSendLog;
use markmoskalenko\mailing\common\models\template\TemplateSearch;
use yii\bootstrap4\Modal;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel TemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Лог отправки писем на почту';
$this->params['breadcrumbs'][] = $this->title;

Modal::begin([
    'id' => 'errorModal',
    'title' => 'Лог ошибки',
]);
Modal::end();;
?>
    <div class="page-header row no-gutters">
        <div class="col-12 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Список писем которые мы отправляем пользователям</span>
            <h3 class="page-title"><?= $this->title ?></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Список</h6>
                </div>
                <div class="card-body p-0 pb-3">
                    <?= GridView::widget([
                        'layout' => "{items}\n{pager}",
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'pager' => [
                            'linkContainerOptions' => ['class' => 'page-item'],
                            'linkOptions' => ['class' => 'page-link'],
                            'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link']
                        ],
                        'columns' => [
                            [
                                'attribute' => EmailSendLog::ATTR_EMAIL,
                            ],
                            [
                                'attribute' => EmailSendLog::ATTR_TEMPLATE_KEY,
                            ],
                            [
                                'attribute' => EmailSendLog::ATTR_CREATED_AT,
                                'value' => function (EmailSendLog $item)
                                {
                                    return $item->createdAtFormatAdmin();
                                }
                            ],
                            [
                                'attribute' => EmailSendLog::ATTR_CREATED_AT,
                                'value' => function (EmailSendLog $item)
                                {
                                    return $item->sendAtFormatAdmin();
                                }
                            ],
                            [
                                'attribute' => EmailSendLog::ATTR_CREATED_AT,
                                'value' => function (EmailSendLog $item)
                                {
                                    return $item->openAtFormatAdmin();
                                }
                            ],
                            [
                                'format' => 'raw',
                                'attribute' => EmailSendLog::ATTR_OPEN_IP,
                            ],
                            [
                                'format' => 'raw',
                                'attribute' => EmailSendLog::ATTR_ERROR,

                                'value' => function (EmailSendLog $item)
                                {
                                    return $item->error ? Html::a('ошибка',
                                        ['/mailing/email-send-log/trace', 'id' => (string)$item->_id],
                                        ['class' => 'btn btn-danger btn-mini openLog']) : '';
                                }
                            ],
                            [
                                'format' => 'raw',
                                'value' => function (EmailSendLog $item)
                                {
                                    return Html::a('заметки',
                                            ['/note/index', 'NoteSearchAdmin' => ['userId' => (string)$item->userId]],
                                            ['class' => 'btn btn-primary btn-mini']) . ' ' .
                                        Html::a('пользователь', ['/user/update', 'id' => (string)$item->userId],
                                            ['class' => 'btn btn-primary btn-mini']);
                                }
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

        #errorModal .modal-dialog {
            max-width: 80%;
        }
    </style>

<?php
$this->registerJs("$(function() {
   $('.openLog').click(function(e) {
     e.preventDefault();
     $('#errorModal').modal('show').find('.modal-body').load($(this).attr('href'));
   });
});"); ?>