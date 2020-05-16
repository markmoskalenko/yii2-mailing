<?php

namespace markmoskalenko\mailing\common\models\templateStory;

use MongoDB\BSON\ObjectId;
use yii\mongodb\ActiveQuery;

/**
 * Class TemplateStoryQuery
 */
class TemplateStoryQuery extends ActiveQuery
{
    /**
     * @param $lang
     * @return TemplateStoryQuery
     */
    public function byLang($lang)
    {
        return $this->andWhere([TemplateStory::ATTR_LANG => $lang]);
    }

    /**
     * @param $id
     * @return TemplateStoryQuery
     */
    public function byTemplateId($id)
    {
        return $this->andWhere([TemplateStory::ATTR_TEMPLATE_ID => new ObjectId($id)]);
    }

    /**
     * @param string $domain
     * @return TemplateStoryQuery
     */
    public function byAffiliateDomain($domain)
    {
        return $this->andWhere([TemplateStory::ATTR_AFFILIATE_DOMAIN => (string)$domain]);
    }
}
