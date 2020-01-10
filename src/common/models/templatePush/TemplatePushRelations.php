<?php

namespace markmoskalenko\mailing\common\models\templatePush;

use markmoskalenko\mailing\common\models\template\Template;

/**
 *
 */
trait TemplatePushRelations
{
    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->hasOne(Template::class, [Template::ATTR_MONGO_ID => TemplatePush::ATTR_TEMPLATE_ID]);
    }
}
