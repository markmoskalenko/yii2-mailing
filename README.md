Yii2 Mailing extension
======================
Yii2 Mailing extension

Установка
------------------
* Установка пакета с помощью Composer.
В composer.json проекта добавить:
```
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/markmoskalenko/yii2-mailing/"
    }
]
```
Затем подключить:
```
composer require markmoskalenko/yii2-mailing:dev-master --prefer-source
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
