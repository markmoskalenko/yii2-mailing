<?php

namespace markmoskalenko\mailing\common\models\templateEmail;

use markmoskalenko\mailing\common\models\ActiveRecord;
use markmoskalenko\mailing\common\models\template\Template;
use MongoDB\BSON\ObjectId;
use rise\mongoObjectBehavior\MongoObjectIdBehavior;

/**
 * Шаблоны email
 *
 * @property ObjectId $_id
 * @property string   $id
 * @property ObjectId $templateId
 * @property string   $lang
 * @property string   $subject
 * @property string   $body
 * @property string   $affiliateDomain
 *
 * @property Template $template
 */
class TemplateEmail extends ActiveRecord
{
    use TemplateEmailRelations;
    use TemplateEmailFinder;
    use TemplateEmailFormatter;

    const ATTR_MONGO_ID         = '_id';
    const ATTR_ID               = 'id';
    const ATTR_TEMPLATE_ID      = 'templateId';
    const ATTR_LANG             = 'lang';
    const ATTR_SUBJECT          = 'subject';
    const ATTR_BODY             = 'body';
    const ATTR_AFFILIATE_DOMAIN = 'affiliateDomain';

    public static $languages = ['en', 'ru'];
    public static $languagesName = ['en' => 'Английский', 'ru' => 'Русский'];

    /**
     * @return TemplateEmailQuery
     */
    public static function find()
    {
        return new TemplateEmailQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'templateEmail';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            static::ATTR_MONGO_ID,
            static::ATTR_TEMPLATE_ID,
            static::ATTR_LANG,
            static::ATTR_SUBJECT,
            static::ATTR_BODY,
            static::ATTR_AFFILIATE_DOMAIN,
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            static::ATTR_MONGO_ID         => 'ID',
            static::ATTR_TEMPLATE_ID      => 'Шаблон',
            static::ATTR_LANG             => 'Язык',
            static::ATTR_SUBJECT          => 'Тема письма',
            static::ATTR_BODY             => 'Письмо',
            static::ATTR_AFFILIATE_DOMAIN => 'Партнерский домен',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [static::ATTR_LANG, 'required'],
            [static::ATTR_LANG, 'in', 'range' => static::$languages],
            //
            [static::ATTR_SUBJECT, 'required'],
            [static::ATTR_SUBJECT, 'string'],
            //
            [static::ATTR_BODY, 'required'],
            [static::ATTR_BODY, 'string'],
            //
            [static::ATTR_TEMPLATE_ID, 'required'],
            //
            [static::ATTR_AFFILIATE_DOMAIN, 'default', 'value' => 'logtime.me'],
            [static::ATTR_AFFILIATE_DOMAIN, 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            '' => [
                'class'     => MongoObjectIdBehavior::class,
                'attribute' => [static::ATTR_TEMPLATE_ID]
            ]
        ];
    }
}
