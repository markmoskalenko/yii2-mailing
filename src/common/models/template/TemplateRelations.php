<?php

namespace markmoskalenko\mailing\common\models\template;

use markmoskalenko\mailing\common\models\templateEmail\TemplateEmail;

/**
 *
 */
trait TemplateRelations
{
    /**
     * @return mixed
     */
    public function getTemplateEmail()
    {
        return $this->hasMany(TemplateEmail::class, [TemplateEmail::ATTR_TEMPLATE_ID => Template::ATTR_MONGO_ID]);
    }
}
