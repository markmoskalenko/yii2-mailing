<?php

use markmoskalenko\mailing\backend\grid\ActionColumn;
use markmoskalenko\mailing\common\models\template\Template;
use markmoskalenko\mailing\common\models\templateEmail\TemplateEmail;
use markmoskalenko\mailing\common\models\templatePush\TemplatePush;
use markmoskalenko\mailing\common\models\templateTelegram\TemplateTelegram;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var yii\web\View $this */
/* @var Template $model */
/* @var ActiveDataProvider $templateEmailProvider */
/* @var ActiveDataProvider $templatePushProvider */
/* @var ActiveDataProvider $templateTelegramProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Письма', 'url' => ['/mailing/template/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header row no-gutters">
    <div class="col-12 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Информация</span>
        <h3 class="page-title"><?= Html::encode($this->title) ?> [ <?= $model->key ?> ]</h3>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card mb-5">
            <div class="card-header border-bottom">
                <h6 class="m-0">Email письма разделенные по языку и вайтлейблу</h6>
                <div class="actions">
                    <a class="btn-floating-action"
                       href="<?= Url::to(['/mailing/template-email/create', 'templateId' => (string)$model->_id]) ?>"
                       data-toggle="tooltip" data-placement="top" data-original-title="Add new">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0 pb-3">
                <?= GridView::widget([
                    'layout' => "{items}\n{pager}",
                    'dataProvider' => $templateEmailProvider,
                    'pager' => [
                        'linkContainerOptions' => ['class' => 'page-item'],
                        'linkOptions' => ['class' => 'page-link'],
                        'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link']
                    ],
                    'columns' => [
                        TemplateEmail::ATTR_SUBJECT,
                        TemplateEmail::ATTR_LANG,
                        TemplateEmail::ATTR_AFFILIATE_DOMAIN,
                        [
                            'class' => ActionColumn::class,
                            'controller' => 'template-email',
                            'buttons' => [
                                'copy' => function ($url, $model)
                                {
                                    $url = ['/mailing/template-email/copy', 'id' => (string)$model->_id];
                                    $title = 'Дублировать письмо';
                                    $icon = Html::tag('span', '', ['class' => 'far fa-copy']);
                                    $options = array_merge([
                                        'title' => $title,
                                        'aria-label' => $title,
                                        'data-pjax' => '0',
                                    ]);

                                    return Html::a($icon, $url, $options);
                                },
                            ],
                            'template' => '{update} {copy} {delete}'
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-5">
            <div class="card-header border-bottom">
                <h6 class="m-0">Push сообщения разделенные по языку</h6>
                <div class="actions">
                    <a class="btn-floating-action"
                       href="<?= Url::to(['/mailing/template-push/create', 'templateId' => (string)$model->_id]) ?>"
                       data-toggle="tooltip" data-placement="top" data-original-title="Add new">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0 pb-3">
                <?= GridView::widget([
                    'layout' => "{items}\n{pager}",
                    'dataProvider' => $templatePushProvider,
                    'pager' => [
                        'linkContainerOptions' => ['class' => 'page-item'],
                        'linkOptions' => ['class' => 'page-link'],
                        'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link']
                    ],
                    'columns' => [
                        TemplatePush::ATTR_TITLE,
                        TemplatePush::ATTR_BODY,
                        TemplatePush::ATTR_LANG,
                        [
                            'class' => ActionColumn::class,
                            'controller' => 'template-push',
                            'buttons' => [
                                'copy' => function ($url, $model)
                                {
                                    $url = ['/mailing/template-push/copy', 'id' => (string)$model->_id];
                                    $title = 'Дублировать сообщение';
                                    $icon = Html::tag('span', '', ['class' => 'far fa-copy']);
                                    $options = array_merge([
                                        'title' => $title,
                                        'aria-label' => $title,
                                        'data-pjax' => '0',
                                    ]);

                                    return Html::a($icon, $url, $options);
                                },
                            ],
                            'template' => '{update} {copy} {delete}'
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-5">
            <div class="card-header border-bottom">
                <h6 class="m-0">Telegram сообщения разделенные по языку</h6>
                <div class="actions">
                    <a class="btn-floating-action"
                       href="<?= Url::to(['/mailing/template-telegram/create', 'templateId' => (string)$model->_id]) ?>"
                       data-toggle="tooltip" data-placement="top" data-original-title="Add new">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0 pb-3">
                <?= GridView::widget([
                    'layout' => "{items}\n{pager}",
                    'dataProvider' => $templateTelegramProvider,
                    'pager' => [
                        'linkContainerOptions' => ['class' => 'page-item'],
                        'linkOptions' => ['class' => 'page-link'],
                        'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link']
                    ],
                    'columns' => [
                        TemplateTelegram::ATTR_SUBJECT,
                        [
                            'attribute' => TemplateTelegram::ATTR_BODY,
                            'format' => 'html',
                            'value' => function ($model)
                            {
                                return nl2br($model->body);
                            }
                        ],
                        TemplateTelegram::ATTR_LANG,
                        [
                            'class' => ActionColumn::class,
                            'controller' => 'template-telegram',
                            'buttons' => [
                                'copy' => function ($url, $model)
                                {
                                    $url = ['/mailing/template-telegram/copy', 'id' => (string)$model->_id];
                                    $title = 'Дублировать сообщение';
                                    $icon = Html::tag('span', '', ['class' => 'far fa-copy']);
                                    $options = array_merge([
                                        'title' => $title,
                                        'aria-label' => $title,
                                        'data-pjax' => '0',
                                    ]);

                                    return Html::a($icon, $url, $options);
                                },
                            ],
                            'template' => '{update} {copy} {delete}'
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
