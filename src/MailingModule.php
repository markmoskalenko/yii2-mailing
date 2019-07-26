<?php

namespace markmoskalenko\mailing;

use markmoskalenko\mailing\common\interfaces\UserInterface;
use markmoskalenko\mailing\common\jobs\SendMailiJob;
use markmoskalenko\mailing\common\models\emailSendLog\EmailSendLog;
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
     * @throws \yii\base\InvalidConfigException
     */
    public function send($email, $key, $data = [])
    {
        $logId = EmailSendLog::start($email, $key);

        if ($logId !== false) {
            /** @var yii\queue\redis\Queue $queue */
            $queue = Yii::$app->get('queue');
            $queue->push(new SendMailiJob([
                'key'   => $key,
                'email' => $email,
                'data'  => $data,
                'logId' => $logId,
                'user' => $this->userClass,
                'senderEmail' => $this->senderEmail,
                'senderName' => $this->senderName,
                'ourDomain' => $this->ourDomain,
                'links' => $this->_links,
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
