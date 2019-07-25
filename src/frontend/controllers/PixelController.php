<?php

namespace markmoskalenko\mailing\frontend\controllers;

use markmoskalenko\mailing\common\models\emailSendLog\EmailSendLog;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Пиксель для отслеживания открытия писем
 */
class PixelController extends Controller
{
    /**
     * Открытие письма
     *
     * @param $logId
     * @return \yii\console\Response|Response
     */
    public function actionOpen($logId)
    {
        EmailSendLog::open($logId, Yii::$app->request->userIP);
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_RAW;
        $response->headers->add('content-type', 'image/png');
        $response->data = file_get_contents(Yii::getAlias('@frontend/web/images/pixel.png'));

        return $response;
    }
}
