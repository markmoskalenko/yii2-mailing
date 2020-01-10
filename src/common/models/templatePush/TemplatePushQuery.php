<?php

namespace markmoskalenko\mailing\common\models\templatePush;

use MongoDB\BSON\ObjectId;
use yii\mongodb\ActiveQuery;

/**
 * Class TemplatePushQuery
 */
class TemplatePushQuery extends ActiveQuery
{
    /**
     * @param $lang
     * @return TemplatePushQuery
     */
    public function byLang($lang)
    {
        return $this->andWhere([TemplatePush::ATTR_LANG => $lang]);
    }

    /**
     * @param $id
     * @return TemplatePushQuery
     */
    public function byTemplateId($id)
    {
        return $this->andWhere([TemplatePush::ATTR_TEMPLATE_ID => new ObjectId($id)]);
    }
}
