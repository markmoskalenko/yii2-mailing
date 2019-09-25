<?php

namespace markmoskalenko\mailing;

use markmoskalenko\mailing\common\interfaces\UserInterface;
use markmoskalenko\mailing\common\jobs\SendMailiJob;
use markmoskalenko\mailing\common\jobs\SendTelegramJob;
use markmoskalenko\mailing\common\models\emailSendLog\EmailSendLog;
use markmoskalenko\mailing\common\models\telegramSendLog\TelegramSendLog;
use Telegram\Bot\Api;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;

/**
 * Class MailingModule
 * @package mailing
 */
class MailingModule extends \yii\base\Module implements BootstrapInterface
{
    /**
     * Telegram API
     *
     * @var string
     */
    public $telegramApi;

    /**
     * Email отправителя
     *
     * @var string
     */
    public $senderEmail;

    /**
     * Название Telegram отправителя
     *
     * @var string
     */
    public $senderTelegram;

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
    private $_links;

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
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if (Yii::$app instanceof \yii\console\Application) {
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
     * @param string $email
     * @param string $key
     * @param array  $data
     * @param int    $delay
     * @throws InvalidConfigException
     */
    public function send($email, $key, $data = [], $delay = 0)
    {
        $user = $this->userClass::findByEmail($email);
        $logId = EmailSendLog::start($email, $key, $user);

        if ($logId !== false) {
            /** @var yii\queue\redis\Queue $queue */
            $queue = Yii::$app->get('queue');
            $queue->delay($delay)->push(new SendMailiJob([
                'key'         => $key,
                'email'       => $email,
                'data'        => $data,
                'logId'       => $logId,
                'senderEmail' => $this->senderEmail,
                'senderName'  => $this->senderName,
                'ourDomain'   => $this->ourDomain,
                'links'       => $this->_links,
                'ssl'         => $this->ssl,
                'userClass'   => $this->userClass
            ]));
        } else {
            //@todo сообщение в телеграм
        }
    }

    /**
     * @param        $telegramId
     * @param string $key
     * @param array  $data
     * @param int    $delay
     */
    public function sendTelegram($telegramId, $key, $data = [], $delay = 0)
    {
        $user = $this->userClass::findByTelegramId($telegramId);
        $logId = TelegramSendLog::start($telegramId, $key, $user);

        if ($logId !== false) {
            /** @var yii\queue\redis\Queue $queue */
            $queue = Yii::$app->get('queue');
            $queue->delay($delay)->push(new SendTelegramJob([
                'key'            => $key,
                'telegramApi'    => new Api($this->telegramApi),
                'telegramId'     => $telegramId,
                'data'           => $data,
                'logId'          => $logId,
                'senderTelegram' => $this->senderTelegram,
                'senderName'     => $this->senderName,
                'ourDomain'      => $this->ourDomain,
                'links'          => $this->_links,
                'ssl'            => $this->ssl,
                'userClass'      => $this->userClass
            ]));
        } else {
            //@todo сообщение в телеграм
        }
    }

    /**
     * @param array $links
     * @throws InvalidConfigException on invalid argument.
     */
    public function setLinks($links)
    {
        if (!is_array($links) && !is_object($links)) {
            throw new InvalidConfigException('"' . get_class($this) . '::transport" should be either object or array, "' . gettype($links) . '" given.');
        }
        $this->_links = $links;
    }

    /**
     * @return array
     */
    public function getLinks()
    {
        return $this->_links;
    }
}
