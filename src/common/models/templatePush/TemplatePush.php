<?php

namespace markmoskalenko\mailing\common\models\templatePush;

use markmoskalenko\mailing\common\helpers\LanguageHelpers;
use markmoskalenko\mailing\common\models\ActiveRecord;
use markmoskalenko\mailing\common\models\template\Template;
use MongoDB\BSON\ObjectId;
use rise\mongoObjectBehavior\MongoObjectIdBehavior;

/**
 * Шаблоны Telegram
 *
 * @property ObjectId $_id
 * @property string $id
 * @property ObjectId $templateId
 * @property string $lang
 * @property string $title
 * @property string $body
 * @property string $action
 *
 * @property Template $template
 */
class TemplatePush extends ActiveRecord
{
    use TemplatePushRelations;
    use TemplatePushFinder;
    use TemplatePushFormatter;

    const ATTR_MONGO_ID = '_id';
    const ATTR_ID = 'id';
    const ATTR_TEMPLATE_ID = 'templateId';
    const ATTR_LANG = 'lang';
    const ATTR_TITLE = 'title';
    const ATTR_BODY = 'body';
    const ATTR_ACTION = 'action';

    /**
     * @return TemplatePushQuery
     */
    public static function find()
    {
        return new TemplatePushQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'templatePush';
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
            static::ATTR_TITLE,
            static::ATTR_BODY,
            static::ATTR_ACTION,
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            static::ATTR_MONGO_ID => 'ID',
            static::ATTR_TEMPLATE_ID => 'Шаблон',
            static::ATTR_LANG => 'Язык',
            static::ATTR_TITLE => 'Заголовок',
            static::ATTR_BODY => 'Текст сообщения',
            static::ATTR_ACTION => 'Событие при клике',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [static::ATTR_LANG, 'required'],
            [static::ATTR_LANG, 'in', 'range' => LanguageHelpers::$languages],
            //
            [static::ATTR_TITLE, 'required'],
            [static::ATTR_TITLE, 'string'],
            //
            [static::ATTR_BODY, 'required'],
            [static::ATTR_BODY, 'string'],
            //
            [static::ATTR_TEMPLATE_ID, 'required'],
            //
            [static::ATTR_ACTION, 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'mongoObjectIdBehavior' => [
                'class' => MongoObjectIdBehavior::class,
                'attribute' => [static::ATTR_TEMPLATE_ID]
            ]
        ];
    }
}
