<?php

namespace markmoskalenko\mailing\common\models\templateStory;

use markmoskalenko\mailing\common\models\template\Template;

/**
 *
 */
trait TemplateStoryRelations
{
    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->hasOne(Template::class, [Template::ATTR_MONGO_ID => TemplateStory::ATTR_TEMPLATE_ID]);
    }
}
