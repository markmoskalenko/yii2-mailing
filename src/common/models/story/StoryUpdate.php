<?php

namespace markmoskalenko\mailing\common\models\story;

class StoryUpdate extends Story
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //
            [static::ATTR_IS_WATCHED, 'boolean', 'trueValue' => true, 'falseValue' => false],
            [static::ATTR_IS_WATCHED, 'default', 'value' => false],
            [static::ATTR_IS_WATCHED, 'filter', 'filter' => 'boolval'],
        ];
    }
}
