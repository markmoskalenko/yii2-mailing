<?php

namespace markmoskalenko\mailing\common\jobs;

use markmoskalenko\mailing\common\interfaces\UserInterface;
use markmoskalenko\mailing\common\models\emailSendLog\EmailSendLog;
use markmoskalenko\mailing\common\models\template\Template;
use markmoskalenko\mailing\common\models\templateEmail\TemplateEmail;
use MongoDB\BSON\ObjectId;
use Yii;
use yii\base\BaseObject;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\queue\JobInterface;
use yii\queue\Queue;
use yii\swiftmailer\Mailer;

/**
 *
 */
class SendMailingJob extends BaseObject implements JobInterface
{
    /**
     * Ключ шаблона письма
     * @var ObjectId
     */
    public $key;

    /**
     * Почта пользователя
     * @var string
     */
    public $email;

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
    public $user;

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
     * Массив базовых ссылок приложения
     *
     * @var array
     */
    public $links;

    /**
     * Домен logtime.ru / mybase.pro
     *
     * @var string
     */
    public $ourDomain;

    /**
     * Включен ли ssl
     *
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
     * @param Queue $queue
     * @return void
     * @throws ErrorException
     */
    public function execute($queue)
    {
        // Ищем пользователя по почте
        $this->user = $this->userClass::findByEmail($this->email);
        // Ищем шаблон по ключу
        $template = Template::findByKey($this->key);
        // Получаем лог отправки письма
        $log = EmailSendLog::findOne($this->logId);
        // Отправитель
        $sender = [$this->senderEmail => $this->senderName];

        if (!$log) {
            // в телеграм
            throw new ErrorException('Лог не найден');
        }

        //        try {
        if (!$template) {
            throw new ErrorException('Шаблон не найден ' . $this->key);
        }

        if (!$this->user) {
            throw new ErrorException('Пользователь не найден ' . $this->email);
        }

        // Поиск основного партнера по реферальному домену
        // @todo переименовать в affiliate
        $referral = $this->user->getReferralByAffiliateDomain()->one();

        // Домен на который будут перенаправлять все письма
        // Если нету партнера тогда ставим наш домен
        $sourceDomain = $referral ? $referral->affiliateDomain : $this->ourDomain;

        // Шаблон письма для отправки
        // Ищет по ключу, языку и домены партнера
        $templateEmail = TemplateEmail::findByKeyAndLangAndAffiliateDomain(
            $template->_id,
            $this->user->getLanguage(),
            $sourceDomain
        );

        if (!$templateEmail) {
            throw new ErrorException('Шаблон не найден ' . $this->key . ':' . $sourceDomain);
        }

        // Защищенный протокол или нет
        $scheme = $this->ssl ? 'https://' : 'http://';

        // Api хост
        $apiEndpoint = ArrayHelper::getValue($this->links, 'api');

        // Ссылка на приложение app.{host}.ru
        $webAppLink = ArrayHelper::getValue($this->links, 'webApp');

        // Заменяем плейсхолдер {host} на домен партнера или наш
        $webAppLink = $scheme . str_replace('{host}', $sourceDomain, $webAppLink);

        // Ссылка для отписки
        $unsubscribeLink = ArrayHelper::getValue($this->links, 'unsubscribe');
        $unsubscribeLink .= "?email={$this->user->getEmail()}";
        $unsubscribeLink = str_replace('{host}', $webAppLink, $unsubscribeLink);

        // Имя пользователя
        $firstName = $this->user->getFirstName();

        // Почта
        $email = $this->user->getEmail();

        $signUpAt = $this->user->getCreatedAt()->toDateTime()->format('d.m.Y');

        $expiredAt = $this->user->getExpiredAt()->toDateTime()->format('d.m.Y');
        $currentYear = date('Y');

        $pixelUrl = "{$apiEndpoint}/mailing/pixel/open/{$this->logId}.png";


        $authUrl = ArrayHelper::getValue($this->links, 'signIn');
        $authUrl = str_replace('{host}', $webAppLink, $authUrl);
        $authUrl .= "?token={$this->user->getAccessToken()}";


        $paymentLink = $authUrl . '&redirect=/payment';
        $affiliateLink = $authUrl . '&redirect=/affiliate/balance';
        $buttonLink = $authUrl . '&redirect=/calendar';


        // Подставляем домен в переданные переменные
        foreach ((array)$this->data as $key => $value) {
            $this->data[$key] = str_replace('{host}', $webAppLink, $value);
        }

        $baseData = [
            '{userId}'          => (string)$this->user->getId(),
            '{webAppLink}'      => $webAppLink,
            '{unsubscribeLink}' => $unsubscribeLink,
            '{firstName}'       => $firstName,
            '{email}'           => $email,
            '{signUpAt}'        => $signUpAt,
            '{expiredAt}'       => $expiredAt,
            '{currentYear}'     => $currentYear,
            '{pixelUrl}'        => $pixelUrl,
            '{paymentLink}'     => $paymentLink,
            '{affiliateLink}'   => $affiliateLink,
            '{buttonLink}'      => $buttonLink,
        ];

        $data = array_merge($baseData, $this->data);

        if ($referral
            && $referral->affiliateSmtpSenderEmail
            && $referral->affiliateSmtpSenderName
            && $referral->affiliateSmtpHost
            && $referral->affiliateSmtpEncryption
            && $referral->affiliateSmtpUsername
            && $referral->affiliateSmtpPassword
            && $referral->affiliateSmtpPort) {

            /** @var Mailer $mailer */
            $mailer = Yii::createObject([
                'class'     => Mailer::class,
                'viewPath'  => '@common/mail',
                'transport' => [
                    'class'      => 'Swift_SmtpTransport',
                    'host'       => $referral->affiliateSmtpHost,
                    'encryption' => $referral->affiliateSmtpEncryption,
                    'username'   => $referral->affiliateSmtpUsername,
                    'password'   => $referral->affiliateSmtpPassword,
                    'port'       => $referral->affiliateSmtpPort,
                ],
            ]);

            $sender = [$referral->affiliateSmtpSenderEmail => $referral->affiliateSmtpSenderName];
        } else {
            $mailer = Yii::$app->mailer;
        }

        $body = $templateEmail->body;
        $body = str_replace('src="/images', 'src="' . $apiEndpoint . '/images', $body);
        $body = str_replace('src=\'/images', 'src=\'' . $apiEndpoint . '/images', $body);
        $body = str_replace('url("/images', 'url("' . $apiEndpoint . '/images', $body);
        $body = str_replace('url(\'/images', 'url(\'' . $apiEndpoint . '/images', $body);
        $body = str_replace('url(/images', 'url(' . $apiEndpoint . '/images', $body);

        // Пиксель для проверки открытия письма
        $body .= Html::img($pixelUrl, [
            'style' => 'positions: absolute; left: -99999px;bottom:-99999px; width:0px; height: 0px;'
        ]);

        // Подмена данных в шаблоне из переданных переменных
        foreach ($data as $key => $value) {
            $body = str_replace($key, $value, $body);
        }

        $isSend = $mailer
            ->compose('layouts/' . $this->layout, ['content' => $body])
            ->setSubject($templateEmail->subject)
            ->setFrom($sender)
            ->setTo($this->email)
            ->send();

        if ($isSend) {
            $log->send();
        } else {
            $log->setError('Ошибка отправки');
        }
        //        } catch (Throwable $e) {
        //            $message = '[Отправитель]: ' . print_r($sender, true);
        //            $message .= '<br>' . $e->getMessage();
        //
        //            $message .= '<br>' . $e->getTraceAsString();
        //
        //            echo $message . PHP_EOL;
        //
        //            $log->setError($message);
        //
        //            throw new $e;
        //        }
    }
}
