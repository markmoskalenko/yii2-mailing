<?php

namespace markmoskalenko\mailing\common\models\templateTelegram;

use MongoDB\BSON\ObjectId;
use yii\mongodb\ActiveQuery;

/**
 * Class TemplateTelegramQuery
 */
class TemplateTelegramQuery extends ActiveQuery
{
    /**
     * @param $lang
     * @return TemplateTelegramQuery
     */
    public function byLang($lang)
    {
        return $this->andWhere([TemplateTelegram::ATTR_LANG => $lang]);
    }

    /**
     * @param $id
     * @return TemplateTelegramQuery
     */
    public function byTemplateId($id)
    {
        return $this->andWhere([TemplateTelegram::ATTR_TEMPLATE_ID => new ObjectId($id)]);
    }

    /**
     * @param string $domain
     * @return TemplateTelegramQuery
     */
    public function byAffiliateDomain($domain)
    {
        return $this->andWhere([TemplateTelegram::ATTR_AFFILIATE_DOMAIN => (string)$domain]);
    }
}
