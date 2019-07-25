<?php

namespace markmoskalenko\mailing\backend\controllers;

use markmoskalenko\mailing\common\models\emailSendLog\EmailSendLogSearch;
use Yii;

/**
 * Лог
 */
class EmailSendLogController extends Controller
{

    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $sarchModel = new EmailSendLogSearch();
        $dataProvider = $sarchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            '$sarchModel'  => $sarchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}
