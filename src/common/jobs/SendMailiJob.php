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
use yii\swiftmailer\Mailer;

/**
 *
 */
class SendMailiJob extends BaseObject implements JobInterface
{
    /**
     * @var ObjectId
     */
    public $key;

    /**
     * @var string
     */
    public $email;

    /**
     * @var array
     */
    public $data;

    /**
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
     * @param \yii\queue\Queue $queue
     * @return bool
     * @throws ErrorException
     * @throws \yii\base\InvalidConfigException
     */
    public function execute($queue)
    {
        $this->user = $this->userClass::findByEmail($this->email);

        $template = Template::findByKey($this->key);

        $log = EmailSendLog::findOne($this->logId);
        $sender = [$this->senderEmail => $this->senderName];

        try {
            if (!$log) {
                // в телеграм
                throw new ErrorException('Лог не найден');
            }


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
            $templateEmail = TemplateEmail::findByKeyAndLangAndAffiliateDomain($template->_id, $this->user->getLanguage(),
                $sourceDomain);

            if (!$templateEmail) {
                throw new ErrorException('Шаблон не найден ' . $this->key . ':' . $sourceDomain);
            }

            $webAppLink = ArrayHelper::getValue($this->links, 'webApp');
            $singInLink = ArrayHelper::getValue($this->links, 'signIn');
            $paymentLink = ArrayHelper::getValue($this->links, 'payment');
            $unsubscribeLink = ArrayHelper::getValue($this->links, 'unsubscribe');

            $unsubscribeLink .= "?email={$this->user->getEmail()}";

            $scheme = $this->ssl ? 'https://' : 'http://';

            // Корневая ссылка на app.
            $webAppLink = $scheme . str_replace('{host}', $sourceDomain, $webAppLink);

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

            // Ссылка на регистрацию
            $singInLink = str_replace('{host}', $webAppLink, $singInLink);
            // Ссылка на оплату
            $paymentLink = str_replace('{host}', $webAppLink, $paymentLink);
            // Ссылка отписаться от рассылок
            $unsubscribeLink = str_replace('{host}', $webAppLink, $unsubscribeLink);

            // Подставляем домен в переданные переменные
            foreach ((array)$this->data as $key => $value) {
                $this->data[$key] = str_replace('{host}', $webAppLink, $value);
            }

            // API
            $apiEndpoint = ArrayHelper::getValue($this->links, 'api');

            // Имя пользователя
            $body = str_replace('{firstName}', $this->user->getFirstName(), $templateEmail->body);

            // Ссылка на проект
            $body = str_replace('{webAppLink}', $webAppLink, $body);

            // Ссылка на авторизацию
            $body = str_replace('{singInLink}', $singInLink, $body);

            // Ссылка на оплату
            $body = str_replace('{paymentLink}', $paymentLink, $body);

            // Почта
            $body = str_replace('{email}', $this->user->getEmail(), $body);

            //@todo добавить токен отписки
            $body = str_replace('{unsubscribeLink}', $unsubscribeLink, $body);

            // Дата регистрации
            $body = str_replace('{signUpAt}', $this->user->getCreatedAt()->toDateTime()->format('d.m.Y'), $body);

            // Дата оплаты
            $body = str_replace('{expiredAt}', $this->user->getExpiredAt()->toDateTime()->format('d.m.Y'), $body);


            // Текущая год
            $body = str_replace('{currentYear}', date('Y'), $body);


            $body = str_replace('src="/images', 'src="' . $apiEndpoint . '/images', $body);
            $body = str_replace('src=\'/images', 'src=\'' . $apiEndpoint . '/images', $body);
            $body = str_replace('url("/images', 'url("' . $apiEndpoint . '/images', $body);
            $body = str_replace('url(\'/images', 'url(\'' . $apiEndpoint . '/images', $body);
            $body = str_replace('url(/images', 'url(' . $apiEndpoint . '/images', $body);

            // Пиксель для проверки открытия письма
            $body .= Html::img("{$apiEndpoint}/mailing/pixel/open/{$this->logId}.png", [
                'style' => 'positions: absolute; left: -99999px;bottom:-99999px; width:0px; height: 0px;'
            ]);

            // Подмена данных в шаблоне из переданных переменных
            foreach ((array)$this->data as $key => $value) {
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
        } catch (\Throwable $e) {
            $message = '[Отправитель]: ' . print_r($sender, true);
            $message .= '<br>' . $e->getMessage();

            $message .= '<br>' . $e->getTraceAsString();

            $log->setError($message);

            throw new $e;
        }
    }
}
