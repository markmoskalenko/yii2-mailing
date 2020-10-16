<?php

namespace markmoskalenko\mailing\common\services;

use markmoskalenko\mailing\common\models\story\Story;
use markmoskalenko\mailing\common\models\templateStory\TemplateStory;
use MongoDB\BSON\ObjectId;
use yii\base\ErrorException;

/**
 * Class StoryService
 * @package markmoskalenko\mailing\common\services
 */
class StoryService
{
    /**
     * @param TemplateStory $templateStory
     * @param $userId
     * @return Story
     * @throws ErrorException
     */
    public function sendStroy(TemplateStory $templateStory, $userId, $channel = Story::CHANNEL_GLOBAL)
    {
        $story = new Story();
        $story->imageUrl = $templateStory->getImageUrl();
        $story->videoUrl = $templateStory->getVideoUrl();
        $story->youtubeId = $templateStory->youtubeId;
        $story->text = $templateStory->text;
        $story->buttonIsShow = $templateStory->buttonIsShow;
        $story->buttonText = $templateStory->buttonText;
        $story->buttonType = $templateStory->buttonType;
        $story->buttonCallback = $templateStory->buttonCallback;
        $story->isActive = true;
        $story->isWatched = false;
        $story->templateStoryId = $templateStory->_id;
        $story->userId = new ObjectId($userId);
        $story->templateGroupKey = $templateStory->template->key;
        $story->lottie = $templateStory->lottie;
        $story->templateId = $templateStory->templateId;
        $story->channel = $channel;
        $story->isRequiredWatch = $templateStory->isRequiredWatch;
        $story->apiCallback = $templateStory->apiCallback;

        if (!$story->save()) {
            throw new ErrorException('Ошибка создания сториса для пользователя: ' . var_export($story->getErrors(), true));
        }

        return $story;
    }
}
