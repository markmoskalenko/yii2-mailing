<?php

namespace markmoskalenko\mailing\backend\controllers;

use markmoskalenko\mailing\common\models\emailSendLog\EmailSendLog;
use markmoskalenko\mailing\common\models\emailSendLog\EmailSendLogSearch;
use MongoDB\BSON\ObjectId;
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

    /**
     * @param $id
     * @return string
     */
    public function actionTrace($id)
    {
        $log = EmailSendLog::findOne(new ObjectId($id));

        return $log->error;
    }
}
