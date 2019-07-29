Yii2 Mailing extension
======================
Yii2 Mailing extension

Установка
------------------
* Установка пакета с помощью Composer.
```
composer require markmoskalenko/yii2-mailing
```

Использование
------------------
* Пример конфигурации
```
'modules'        => [
        'mailing' => [
            'class' => MailingModule::class,
            'senderEmail' => 'hello@mybase.pro',
            'senderName' => 'MyBase',
            'userClass'    => User::class,
            'links' => [
                'api' => 'http://api.mailing.loc',
                'webApp' => 'http://mailing.loc',
                'singIn' => 'http://mailing.loc/auth/sign-in',
                'payment' => 'http://mailing.loc/payment',
                'unsubscribe' => 'http://mailing.loc/auth/unsubscribe',
            ],
        ],
    ],
```
