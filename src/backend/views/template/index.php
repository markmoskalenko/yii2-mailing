<?php

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
?>

<div class="page-header row no-gutters">
  <div class="col-12 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">Список писем которые мы отправляем пользователям</span>
    <h3 class="page-title"><?= $this->title ?></h3>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-12">
      <?php foreach (Template::GROUP_NAME as $key => $item): ?>
        <a href="<?= Url::to(['/mailing/template/index', 'group' => $key]) ?>"
           class="btn btn-primary btn-sm <?= $key == $group ? 'btn-success' : '' ?>"><?= $item ?></a>
      <?php endforeach; ?>
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
              'layout' => "{items}\n{pager}",
              'dataProvider' => $dataProvider,
              'pager' => [
                  'linkContainerOptions' => ['class' => 'page-item'],
                  'linkOptions' => ['class' => 'page-link'],
                  'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link']
              ],
              'columns' => [
                  [
                      'attribute' => Template::ATTR_NAME,
                      'format' => 'raw',
                      'value' => function (Template $model)
                      {
                          return Html::a($model->name, ['view', 'id' => (string)$model->_id]);
                      }
                  ],
                  [
                      'header' => 'Цели',
                      'headerOptions' => [
                          'width' => '150px'
                      ],
                      'value' => function (Template $model)
                      {
                          $result = [];

                          if ($model->templateEmail) {
                              $result[] = 'Email';
                          }
                          if ($model->templatePush) {
                              $result[] = 'Push';
                          }

                          if ($model->templateTelegram) {
                              $result[] = 'Telegram';
                          }

                          if ($model->templateStory) {
                              $result[] = 'Story';
                          }

                          return implode(', ', $result);
                      }
                  ],
                  [
                      'class' => ActionColumn::class,
                      'headerOptions' => [
                          'width' => '100px'
                      ],
                      'buttons' => [
                          'copy' => function ($url, $model)
                          {
                              $url = ['/mailing/template/copy', 'id' => (string)$model->_id];
                              $title = 'Дублировать письмо';
                              $icon = Html::tag('span', '', ['class' => 'far fa-copy']);
                              $options = array_merge([
                                  'title' => $title,
                                  'aria-label' => $title,
                                  'data-pjax' => '0',
                                  'data-confirm' => 'Дублировать письмо?'
                              ]);

                              return Html::a($icon, $url, $options);
                          },
                      ],
                      'template' => '{copy} {view} {update} {delete}'
                  ],
              ],
          ]); ?>
      </div>
    </div>
  </div>
</div>


