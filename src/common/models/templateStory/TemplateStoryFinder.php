<?php

namespace markmoskalenko\mailing\common\models\templateStory;

/**
 *
 */
trait TemplateStoryFinder
{
    /**
     * @param string $templateId
     * @param string $lang
     * @param string $affiliateDomain
     * @return TemplateStory[]
     */
    public static function findAllByKeyAndLangAndAffiliateDomain($templateId, $lang, $affiliateDomain)
    {
        /** @var TemplateStoryQuery $query */
        $query = static::find();

        return $query
            ->byLang($lang)
            ->byTemplateId($templateId)
            ->byAffiliateDomain($affiliateDomain)
            ->orderBy(['_id' => SORT_ASC])
            ->all();
    }
}
