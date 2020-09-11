<?php

namespace markmoskalenko\mailing\common\helpers;


use markmoskalenko\mailing\common\interfaces\UserInterface;
use yii\helpers\ArrayHelper;

class LinksHelpers
{
    public static function getLinks(UserInterface $user, $referral, bool $ssl, $links, $ourDomain, $logId, $data = [])
    {

        // Домен на который будут перенаправлять все письма
        // Если нету партнера тогда ставим наш домен
        $sourceDomain = $referral ? $referral->affiliateDomain : $ourDomain;

        if ($sourceDomain == 'logtime.local' || $sourceDomain == 'dev.logtime.me') {
            $sourceDomain = 'logtime.me';
        }

        // Защищенный протокол или нет
        $scheme = $ssl ? 'https://' : 'http://';

        // Api хост
        $apiEndpoint = ArrayHelper::getValue($links, 'api');

        // Ссылка на приложение app.{host}.ru
        $webAppLink = ArrayHelper::getValue($links, 'webApp');

        // Заменяем плейсхолдер {host} на домен партнера или наш
        $webAppLink = $scheme . str_replace('{host}', $sourceDomain, $webAppLink);

        // Ссылка для отписки
        $unsubscribeLink = ArrayHelper::getValue($links, 'unsubscribe');
        $unsubscribeLink .= "?email={$user->getEmail()}";
        $unsubscribeLink = str_replace('{host}', $webAppLink, $unsubscribeLink);

        // Имя пользователя
        $firstName = $user->getFirstName();

        // Почта
        $email = $user->getEmail();

        $signUpAt = $user->getCreatedAt()->toDateTime()->format('d.m.Y');

        $expiredAt = $user->getExpiredAt()->toDateTime()->format('d.m.Y');
        $currentYear = date('Y');
        $pixelUrl = "{$apiEndpoint}/mailing/pixel/open/{$logId}.png";

        $authUrl = ArrayHelper::getValue($links, 'signIn');
        $authUrl = str_replace('{host}', $webAppLink, $authUrl);
        $authUrl .= "?token={$user->getAccessToken()}";


        $paymentLink = $authUrl . '&redirect=/payment';
        $affiliateLink = $authUrl . '&redirect=/affiliate/balance';
        $buttonLink = $authUrl . '&redirect=/calendar';

        // Подставляем домен в переданные переменные
        foreach ((array)$data as $key => $value) {
            $data[$key] = str_replace('{host}', $webAppLink, $value);
        }

        $baseData = [
            '{userId}' => (string)$user->getId(),
            '{webAppLink}' => $webAppLink,
            '{unsubscribeLink}' => $unsubscribeLink,
            '{firstName}' => $firstName,
            '{email}' => $email,
            '{signUpAt}' => $signUpAt,
            '{expiredAt}' => $expiredAt,
            '{currentYear}' => $currentYear,
            '{pixelUrl}' => $pixelUrl,
            '{paymentLink}' => $paymentLink,
            '{affiliateLink}' => $affiliateLink,
            '{buttonLink}' => $buttonLink,
            '{sourceDomain}' => $sourceDomain,
            '{apiEndpoint}' => $apiEndpoint,
        ];

        $data = array_merge($baseData, $data);

        return $data;
    }
}
