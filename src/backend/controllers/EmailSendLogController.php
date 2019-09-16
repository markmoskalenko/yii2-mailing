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
        $searchModel = new EmailSendLogSearch();
        $dataProvider = $searchModel->searchAdmin(Yii::$app->request->get());

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}
