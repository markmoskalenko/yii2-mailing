<?php

namespace markmoskalenko\mailing\common\models\story;

use MongoDB\BSON\ObjectId;
use Yii;
use yii\mongodb\ActiveQuery;

/**
 * Class StoryQuery
 */
class StoryQuery extends ActiveQuery
{
    /**
     * @param false $id
     * @return StoryQuery
     */
    public function owner($id = false)
    {
        return $this->andWhere([Story::ATTR_USER_ID => $id ? new ObjectId($id) : Yii::$app->user->getId()]);
    }

    /**
     * @return StoryQuery
     */
    public function active()
    {
        return $this->andWhere([Story::ATTR_IS_ACTIVE => true]);
    }

    /**
     * @return StoryQuery
     */
    public function globalChannel()
    {
        return $this->andWhere([Story::ATTR_CHANNEL => Story::CHANNEL_GLOBAL]);
    }

    /**
     * @param $id
     * @return StoryQuery
     */
    public function byId($id)
    {
        return $this->andWhere([Story::ATTR_MONGO_ID => new ObjectId($id)]);
    }
}
