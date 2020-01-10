<?php

namespace markmoskalenko\mailing\backend\controllers;

use markmoskalenko\mailing\common\models\templatePush\TemplatePush;
use Yii;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Шаблоны Telegram
 */
class TemplatePushController extends Controller
{
    /**
     * @param $templateId
     * @return string|Response
     */
    public function actionCreate($templateId)
    {
        $model = new TemplatePush();
        $model->templateId = $templateId;

        if ($model->load(Yii::$app->request->post(), null) && $model->save()) {
            return $this->redirect(['/mailing/template/view', 'id' => (string)$model->templateId]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post(), null) && $model->save()) {
            return $this->redirect(['/mailing/template/view', 'id' => (string)$model->templateId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionCopy($id)
    {
        $model = $this->findModel($id);
        $newModel = new TemplatePush();
        $newModel->setAttributes($model->getAttributes());
        $newModel->save();

        return $this->redirect(['/mailing/template/view', 'id' => (string)$model->templateId]);
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['/mailing/template/view', 'id' => (string)$model->templateId]);
    }


    /**
     * @param $id
     * @return TemplatePush|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = TemplatePush::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
