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
    public function owner($id = false)
    {
        return $this->andWhere([Story::ATTR_USER_ID => $id ? new ObjectId($id) : Yii::$app->user->getId()]);
    }

    public function active()
    {
        return $this->andWhere([Story::ATTR_IS_ACTIVE => true]);
    }

    public function byId($id)
    {
        return $this->andWhere([Story::ATTR_MONGO_ID => new ObjectId($id)]);
    }
}
