<?php

use markmoskalenko\mailing\backend\grid\ActionColumn;
use markmoskalenko\mailing\common\models\template\Template;
use markmoskalenko\mailing\common\models\templateEmail\TemplateEmail;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var yii\web\View $this */
/* @var Template $model */
/* @var ActiveDataProvider $templateEmailProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Письма', 'url' => ['/mailing/template/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header row no-gutters py-4">
    <div class="col-12 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Информация</span>
        <h3 class="page-title"><?= Html::encode($this->title) ?></h3>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card mb-5">
            <div class="card-header border-bottom">
                <h6 class="m-0">Список</h6>
                <div class="actions">
                    <a class="btn-floating-action" href="<?= Url::to(['/mailing/template-email/create', 'templateId' => (string)$model->_id]) ?>" data-toggle="tooltip" data-placement="top" data-original-title="Add new">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0 pb-3">
                <div class="alert alert-warning" role="alert">
                    Тут отображаются все шаблоны писем для отправки на разных языках.
                    Это могут быть шаблонs отправки для Email и/или Telegram.
                </div>
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
        </div>
    </div>
</div>
