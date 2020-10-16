<?php

namespace markmoskalenko\mailing\common\models\template;

use markmoskalenko\mailing\common\models\ActiveRecord;
use markmoskalenko\mailing\common\models\templateEmail\TemplateEmail;
use markmoskalenko\mailing\common\models\templatePush\TemplatePush;
use markmoskalenko\mailing\common\models\templateStory\TemplateStory;
use markmoskalenko\mailing\common\models\templateTelegram\TemplateTelegram;
use MongoDB\BSON\ObjectId;

/**
 * Шаблоны для писем
 *
 * @property ObjectId $_id
 * @property string $name
 * @property integer $priority
 * @property string $key
 * @property integer $group
 *
 * @property TemplateEmail[] $templateEmail
 * @property TemplatePush[] $templatePush
 * @property TemplateTelegram[] $templateTelegram
 * @property TemplateStory[] $templateStory
 */
class Template extends ActiveRecord
{
    use TemplateRelations;
    use TemplateFinder;
    use TemplateFormatter;

    const ATTR_ID = 'id';
    const ATTR_MONGO_ID = '_id';
    const ATTR_NAME = 'name';
    const ATTR_PRIORITY = 'priority';
    const ATTR_KEY = 'key';
    const ATTR_GROUP = 'group';

    const GROUP_QUESTION_OF_DAY = 100;
    const GROUP_STOCK = 101;
    const GROUP_AUTO_FUNNEL = 102;
    const GROUP_TRIGGER = 103;
    const GROUP_ONBOARDING = 104;
    const GROUP_VIDEO_OF_DAY = 105;

    const GROUP_NAME = [
        self::GROUP_TRIGGER => 'Триггерные сообщения',
        self::GROUP_QUESTION_OF_DAY => 'Вопросы дня',
        self::GROUP_STOCK => 'Акционные сообщения',
        self::GROUP_AUTO_FUNNEL => 'Автоворонка',
        self::GROUP_ONBOARDING => 'Онбординг',
        self::GROUP_VIDEO_OF_DAY => 'Видео дня',
    ];

    /**
     * @return TemplateQuery
     */
    public static function find()
    {
        return new TemplateQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'template';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            static::ATTR_MONGO_ID,
            static::ATTR_NAME,
            static::ATTR_PRIORITY,
            static::ATTR_KEY,
            static::ATTR_GROUP,
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            static::ATTR_MONGO_ID => 'ID',
            static::ATTR_NAME => 'Название',
            static::ATTR_PRIORITY => 'Приоритет',
            static::ATTR_KEY => 'Ключ',
            static::ATTR_GROUP => 'Группа',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [static::ATTR_NAME, 'required'],
            [static::ATTR_NAME, 'string'],
            //
            [static::ATTR_PRIORITY, 'required'],
            [static::ATTR_PRIORITY, 'integer'],
            //
            [static::ATTR_GROUP, 'required'],
            [static::ATTR_GROUP, 'integer'],
            [static::ATTR_GROUP, 'filter', 'filter' => 'intval'],
            [static::ATTR_GROUP, 'in', 'range' => array_keys(self::GROUP_NAME)],
            //
            [static::ATTR_KEY, 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * Копирование объекта
     */
    public function copy()
    {
        $newModel = new Template();
        $newModel->setAttributes($this->getAttributes());
        $newModel->name = $newModel->name . '(Копия)';
        $newModel->key = md5(time());
        $newModel->save();

        foreach ($this->templateEmail as $item) {
            $newModelTemplateEmail = new TemplateEmail();
            $newModelTemplateEmail->setAttributes($item->getAttributes());
            $newModelTemplateEmail->templateId = new ObjectId($newModel->_id);
            $newModelTemplateEmail->save();
        }

        foreach ($this->templatePush as $item) {
            $newModelTemplateEmail = new TemplatePush();
            $newModelTemplateEmail->setAttributes($item->getAttributes());
            $newModelTemplateEmail->templateId = new ObjectId($newModel->_id);
            $newModelTemplateEmail->save();
        }

        foreach ($this->templateTelegram as $item) {
            $newModelTemplateEmail = new TemplateTelegram();
            $newModelTemplateEmail->setAttributes($item->getAttributes());
            $newModelTemplateEmail->templateId = new ObjectId($newModel->_id);
            $newModelTemplateEmail->save();
        }

        foreach ($this->templateStory as $item) {
            $newModelTemplateEmail = new TemplateStory();
            $newModelTemplateEmail->setAttributes($item->getAttributes());
            $newModelTemplateEmail->templateId = new ObjectId($newModel->_id);
            $newModelTemplateEmail->save();
        }
    }
}
