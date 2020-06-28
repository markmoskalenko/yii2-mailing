<?php

namespace markmoskalenko\mailing\common\models\story;

use markmoskalenko\mailing\common\models\ActiveRecord;
use markmoskalenko\mailing\common\models\templateStory\TemplateStory;
use MongoDB\BSON\ObjectId;

/**
 * Истории
 *
 * @property ObjectId $_id
 * @property string   $id
 * @property string   $imageUrl
 * @property string   $youtubeId
 * @property string   $text
 * @property boolean  $buttonIsShow
 * @property string   $buttonText
 * @property string   $buttonType
 * @property string   $buttonCallback
 * @property boolean  $isActive
 * @property boolean  $isWatched
 * @property ObjectId $userId
 * @property ObjectId $templateStoryId
 *
 * @SWG\Definition(
 *     definition="Story",
 *     description="Объект сториса",
 *     type="object",
 *     @SWG\Property(property="id", type="string", description="ID сториса"),
 *     @SWG\Property(property="imageUrl", type="string", description="Url на картинку сториса"),
 *     @SWG\Property(property="youtubeId", type="string", description="ID youtube видео для проигрывания"),
 *     @SWG\Property(property="text", type="string", description="Некий текст который при клике на кнопку нужно вставить в поле заметки"),
 *     @SWG\Property(property="buttonIsShow", type="string", description="Показывать ли кнопку"),
 *     @SWG\Property(property="buttonText", type="string", description="Текс кнопки"),
 *     @SWG\Property(property="buttonType", type="string", description="Тип кнопки"),
 *     @SWG\Property(property="buttonCallback", type="string", description="Действие кнопки при клике"),
 *     @SWG\Property(property="isWatched", type="string", description="Просмотрен ли сторис"),
 * )
 */
class Story extends ActiveRecord
{
    use StoryFinder;

    const ATTR_ID                = 'id';
    const ATTR_MONGO_ID          = '_id';
    const ATTR_IMAGE_URL         = 'imageUrl';
    const ATTR_YOUTUBE_ID        = 'youtubeId';
    const ATTR_TEXT              = 'text';
    const ATTR_BUTTON_IS_SHOW    = 'buttonIsShow';
    const ATTR_BUTTON_TEXT       = 'buttonText';
    const ATTR_BUTTON_TYPE       = 'buttonType';
    const ATTR_BUTTON_CALLBACK   = 'buttonCallback';
    const ATTR_IS_ACTIVE         = 'isActive';
    const ATTR_IS_WATCHED        = 'isWatched';
    const ATTR_USER_ID           = 'userId';
    const ATTR_TEMPLATE_STORY_ID = 'templateStoryId';

    const BUTTON_STYLE_1 = 'style1';
    const BUTTON_STYLE_2 = 'style2';

    const CALLBACK_ACTION_SHOW_VIDEO                = 'showVideo';
    const CALLBACK_ACTION_CREATE_NOTE               = 'createNote';
    const CALLBACK_ACTION_CREATE_NOTE_AND_COPY_TEXT = 'createNoteAndCopyText';
    const CALLBACK_ACTION_CREATE_TASK               = 'createTask';
    const CALLBACK_ACTION_CREATE_TARGET             = 'createTarget';

    public static $callbackActionLabels = [
        self::CALLBACK_ACTION_SHOW_VIDEO => 'Показать видео',
        self::CALLBACK_ACTION_CREATE_NOTE => 'Открыть создание заметки',
        self::CALLBACK_ACTION_CREATE_NOTE_AND_COPY_TEXT => 'Открыть создание заметки и скопировать текст',
        self::CALLBACK_ACTION_CREATE_TASK => 'Открыть создание задачи',
        self::CALLBACK_ACTION_CREATE_TARGET => 'Открыть экран целей',
    ];

    public static $buttonStyleLabels = [
        self::BUTTON_STYLE_1 => 'Оранжевый',
        self::BUTTON_STYLE_2 => 'Синий',
    ];

    /**
     * @return StoryQuery
     */
    public static function find()
    {
        return new StoryQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'story';
    }


    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            static::ATTR_MONGO_ID,
            static::ATTR_YOUTUBE_ID,
            static::ATTR_TEXT,
            static::ATTR_BUTTON_IS_SHOW,
            static::ATTR_BUTTON_TEXT,
            static::ATTR_BUTTON_TYPE,
            static::ATTR_BUTTON_CALLBACK,
            static::ATTR_IMAGE_URL,
            static::ATTR_IS_ACTIVE,
            static::ATTR_IS_WATCHED,
            static::ATTR_USER_ID,
            static::ATTR_TEMPLATE_STORY_ID,
        ];
    }

    public function fields()
    {
        return [
            static::ATTR_ID => static::ATTR_MONGO_ID,
            static::ATTR_YOUTUBE_ID,
            static::ATTR_TEXT,
            static::ATTR_BUTTON_IS_SHOW,
            static::ATTR_BUTTON_TEXT,
            static::ATTR_BUTTON_TYPE,
            static::ATTR_BUTTON_CALLBACK,
            static::ATTR_IMAGE_URL,
            static::ATTR_IS_ACTIVE,
            static::ATTR_IS_WATCHED,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //
            [static::ATTR_TEMPLATE_STORY_ID, 'required'],
            //
            [static::ATTR_USER_ID, 'required'],
            //
            [static::ATTR_YOUTUBE_ID, 'string'],
            //
            [static::ATTR_TEXT, 'string'],
            //
            [static::ATTR_BUTTON_IS_SHOW, 'boolean', 'trueValue' => true, 'falseValue' => false],
            [static::ATTR_BUTTON_IS_SHOW, 'default', 'value' => false],
            [static::ATTR_BUTTON_IS_SHOW, 'filter', 'filter' => 'boolval'],
            //
            [static::ATTR_BUTTON_TEXT, 'string'],
            //
            [static::ATTR_BUTTON_TYPE, 'string'],
            //
            [static::ATTR_BUTTON_CALLBACK, 'string'],
            //
            [static::ATTR_IMAGE_URL, 'required'],
            [static::ATTR_IMAGE_URL, 'string'],
            //
            [static::ATTR_IS_ACTIVE, 'boolean', 'trueValue' => true, 'falseValue' => false],
            [static::ATTR_IS_ACTIVE, 'default', 'value' => false],
            [static::ATTR_IS_ACTIVE, 'filter', 'filter' => 'boolval'],
            //
            [static::ATTR_IS_WATCHED, 'boolean', 'trueValue' => true, 'falseValue' => false],
            [static::ATTR_IS_WATCHED, 'default', 'value' => false],
            [static::ATTR_IS_WATCHED, 'filter', 'filter' => 'boolval'],
        ];
    }

    public static function create(TemplateStory $templateStory, $userId)
    {
        $story = new Story();
        $story->imageUrl = $templateStory->getSignerImageUrl(true);
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

        return $story->save();
    }
}
