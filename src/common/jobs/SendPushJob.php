<?php

namespace markmoskalenko\mailing\common\jobs;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use markmoskalenko\mailing\common\interfaces\UserInterface;
use markmoskalenko\mailing\common\models\emailSendLog\EmailSendLog;
use markmoskalenko\mailing\common\models\template\Template;
use markmoskalenko\mailing\common\models\templatePush\TemplatePush;
use MongoDB\BSON\ObjectId;
use Throwable;
use yii\base\BaseObject;
use yii\base\ErrorException;
use yii\queue\JobInterface;
use yii\queue\Queue;

/**
 *
 */
class SendPushJob extends BaseObject implements JobInterface
{
    /**
     * Ключ шаблона письма
     * @var ObjectId
     */
    public $key;

    /**
     * ID пользователя
     * @var string
     */
    public $userId;

    /**
     * Данные для темплейта
     * @var array
     */
    public $data;

    /**
     * ID лога
     * @var string
     */
    public $logId;

    /**
     * @var UserInterface
     */
    public $userClass;

    /**
     * Пукть к firebase токену
     *
     * @var string
     */
    public $firebaseToken;

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @param Queue $queue
     * @return void
     * @throws ErrorException
     */
    public function execute($queue)
    {
        // Ищем пользователя по почте
        $this->user = $this->userClass::findOneById($this->userId);
        // Ищем шаблон по ключу
        $template = Template::findByKey($this->key);
        // Получаем лог отправки письма
        $log = EmailSendLog::findOne($this->logId);

        if (!$log) {
            // в телеграм
            throw new ErrorException('Лог не найден');
        }

        $fireBaseTokens = $this->user->getFirebaseToken();

        foreach ($fireBaseTokens as $token) {
            try {
                // Сообщение для отправки
                // Ищет по ключу, языку и домены партнера
                $templatePush = TemplatePush::findByKeyAndLang(
                    $template->_id,
                    $this->user->getLanguage()
                );

                if (!$templatePush) {
                    throw new ErrorException('Шаблон не найден templateId:' . $template->_id . ' language:' . $this->user->getLanguage());
                }

                // Имя пользователя
                $firstName = $this->user->getFirstName();

                $baseData = [
                    '{firstName}' => $firstName,
                ];

                $data = array_merge($baseData, $this->data);

                $body = $templatePush->body;

                // Подмена данных в шаблоне из переданных переменных
                foreach ($data as $key => $value) {
                    $body = str_replace($key, $value, $body);
                }

                $fireBaseToken = $token['token'];
                try {
                    $message = CloudMessage::withTarget('token', $fireBaseToken)
                        ->withNotification(Notification::create($templatePush->title, $body));

                    if ($templatePush->action) {
                        $message->withData([
                            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                            'action' => $templatePush->action
                        ]);
                    }
                    (new Factory())
                        ->withServiceAccount($this->firebaseToken)
                        ->createMessaging()
                        ->send($message);

                    $log->send();
                } catch (\Kreait\Firebase\Exception\Messaging\NotFound $e) {
                    echo 'error: ' . $fireBaseToken . PHP_EOL;
                    $this->user->deleteFirebaseToken($token);
                }

            } catch (Throwable $e) {
                $log->setError('Ошибка отправки');
                $message = $e->getMessage();
                $message .= '<br>' . $e->getTraceAsString();
                echo $message . PHP_EOL;
                $log->setError($message);

                throw new $e;
            }
        }
    }
}
