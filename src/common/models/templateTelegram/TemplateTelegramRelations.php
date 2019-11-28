<?php

namespace markmoskalenko\mailing\common\models\templateTelegram;

use markmoskalenko\mailing\common\models\template\Template;

/**
 *
 */
trait TemplateTelegramRelations
{
    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->hasOne(Template::class, [Template::ATTR_MONGO_ID => TemplateTelegram::ATTR_TEMPLATE_ID]);
    }
}
