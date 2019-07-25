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
}
