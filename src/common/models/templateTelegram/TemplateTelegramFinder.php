<?php

namespace markmoskalenko\mailing\common\models\templateTelegram;

/**
 *
 */
trait TemplateTelegramFinder
{
    /**
     * @param string $templateId
     * @param string $lang
     * @param string $affiliateDomain
     * @return array|\yii\mongodb\ActiveRecord|TemplateTelegram
     */
    public static function findByKeyAndLangAndAffiliateDomain($templateId, $lang, $affiliateDomain)
    {
        /** @var TemplateTelegramQuery $query */
        $query = static::find();

        return $query
            ->byLang($lang)
            ->byTemplateId($templateId)
            ->byAffiliateDomain($affiliateDomain)
            ->one();
    }
}
