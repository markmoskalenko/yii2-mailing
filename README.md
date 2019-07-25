Yii2 Mailing extension
======================
Yii2 Mailing extension

Установка
------------------
* Установка пакета с помощью Composer.
```
composer require markmoskalenko/yii2-mailing
```
* Выполнить миграцию для создания нужной таблицы в базе данных (консоль):
```
yii migrate --migrationPath=@markmoskalenko/yii2-mailing/console/migrations --interactive=0
