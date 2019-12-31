<?php

namespace markmoskalenko\mailing\common\models\template;

use markmoskalenko\mailing\common\models\ActiveRecord;
use markmoskalenko\mailing\common\models\templateEmail\TemplateEmail;
use MongoDB\BSON\ObjectId;

/**
 * Шаблоны для писем
 *
 * @property ObjectId        $_id
 * @property string          $name
 * @property integer         $priority
 * @property string          $key
 *
 * @property TemplateEmail[] $templateEmail
 */
class Template extends ActiveRecord
{
    use TemplateRelations;
    use TemplateFinder;
    use TemplateFormatter;

    const ATTR_ID       = 'id';
    const ATTR_MONGO_ID = '_id';
    const ATTR_NAME     = 'name';
    const ATTR_PRIORITY = 'priority';
    const ATTR_KEY      = 'key';


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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            static::ATTR_MONGO_ID => 'ID',
            static::ATTR_NAME     => 'Название',
            static::ATTR_PRIORITY => 'Приоритет',
            static::ATTR_KEY      => 'Ключ',
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
    }
}
