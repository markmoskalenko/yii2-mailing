<?php

use markmoskalenko\mailing\backend\grid\ActionColumn;
use markmoskalenko\mailing\common\models\template\Template;
use markmoskalenko\mailing\common\models\templateEmail\TemplateEmail;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var yii\web\View $this */
/* @var Template $model */
/* @var ActiveDataProvider $templateEmailProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Письма', 'url' => ['/mailing/template/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tariff-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-warning" role="alert">
        Тут отображаются все шаблоны писем для отправки на разных языках.
        Это могут быть шаблонs отправки для Email и/или Telegram.
    </div>

    <h3 class="mt-5">Email шаблоны писем
        <?= Html::a('<i class="fas fa-plus"></i>',
            ['/mailing/template-email/create', 'templateId' => (string)$model->_id],
            ['class' => 'btn btn-success btn-sm']) ?>
    </h3>

    <?= GridView::widget([
        'dataProvider' => $templateEmailProvider,
        'pager'        => [
            'linkContainerOptions'          => ['class' => 'page-item'],
            'linkOptions'                   => ['class' => 'page-link'],
            'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link']
        ],
        'columns'      => [
            TemplateEmail::ATTR_SUBJECT,
            TemplateEmail::ATTR_LANG,
            TemplateEmail::ATTR_AFFILIATE_DOMAIN,
            [
                'class'      => ActionColumn::class,
                'controller' => 'template-email',
                'buttons'    => [
                    'copy' => function ($url, $model) {
                        $url = ['/mailing/template-email/copy', 'id' => (string)$model->_id];
                        $title = 'Дублировать письмо';
                        $icon = Html::tag('span', '', ['class' => 'far fa-copy']);
                        $options = array_merge([
                            'title'      => $title,
                            'aria-label' => $title,
                            'data-pjax'  => '0',
                        ]);
                        return Html::a($icon, $url, $options);
                    },
                ],
                'template'   => '{update} {copy} {delete}'
            ],
        ],
    ]); ?>
</div>
