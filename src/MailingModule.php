<?php

namespace markmoskalenko\mailing;

use markmoskalenko\mailing\common\helpers\LinksHelpers;
use markmoskalenko\mailing\common\interfaces\BroadcastServiceInterface;
use markmoskalenko\mailing\common\interfaces\UserInterface;
use markmoskalenko\mailing\common\jobs\SendMailingJob;
use markmoskalenko\mailing\common\jobs\SendPushJob;
use markmoskalenko\mailing\common\jobs\SendStoryJob;
use markmoskalenko\mailing\common\jobs\SendTelegramJob;
use markmoskalenko\mailing\common\models\emailSendLog\EmailSendLog;
use markmoskalenko\mailing\common\models\story\Story;
use markmoskalenko\mailing\common\models\template\Template;
use markmoskalenko\mailing\common\models\templateStory\TemplateStory;
use markmoskalenko\mailing\common\services\StoryService;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\ErrorException;
use yii\base\InvalidConfigException;
use yii\base\Module;
use yii\console\Application;
use yii\helpers\ArrayHelper;

/**
 * Class MailingModule
 * @package mailing
 */
class MailingModule extends Module implements BootstrapInterface
{
    /**
     * Telegram token API
     *
     * @var string
     */
    public $telegramTokenApi;

    /**
     * Firebase token
     *
     * @var string
     */
    public $firebaseToken;

    /**
     * Email отправителя
     *
     * @var string
     */
    public $senderEmail;

    /**
     * Имя отправителя
     *
     * @var string
     */
    public $senderName;

    /**
     * Массив ссылок
     *
     * @var array
     */
    public $links = [];

    /**
     * @var UserInterface
     */
    public $userClass;

    /**
     *
     * @var string
     */
    public $ourDomain;

    /**
     * @var boolean
     */
    public $ssl = true;

    /**
     * @var BroadcastServiceInterface
     */
    public $broadcastService;

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if (Yii::$app instanceof Application) {
            $this->initConsoleEnv();
        }
    }

    /**
     * Инициализация окружения консольного апп
     */
    private function initConsoleEnv()
    {
        $this->controllerNamespace = 'markmoskalenko\mailing\console\controllers';
    }

    /**
     * @param string $email почта пользователя
     * @param string $key ключ email шаблона
     * @param array $data дополнительные данные для шаблона
     * @param int $delay задержка отправки
     * @throws InvalidConfigException
     */
    public function send($email, $key, $data = [], $delay = 0, $priority = 3)
    {
        /**
         * Пользователь
         */
        $user = $this->userClass::findByEmail($email);

        /**
         * Лог отправки письма
         */
        $logId = EmailSendLog::start($email, $key, $user);

        /** @var yii\queue\redis\Queue $queue */
        $queue = Yii::$app->get('queue');

        $queue
            ->delay($delay)
            ->priority($priority)
            ->push(new SendMailingJob([
                // Ключ шаблона
                'key' => $key,
                // Email пользователя
                'email' => $email,
                // Данные для шаблона
                'data' => $data,
                // ID лога
                'logId' => $logId,
                // Почта отправитель
                'senderEmail' => $this->senderEmail,
                // Имя отправителя
                'senderName' => $this->senderName,
                // Домен вайтлейбла
                'ourDomain' => $this->ourDomain,
                // Базовые ссылки
                // [api] => http://api.logtime.local
                // [signIn] => {host}/auth/sign-in
                // [payment] => {host}/payment
                // [unsubscribe] => {host}/auth/unsubscribe
                // [webApp] => app.{host}
                'links' => $this->links,
                // ssl
                'ssl' => $this->ssl,
                // Класс модели пользователя
                'userClass' => $this->userClass
            ]));
    }

    /**
     * @param        $userId
     * @param string $key ключ email шаблона
     * @param array $data дополнительные данные для шаблона
     * @param int $delay задержка отправки
     * @throws InvalidConfigException
     */
    public function sendPush($userId, $key, $data = [], $delay = 0, $priority = 3)
    {
        /** @var UserInterface $user пользователь */
        $user = $this->userClass::findOneById($userId);

        /** @var EmailSendLog $logId логер отправки */
        $logId = EmailSendLog::start($userId, $key, $user);

        /** @var yii\queue\redis\Queue $queue */
        $queue = Yii::$app->get('queue');

        $queue
            ->delay($delay)
            ->priority($priority)
            ->push(new SendPushJob([
                // Ключ шаблона
                'key' => $key,
                // Email пользователя
                'userId' => $userId,
                // Данные для шаблона
                'data' => $data,
                // ID лога
                'logId' => $logId,
                // Класс модели пользователя
                'userClass' => $this->userClass,
                // Токен авторизации firebase
                'firebaseToken' => $this->firebaseToken
            ]));
    }

    /**
     * @param        $userId
     * @param string $key
     * @param array $data
     * @param int $delay
     * @throws InvalidConfigException
     */
    public function sendTelegram($userId, $key, $data = [], $delay = 0, $priority = 3)
    {
        /** @var UserInterface $user пользователь */
        $user = $this->userClass::findOneById($userId);

        /** @var EmailSendLog $logId логер отправки */
        $logId = EmailSendLog::start($userId, $key, $user);

        /** @var yii\queue\redis\Queue $queue */
        $queue = Yii::$app->get('queue');
        $queue
            ->delay($delay)
            ->priority($priority)
            ->push(new SendTelegramJob([
                'key' => $key,
                'data' => $data,
                'logId' => $logId,
                'ourDomain' => $this->ourDomain,
                'links' => $this->links,
                'ssl' => $this->ssl,
                'userClass' => $this->userClass,
                'telegramTokenApi' => $this->telegramTokenApi,
                'userId' => $userId,
            ]));
    }

    /**
     * @param        $userId
     * @param string $key
     * @throws InvalidConfigException
     */
    public function sendStory($userId, $key, $isDispatch = true, $channel = Story::CHANNEL_GLOBAL)
    {
        $user = $this->userClass::findOneById($userId);
        $log = EmailSendLog::start($userId, $key, $user, true);
        $template = Template::findByKey($key);

        if (!$log) {
            // в телеграм
            throw new ErrorException('Лог не найден');
        }

        if (!$template) {
            throw new ErrorException('Шаблон не найден ' . $key);
        }

        if (!$user) {
            throw new ErrorException('Пользователь не найден ' . $userId);
        }

        // Поиск основного партнера по реферальному домену
        // @todo переименовать в affiliate
        $referral = $user->getReferralByAffiliateDomain()->one();

        $data = LinksHelpers::getLinks(
            $user,
            $referral,
            $this->ssl,
            $this->links,
            $this->ourDomain,
            (string)$log->_id
        );

        // Шаблон письма для отправки
        // Ищет по ключу, языку и домену партнера
        $templateStory = TemplateStory::findAllByKeyAndLangAndAffiliateDomain(
            $template->_id,
            $user->getLanguage(),
            $data['{sourceDomain}']
        );

        if (!$templateStory) {
            throw new ErrorException('Шаблон не найден :' . $user->getLanguage() . ':' . $key . ':' . $data['{sourceDomain}']);
        }

        $newStoriesId = [];
        foreach ($templateStory as $story) {
            $storyService = new StoryService();
            $newStoriesId[] = $storyService->sendStroy($story, $userId, $channel)->_id;
        }

        if ($isDispatch) {
            $stories = Story::find()
                ->owner($userId)
                ->active()
                ->globalChannel()
                ->orderBy(['_id' => SORT_ASC])
                ->all();
            
            $stories = ArrayHelper::toArray($stories);
            $dispatchService = new $this->broadcastService;
            $dispatchService->dispatch('[Story] Update', ['stories' => $stories], true, (string)$userId);
        }

        return $newStoriesId;
    }
}
