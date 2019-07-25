<?php

namespace markmoskalenko\mailing\common\jobs;

use markmoskalenko\mailing\common\models\user\User;
use markmoskalenko\mailing\common\models\emailSendLog\EmailSendLog;
use markmoskalenko\mailing\common\models\template\Template;
use markmoskalenko\mailing\common\models\templateEmail\TemplateEmail;
use MongoDB\BSON\ObjectId;
use Yii;
use yii\base\BaseObject;
use yii\base\ErrorException;
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

        $sender = ['hello@mybase.pro' => 'MyBase'];

        //        try {
        if (!$template) {
            throw new ErrorException('Шаблон не найден ' . $this->key);
        }

        $user = User::findOne(['email' => $this->email]);

        if (!$user) {
            throw new ErrorException('Пользователь не найден ' . $this->email);
        }

        $referral = $user->referralByAffiliateDomain;
        $sourceDomain = $referral ? $referral->affiliateDomain : User::OUR_DOMAIN;
        $templateEmail = TemplateEmail::findByKeyAndLangAndAffiliateDomain($template->_id, 'ru', $sourceDomain);

        if (!$templateEmail) {
            throw new ErrorException('Шаблон не найден ' . $this->key . ':' . $sourceDomain);
        }

        $webAppLink = Yii::$app->params['host.frontend'];
        $singInLink = Yii::$app->params['host.frontend.auth.signin'];
        $paymentLink = Yii::$app->params['host.frontend.payment'];
        $unsubscribeLink = Yii::$app->params['host.frontend.unsubscribe'];


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

            $webAppLink = str_replace(User::OUR_DOMAIN, $referral->affiliateDomain, $webAppLink);
            $singInLink = str_replace(User::OUR_DOMAIN, $referral->affiliateDomain, $singInLink);
            $paymentLink = str_replace(User::OUR_DOMAIN, $referral->affiliateDomain, $paymentLink);
            $unsubscribeLink = str_replace(User::OUR_DOMAIN, $referral->affiliateDomain, $unsubscribeLink);

            foreach ((array)$this->data as $key => $value) {
                $this->data[$key] = str_replace(User::OUR_DOMAIN, $referral->affiliateDomain, $value);
            }

        } else {
            $mailer = Yii::$app->mailer;
        }

        $apiEndpoint = Yii::$app->params['host.api'];
        $body = str_replace('{firstName}', $user->firstName, $templateEmail->body);
        $body = str_replace('{webAppLink}', $webAppLink, $body);
        $body = str_replace('{singInLink}', $singInLink, $body);
        $body = str_replace('{paymentLink}', $paymentLink, $body);
        $body = str_replace('{email}', $user->email, $body);
        $body = str_replace('{signUpAt}', $user->createdAt->toDateTime()->format('d.m.Y'), $body);
        $body = str_replace('{expiredAt}', $user->expiredAt->toDateTime()->format('d.m.Y'), $body);

        //@todo добавить токен отписки
        $body = str_replace('{unsubscribeLink}', $unsubscribeLink, $body);
        $body = str_replace('{currentYear}', date('Y'), $body);
        $body = str_replace('src="/images', 'src="' . $apiEndpoint . '/images', $body);

        $body .= Html::img("{$apiEndpoint}/mailing/pixel/open/{$this->logId}.png", [
            'style' => 'positions: absolute; left: -99999px;bottom:-99999px; width:0px; height: 0px;'
        ]);

        foreach ((array)$this->data as $key => $value) {
            $body = str_replace($key, $value, $body);
        }


        $isSend = $mailer
            ->compose('layouts/html', ['content' => $body])
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
