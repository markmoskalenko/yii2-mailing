<?php

namespace markmoskalenko\mailing\common\models\templateStory;

use frostealth\yii2\aws\s3\Service;
use markmoskalenko\mailing\common\models\ActiveRecord;
use markmoskalenko\mailing\common\models\template\Template;
use MongoDB\BSON\ObjectId;
use rise\mongoObjectBehavior\MongoObjectIdBehavior;
use Yii;
use yii\web\UploadedFile;

/**
 * Шаблоны Telegram
 *
 * @property ObjectId $_id
 * @property string   $id
 * @property ObjectId $templateId
 * @property string   $lang
 * @property string   $affiliateDomain
 * @property string   $picture
 * @property string   $youtubeId
 * @property string   $text
 * @property boolean  $buttonIsShow
 * @property string   $buttonText
 * @property string   $buttonType
 * @property string   $buttonCallback
 * @property string   $image
 * @property string   $subject
 *
 * @property Template $template
 */
class TemplateStory extends ActiveRecord
{
    use TemplateStoryRelations;
    use TemplateStoryFinder;
    use TemplateStoryFormatter;

    public $image;

    const ATTR_MONGO_ID         = '_id';
    const ATTR_TEMPLATE_ID      = 'templateId';
    const ATTR_LANG             = 'lang';
    const ATTR_AFFILIATE_DOMAIN = 'affiliateDomain';
    const ATTR_PICTURE          = 'picture';
    const ATTR_YOUTUBE_ID       = 'youtubeId';
    const ATTR_TEXT             = 'text';
    const ATTR_BUTTON_IS_SHOW   = 'buttonIsShow';
    const ATTR_BUTTON_TEXT      = 'buttonText';
    const ATTR_BUTTON_TYPE      = 'buttonType';
    const ATTR_BUTTON_CALLBACK  = 'buttonCallback';
    const ATTR_IMAGE            = 'image';
    const ATTR_SUBJECT          = 'subject';

    public static $languages = ['en', 'ru'];
    public static $languagesName = ['en' => 'Английский', 'ru' => 'Русский'];

    /**
     * @return TemplateStoryQuery
     */
    public static function find()
    {
        return new TemplateStoryQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'templateStory';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            static::ATTR_MONGO_ID,
            static::ATTR_TEMPLATE_ID,
            static::ATTR_LANG,
            static::ATTR_AFFILIATE_DOMAIN,
            static::ATTR_PICTURE,
            static::ATTR_YOUTUBE_ID,
            static::ATTR_TEXT,
            static::ATTR_BUTTON_IS_SHOW,
            static::ATTR_BUTTON_TEXT,
            static::ATTR_BUTTON_TYPE,
            static::ATTR_BUTTON_CALLBACK,
            static::ATTR_SUBJECT,
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            static::ATTR_MONGO_ID => 'ID',
            static::ATTR_TEMPLATE_ID => 'Шаблон',
            static::ATTR_LANG => 'Язык',
            static::ATTR_AFFILIATE_DOMAIN => 'Партнерский домен',
            static::ATTR_PICTURE => 'Картинка',
            static::ATTR_YOUTUBE_ID => 'ID видео',
            static::ATTR_TEXT => 'Вопрос для ответа',
            static::ATTR_BUTTON_IS_SHOW => 'Показывать ли кнопку',
            static::ATTR_BUTTON_TEXT => 'Текст кнопки',
            static::ATTR_BUTTON_TYPE => 'Тип кнопки',
            static::ATTR_BUTTON_CALLBACK => 'Событие при клике',
            static::ATTR_IMAGE => 'Картинка',
            static::ATTR_SUBJECT => 'Описание для админки',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [static::ATTR_LANG, 'required'],
            [static::ATTR_LANG, 'in', 'range' => static::$languages],
            //
            [static::ATTR_TEMPLATE_ID, 'required'],
            //
            [static::ATTR_AFFILIATE_DOMAIN, 'required'],
            [static::ATTR_AFFILIATE_DOMAIN, 'string'],
            //
            [static::ATTR_PICTURE, 'required'],
            [static::ATTR_PICTURE, 'string'],
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
            [static::ATTR_IMAGE, 'file'],
            //
            [static::ATTR_SUBJECT, 'required'],
            [static::ATTR_SUBJECT, 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'mongoObjectIdBehavior' => [
                'class' => MongoObjectIdBehavior::class,
                'attribute' => [static::ATTR_TEMPLATE_ID]
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    public function beforeValidate()
    {
        $this->image = UploadedFile::getInstance($this, self::ATTR_IMAGE);

        if ($this->image) {
            $s3 = Yii::$app->get('s3');
            $uid = md5(uniqid(time(), true)) . '.' . $this->image->getExtension();
            $s3
                ->commands()
                ->upload($uid, $this->image->tempName)
                ->withContentType($this->image->type)
                ->withParam('CacheControl', 'max-age=31536000, s-maxage=2592000')
                ->execute();

            $this->picture = $uid;
        }

        return parent::beforeValidate();
    }
}
