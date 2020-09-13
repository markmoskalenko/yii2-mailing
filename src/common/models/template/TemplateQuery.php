<?php

namespace markmoskalenko\mailing\common\models\template;

use yii\mongodb\ActiveQuery;

/**
 * Class TemplateQuery
 */
class TemplateQuery extends ActiveQuery
{
    /**
     * @param $id
     * @return TemplateQuery
     */
    public function byKey($id)
    {
        return $this->andWhere([Template::ATTR_KEY => $id]);
    }

    /**
     * @param $group
     * @return TemplateQuery
     */
    public function byGroup($group)
    {
        return $this->andWhere([Template::ATTR_GROUP => (int)$group]);
    }
}
