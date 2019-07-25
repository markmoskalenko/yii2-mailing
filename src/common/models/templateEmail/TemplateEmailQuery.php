<?php

namespace markmoskalenko\mailing\common\models\templateEmail;

use MongoDB\BSON\ObjectId;
use yii\mongodb\ActiveQuery;

/**
 * Class TemplateEmailQuery
 */
class TemplateEmailQuery extends ActiveQuery
{
    /**
     * @param $lang
     * @return TemplateEmailQuery
     */
    public function byLang($lang)
    {
        return $this->andWhere([TemplateEmail::ATTR_LANG => $lang]);
    }

    /**
     * @param $id
     * @return TemplateEmailQuery
     */
    public function byTemplateId($id)
    {
        return $this->andWhere([TemplateEmail::ATTR_TEMPLATE_ID => new ObjectId($id)]);
    }

    /**
     * @param string $domain
     * @return TemplateEmailQuery
     */
    public function byAffiliateDomain($domain)
    {
        return $this->andWhere([TemplateEmail::ATTR_AFFILIATE_DOMAIN => (string)$domain]);
    }
}
