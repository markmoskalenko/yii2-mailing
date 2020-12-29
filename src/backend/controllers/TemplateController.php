<?php

namespace markmoskalenko\mailing\backend\controllers;

use markmoskalenko\mailing\common\models\mailingTestEmail\MailingTestEmail;
use markmoskalenko\mailing\common\models\template\Template;
use markmoskalenko\mailing\common\models\template\TemplateSearch;
use markmoskalenko\mailing\MailingModule;
use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Тарифные планы
 */
class TemplateController extends Controller
{

    /**
     * @return string|Response
     */
    public function actionIndex($group = Template::GROUP_TRIGGER)
    {
        $searchModel = new TemplateSearch();
        $searchModel->group = $group;
        $dataProvider = $searchModel->search(array_merge(Yii::$app->request->get()));

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'group' => $group
        ]);
    }

    /**
     * @return string|Response
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
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $templateEmailProvider = new ActiveDataProvider([
            'query' => $model->getTemplateEmail()
        ]);

        $templateTelegramProvider = new ActiveDataProvider([
            'query' => $model->getTemplateTelegram()
        ]);

        $templatePushProvider = new ActiveDataProvider([
            'query' => $model->getTemplatePush()
        ]);

        $templateStoryProvider = new ActiveDataProvider([
            'query' => $model->getTemplateStory()
        ]);
        
        $emails = MailingTestEmail::getAllForView();

        return $this->render('view', [
            'model' => $model,
            'templateEmailProvider' => $templateEmailProvider,
            'templateTelegramProvider' => $templateTelegramProvider,
            'templatePushProvider' => $templatePushProvider,
            'templateStoryProvider' => $templateStoryProvider,
            'emails' => $emails,
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
            return $this->redirect(['/mailing/template/view', 'id' => (string)$model->_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
        $group = $model->group;

        $model->delete();

        return $this->redirect(['/mailing/template/index', 'group' => $group]);
    }

    /**
     * @param $id
     * @return Response
     */
    public function actionSaveTestEmail($id)
    {
        $emails = Yii::$app->request->post('mailingTestEmail');
        $emails = explode(',', $emails);
        MailingTestEmail::deleteAll();
        foreach ($emails as $email) {
            $model = new MailingTestEmail();
            $model->email = $email;
            $model->save();
        }

        return $this->redirect(['/mailing/template/view', 'id' => $id]);
    }
    
    /**
     * @param $key
     * @throws InvalidConfigException
     */
    public function actionTest($key, $type)
    {
        $users = MailingTestEmail::find()->select(['email'])->column();

        foreach ($users as $user) {
            /** @var MailingModule $mailing */
            $mailing = Yii::$app->getModule('mailing');
            $user = $mailing->userClass::findByEmail($user);
            if ($user) {
                switch ($type){
                    case 'email':
                        $mailing->send($user->getEmail(), $key, []);
                        break;
                    case 'strory':
                        $mailing->sendStory($user->getId(), $key);
                        break;
                    case 'push':
                        $mailing->sendPush($user->getId(), $key, []);
                        break;
                    case 'telegram':
                        $mailing->sendTelegram($user->getId(), $key, []);
                        break;
                }
            }
        }
    }

    public function actionCopy($id)
    {
        $model = $this->findModel($id);
        $model->copy();

        return $this->redirect(['/mailing/template/index', 'gorup' => $gorup]);
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
