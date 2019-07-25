<?php

namespace markmoskalenko\mailing;

use markmoskalenko\mailing\common\interfaces\UserInterface;
use markmoskalenko\mailing\common\jobs\SendMailiJob;
use markmoskalenko\mailing\common\models\emailSendLog\EmailSendLog;
use Yii;
use yii\base\BootstrapInterface;

/**
 * Class MailingModule
 * @package mailing
 */
class MailingModule extends \yii\base\Module implements BootstrapInterface
{
    /**
     * @var UserInterface
     */
    public $userClass;

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
            ]));
        } else {
            //@todo сообщение в телеграм
        }
    }
}
