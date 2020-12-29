<?php

namespace markmoskalenko\mailing\common\models\templateTelegram;

use markmoskalenko\mailing\common\models\ActiveRecord;
use markmoskalenko\mailing\common\models\template\Template;
use MongoDB\BSON\ObjectId;
use rise\mongoObjectBehavior\MongoObjectIdBehavior;
use yii\web\UploadedFile;

/**
 * Шаблоны Telegram
 *
 * @property ObjectId $_id
 * @property string   $id
 * @property ObjectId $templateId
 * @property string   $lang
 * @property string   $subject
 * @property string   $body
 * @property string   $affiliateDomain
 * @property string   $picture
 * @property array    $keyboard
 * @property string   $videoUrl
 *
 * @property Template $template
 */
class TemplateTelegram extends ActiveRecord
{
    use TemplateTelegramRelations;
    use TemplateTelegramFinder;
    use TemplateTelegramFormatter;

    public $videoFile;

    const ATTR_MONGO_ID         = '_id';
    const ATTR_TEMPLATE_ID      = 'templateId';
    const ATTR_LANG             = 'lang';
    const ATTR_SUBJECT          = 'subject';
    const ATTR_BODY             = 'body';
    const ATTR_AFFILIATE_DOMAIN = 'affiliateDomain';
    const ATTR_PICTURE          = 'picture';
    const ATTR_KEYBOARD         = 'keyboard';
    const ATTR_VIDEO_URL        = 'videoUrl';
    const ATTR_VIDEO_FILE       = 'videoFile';

    public static $languages = ['en', 'ru'];
    public static $languagesName = ['en' => 'Английский', 'ru' => 'Русский'];

    /**
     * @return TemplateTelegramQuery
     */
    public static function find()
    {
        return new TemplateTelegramQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'templateTelegram';
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
            static::ATTR_SUBJECT,
            static::ATTR_BODY,
            static::ATTR_AFFILIATE_DOMAIN,
            static::ATTR_PICTURE,
            static::ATTR_KEYBOARD,
            static::ATTR_VIDEO_URL,
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
            static::ATTR_SUBJECT => 'Название письма для админки',
            static::ATTR_BODY => 'Текст сообщения',
            static::ATTR_AFFILIATE_DOMAIN => 'Партнерский домен',
            static::ATTR_PICTURE => 'Картинка',
            static::ATTR_KEYBOARD => 'Клавиатура (массив)',
            static::ATTR_VIDEO_FILE => 'Видео',
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
            [static::ATTR_SUBJECT, 'required'],
            [static::ATTR_SUBJECT, 'string'],
            //
            [static::ATTR_BODY, 'required'],
            [static::ATTR_BODY, 'string'],
            //
            [static::ATTR_TEMPLATE_ID, 'required'],
            //
            [static::ATTR_AFFILIATE_DOMAIN, 'string'],
            [static::ATTR_AFFILIATE_DOMAIN, 'default', 'value' => 'logtime.me'],
            //
            [static::ATTR_PICTURE, 'string'],
            //
            [static::ATTR_KEYBOARD, 'safe'],
            //
            [static::ATTR_VIDEO_FILE, 'file'],
            //
            [static::ATTR_VIDEO_URL, 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            '' => [
                'class' => MongoObjectIdBehavior::class,
                'attribute' => [static::ATTR_TEMPLATE_ID]
            ]
        ];
    }

    public function getVideoCdnUrl(){
        if (!$this->videoUrl) {
            return null;
        }

        $params = \Yii::$app->params;
        $id = md5($this->videoUrl);
        $cloudfront = $params['s3.cloudfront.marketing.domain'];
        $url = $cloudfront . '/' . $this->videoUrl;

        return $url;
    }

    /**
     * @inheritDoc
     */
    public function beforeValidate()
    {
        $this->videoFile = UploadedFile::getInstance($this, self::ATTR_VIDEO_FILE);

        if ($this->videoFile) {
            /** @var \frostealth\yii2\aws\s3\Service $s3 */
            $s3 = \Yii::$app->get('s3');
            $uid = md5(uniqid(time(), true)) . '.' . $this->videoFile->getExtension();
            $s3
                ->commands()
                ->upload($uid, $this->videoFile->tempName)
                ->withContentType($this->videoFile->type)
                ->inBucket('logtime-marketing')
                ->withAcl('public-read')
                ->withParam('CacheControl', 'max-age=31536000, s-maxage=2592000')
                ->execute();

            $this->videoUrl = $uid;
        }

        return parent::beforeValidate();
    }
}
