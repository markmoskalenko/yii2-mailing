<?php

namespace markmoskalenko\mailing\common\models\template;

/**
 *
 */
trait TemplateFinder
{
    /**
     * @param $key
     * @return array|\yii\mongodb\ActiveRecord|Template
     */
    public static function findByKey($key)
    {
        /** @var TemplateQuery $query */
        $query = static::find();

        return $query->byKey($key)->one();
    }

    /**
     * @param $key
     * @return false|string|null
     */
    public static function getNameByKey($key)
    {
        /** @var TemplateQuery $query */
        $query = static::find();

        return $query->byKey($key)->select(['name'])->scalar();
    }
}
