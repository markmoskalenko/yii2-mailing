<?php

namespace markmoskalenko\mailing\common\models\templatePush;

use yii\mongodb\ActiveRecord;

/**
 *
 */
trait TemplatePushFinder
{
    /**
     * @param string $templateId
     * @param string $lang
     * @return array|ActiveRecord|TemplatePush
     */
    public static function findByKeyAndLang($templateId, $lang)
    {
        /** @var TemplatePushQuery $query */
        $query = static::find();

        return $query
            ->byLang($lang)
            ->byTemplateId($templateId)
            ->one();
    }
}
