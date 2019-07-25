<?php

namespace markmoskalenko\mailing\backend\controllers;

use markmoskalenko\mailing\common\models\template\Template;
use markmoskalenko\mailing\common\models\template\TemplateSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Тарифные планы
 */
class TemplateController extends Controller
{

    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $sarchModel = new TemplateSearch();
        $dataProvider = $sarchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            '$sarchModel'  => $sarchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Template();

        if ($model->load(Yii::$app->request->post(), null) && $model->save()) {
            return $this->redirect(['/mailing/template/view', 'id' => (string)$model->_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $templateEmailProvider = new ActiveDataProvider([
            'query' => $model->getTemplateEmail()
        ]);

        return $this->render('view', [
            'model'                 => $model,
            'templateEmailProvider' => $templateEmailProvider,
        ]);
    }


    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post(), null) && $model->save()) {
            return $this->redirect(['/mailing/template/view', 'id' => (string)$model->_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['/mailing/template/view', 'id' => (string)$model->_id]);
    }


    /**
     * @param $id
     * @return Template|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Template::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
