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
     * Шаблон письма
     * 
     * @var string
     */
    public $layout = 'html';

    /**
     * @param \yii\queue\Queue $queue
     * @return bool
     * @throws ErrorException
     */
    public function execute($queue)
    {
        $template = Template::findByKey($this->key);

        $log = EmailSendLog::findOne($this->logId);

        if (!$log) {
            // в телеграм
            throw new ErrorException('Лог не найден');
        }

        $sender = [$this->senderEmail => $this->senderName];

        //        try {
        if (!$template) {
            throw new ErrorException('Шаблон не найден ' . $this->key);
        }

        if (!$this->user) {
            throw new ErrorException('Пользователь не найден ' . $this->email);
        }

        $referral = $this->user->referralByAffiliateDomain;

        $sourceDomain = $referral ? $referral->affiliateDomain : $this->ourDomain;
        $templateEmail = TemplateEmail::findByKeyAndLangAndAffiliateDomain($template->_id, 'ru', $sourceDomain);

        if (!$templateEmail) {
            throw new ErrorException('Шаблон не найден ' . $this->key . ':' . $sourceDomain);
        }

        $webAppLink = ArrayHelper::getValue($this->links, 'frontend');
        $singInLink = ArrayHelper::getValue($this->links, 'signin');
        $paymentLink = ArrayHelper::getValue($this->links, 'payment');
        $unsubscribeLink = ArrayHelper::getValue($this->links, 'unsubscribe');


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

            $webAppLink = str_replace($this->ourDomain, $referral->affiliateDomain, $webAppLink);
            $singInLink = str_replace($this->ourDomain, $referral->affiliateDomain, $singInLink);
            $paymentLink = str_replace($this->ourDomain, $referral->affiliateDomain, $paymentLink);
            $unsubscribeLink = str_replace($this->ourDomain, $referral->affiliateDomain, $unsubscribeLink);

            foreach ((array)$this->data as $key => $value) {
                $this->data[$key] = str_replace($this->ourDomain, $referral->affiliateDomain, $value);
            }

        } else {
            $mailer = Yii::$app->mailer;
        }

        $apiEndpoint = ArrayHelper::getValue($this->links, 'api');
        $body = str_replace('{firstName}', $this->user->firstName, $templateEmail->body);
        $body = str_replace('{webAppLink}', $webAppLink, $body);
        $body = str_replace('{singInLink}', $singInLink, $body);
        $body = str_replace('{paymentLink}', $paymentLink, $body);
        $body = str_replace('{email}', $this->user->email, $body);
        $body = str_replace('{signUpAt}', $this->user->createdAt->toDateTime()->format('d.m.Y'), $body);
        $body = str_replace('{expiredAt}', $this->user->expiredAt->toDateTime()->format('d.m.Y'), $body);

        //@todo добавить токен отписки
        $body = str_replace('{unsubscribeLink}', $unsubscribeLink, $body);
        $body = str_replace('{currentYear}', date('Y'), $body);
        $body = str_replace('src="/images', 'src="' . $apiEndpoint . '/images', $body);
        $body = str_replace('src=\'/images', 'src=\'' . $apiEndpoint . '/images', $body);
        $body = str_replace('url("/images', 'url("' . $apiEndpoint . '/images', $body);
        $body = str_replace('url(\'/images', 'url(\'' . $apiEndpoint . '/images', $body);

        $body .= Html::img("{$apiEndpoint}/mailing/pixel/open/{$this->logId}.png", [
            'style' => 'positions: absolute; left: -99999px;bottom:-99999px; width:0px; height: 0px;'
        ]);

        foreach ((array)$this->data as $key => $value) {
            $body = str_replace($key, $value, $body);
        }

        $isSend = $mailer
            ->compose('layouts/'.$this->layout, ['content' => $body])
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
        //            $log->setError($message);
        //
        //            throw new $e;
        //        }
    }
}
