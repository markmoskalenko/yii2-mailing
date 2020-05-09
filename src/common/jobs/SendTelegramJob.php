<?php

namespace markmoskalenko\mailing\common\jobs;

use markmoskalenko\mailing\common\helpers\LinksHelpers;
use markmoskalenko\mailing\common\interfaces\UserInterface;
use markmoskalenko\mailing\common\models\emailSendLog\EmailSendLog;
use markmoskalenko\mailing\common\models\template\Template;
use markmoskalenko\mailing\common\models\templateTelegram\TemplateTelegram;
use MongoDB\BSON\ObjectId;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\ForceReply;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;
use yii\base\BaseObject;
use yii\base\ErrorException;
use yii\queue\JobInterface;

/**
 *
 */
class SendTelegramJob extends BaseObject implements JobInterface
{
    /**
     * Ключ шаблона письма
     * @var ObjectId
     */
    public $key;

    /**
     * Telegram token Api
     * @var string
     */
    public $telegramTokenApi;

    /**
     * ID пользователя
     * @var string
     */
    public $userId;

    /**
     * Данные для темплейта
     * @var array
     */
    public $data = [];

    /**
     * ID лога
     * @var string
     */
    public $logId;

    /**
     * @var UserInterface
     */
    public $user;

    /**
     * Массив ссылок
     *
     * @var array
     */
    public $links;

    /**
     * @var string
     */
    public $ourDomain;

    /**
     * @var boolean
     */
    public $ssl;

    /**
     * @var UserInterface
     */
    public $userClass;

    /**
     * Шаблон письма
     *
     * @var string
     */
    public $layout = 'html';

    /**
     * @var BotApi
     */
    private $telegramApi;

    public function execute($queue)
    {
        $this->telegramApi = new BotApi($this->telegramTokenApi);
        $this->user = $this->userClass::findOneById($this->userId);

        $template = Template::findByKey($this->key);

        $log = EmailSendLog::findOne($this->logId);

        try {
            if (!$log) {
                // в телеграм
                throw new ErrorException('Лог не найден');
            }

            if (!$template) {
                throw new ErrorException('Шаблон не найден ' . $this->key);
            }

            if (!$this->user) {
                throw new ErrorException('Пользователь не найден ' . $this->userId);
            }

            if (!$this->user->getTelegramId()) {
                throw new ErrorException('Телеграм не подключен ' . $this->userId);
            }

            // Поиск основного партнера по реферальному домену
            // @todo переименовать в affiliate
            $referral = $this->user->getReferralByAffiliateDomain()->one();

            $data = LinksHelpers::getLinks(
                $this->user,
                $referral,
                $this->ssl,
                $this->links,
                $this->ourDomain,
                $this->logId,
                $this->data
            );

            // Шаблон письма для отправки
            // Ищет по ключу, языку и домену партнера
            $templateTelegram = TemplateTelegram::findByKeyAndLangAndAffiliateDomain(
                $template->_id,
                $this->user->getLanguage(),
                $data['{sourceDomain}']
            );

            if (!$templateTelegram) {
                throw new ErrorException('Шаблон не найден ' . $this->key . ':' . $data['{sourceDomain}']);
            }

            $body = $templateTelegram->body;

            // Подмена данных в шаблоне из переданных переменных
            foreach ($data as $key => $value) {
                $body = str_replace($key, $value, $body);
            }

            $keyboard = [];
            foreach ($templateTelegram->keyboard as $item) {
                if (isset($item['url'])) {
                    foreach ($data as $key => $value) {
                        $item['url'] = str_replace($key, $value, $item['url']);
                    }
                }

                $keyboard[] = $item;
            }

            $isSend = $this->sendTelegramMessage($body, $templateTelegram->picture ?: false, $keyboard);

            if ($isSend) {
                $log->send();
            } else {
                $log->setError('Ошибка отправки');
            }
        } catch (\Throwable $e) {
            $message = '';
            $message .= '<br>' . $e->getMessage();
            $message .= '<br>' . $e->getTraceAsString();
            $log->setError($message);
            $this->user->disableTelegram();

            throw new $e;
        }
    }


    /**
     * Отправка письма в телеграм
     * @param            $text
     * @param bool       $telegramPhoto
     * @param array|bool $keyboard
     * @return bool
     */
    private function sendTelegramMessage($text, $telegramPhoto = false, $keyboard = false)
    {
        $replyMarkup = null;
        $telegramId = $this->user->getTelegramId();
        if (is_array($keyboard)) {
            $keyboard = array_chunk($keyboard, 3);
            $replyMarkup = new InlineKeyboardMarkup($keyboard);
        }

        if ($telegramPhoto) {
            $this->telegramApi->sendPhoto($telegramId, $telegramPhoto, $text, null, $replyMarkup, false, 'html');
        } else {
            $this->telegramApi->sendMessage($telegramId, $text, 'html', false, null, $replyMarkup, false);
        }

        return true;
    }
}
