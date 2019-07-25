<?php

namespace markmoskalenko\mailing\common\models\templateEmail;

/**
 *
 */
trait TemplateEmailFinder
{
    /**
     * @param string $templateId
     * @param string $lang
     * @param string $affiliateDomain
     * @return array|\yii\mongodb\ActiveRecord|TemplateEmail
     */
    public static function findByKeyAndLangAndAffiliateDomain($templateId, $lang, $affiliateDomain)
    {
        /** @var TemplateEmailQuery $query */
        $query = static::find();

        return $query
            ->byLang($lang)
            ->byTemplateId($templateId)
            ->byAffiliateDomain($affiliateDomain)
            ->one();
    }
}
