<?php

namespace markmoskalenko\mailing\common\models\template;

use markmoskalenko\mailing\common\models\templateEmail\TemplateEmail;
use markmoskalenko\mailing\common\models\templatePush\TemplatePush;
use markmoskalenko\mailing\common\models\templateTelegram\TemplateTelegram;

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

    /**
     * @return mixed
     */
    public function getTemplateTelegram()
    {
        return $this->hasMany(TemplateTelegram::class, [TemplateTelegram::ATTR_TEMPLATE_ID => Template::ATTR_MONGO_ID]);
    }

    /**
     * @return mixed
     */
    public function getTemplatePush()
    {
        return $this->hasMany(TemplatePush::class, [TemplatePush::ATTR_TEMPLATE_ID => Template::ATTR_MONGO_ID]);
    }
}
