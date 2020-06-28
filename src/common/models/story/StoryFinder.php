<?php

namespace markmoskalenko\mailing\common\models\story;

/**
 *
 */
trait StoryFinder
{
    /**
     * @param $id
     * @return StoryUpdate|Story
     */
    public static function findOwner($id)
    {
        /** @var StoryQuery $query */
        $query = self::find();

        return $query
            ->byId($id)
            ->owner()
            ->one();
    }
}
