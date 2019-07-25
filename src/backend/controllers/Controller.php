<?php

namespace markmoskalenko\mailing\backend\controllers;

use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * Базовый класс контроллеров
 */
class Controller extends \yii\web\Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @param        $condition
     * @param string $title
     * @throws NotFoundHttpException
     */
    public function ensureExists($condition, $title = 'Страница не найдена')
    {
        if (!$condition) {
            throw new NotFoundHttpException($title);
        }
    }

    /**
     * @param string  $permissionName
     * @param array   $params
     * @param boolean $allowCaching
     * @throws ForbiddenHttpException
     */
    public function ensureAllowed($permissionName, $params = [], $allowCaching = true)
    {
        if (!\Yii::$app->user->can($permissionName, $params, $allowCaching)) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
    }
}
