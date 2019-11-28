<?php

use common\models\questionOfDay\QuestionOfDay;
use markmoskalenko\mailing\backend\grid\ActionColumn;
use markmoskalenko\mailing\common\models\template\Template;
use markmoskalenko\mailing\common\models\template\TemplateSearch;
use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel TemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Письма';
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
        <div class="card mb-5">
            <div class="card-header border-bottom">
                <h6 class="m-0">Список</h6>

                <div class="actions">
                    <a class="btn-floating-action" href="<?= Url::to(['create']) ?>" data-toggle="tooltip"
                       data-placement="top" data-original-title="Add new">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0 pb-3">
                <?= GridView::widget([
                    'layout'       => "{items}\n{pager}",
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
                            'class'         => ActionColumn::class,
                            'headerOptions' => [
                                'width' => '80px'
                            ],
                            'buttons'       => [
                                'test' => function ($url, $model)
                                {
                                    $url = Url::to(['/mailing/template/test', 'key' => $model->key]);
                                    $options = array_merge([
                                        'title'      => 'Тестовая отправка',
                                        'aria-label' => 'Тестовая отправка',
                                        'data-pjax'  => '1',
                                        'onclick'    => "$.get('".$url."'); return false;"
                                    ]);
                                    $icon = Html::tag('span', '', ['class' => 'far fa-paper-plane']);

                                    return Html::a($icon, '', $options);
                                }
                            ],
                            'template'      => '{test} {view} {update} {delete}'
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>


