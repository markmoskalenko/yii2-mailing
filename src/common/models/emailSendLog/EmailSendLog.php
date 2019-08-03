<?php

namespace markmoskalenko\mailing\common\models\emailSendLog;

use markmoskalenko\mailing\common\interfaces\UserInterface;
use markmoskalenko\mailing\common\models\ActiveRecord;
use markmoskalenko\mailing\common\models\template\Template;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;
use mongosoft\mongodb\MongoDateBehavior;

/**
 * Шаблоны для писем
 *
 * @property string      $_id
 * @property ObjectId    $userId
 * @property string      $email
 * @property string      $theme
 * @property UTCDateTime $createdAt
 * @property UTCDateTime $sendAt
 * @property UTCDateTime $openAt
 * @property boolean     $isSend
 * @property string      $error
 * @property string      $openIp
 * @property string      $templateKey
 * @property string      $logStep
 *
 * @property UserInterface $user
 * 
 * @mixin MongoDateBehavior
 */
class EmailSendLog extends ActiveRecord
{
    use EmailSendLogRelations;
    use EmailSendLogFinder;
    use EmailSendLogFormatter;

    const LOG_STEP_START = 'start';

    const ATTR_ID           = 'id';
    const ATTR_MONGO_ID     = '_id';
    const ATTR_THEME        = 'theme';
    const ATTR_USER_ID      = 'userId';
    const ATTR_EMAIL        = 'email';
    const ATTR_CREATED_AT   = 'createdAt';
    const ATTR_SEND_AT      = 'sendAt';
    const ATTR_OPEN_AT      = 'openAt';
    const ATTR_IS_SEND      = 'isSend';
    const ATTR_ERROR        = 'error';
    const ATTR_OPEN_IP      = 'openIp';
    const ATTR_TEMPLATE_KEY = 'templateKey';
    const ATTR_LOG_STEP     = 'logStep';

    /**
     * @return EmailSendLogQuery
     */
    public static function find()
    {
        return new EmailSendLogQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'emailSendLog';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            static::ATTR_MONGO_ID,
            static::ATTR_USER_ID,
            static::ATTR_EMAIL,
            static::ATTR_CREATED_AT,
            static::ATTR_SEND_AT,
            static::ATTR_OPEN_AT,
            static::ATTR_IS_SEND,
            static::ATTR_ERROR,
            static::ATTR_OPEN_IP,
            static::ATTR_TEMPLATE_KEY,
            static::ATTR_LOG_STEP,
            static::ATTR_THEME,
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            static::ATTR_MONGO_ID     => 'ID',
            static::ATTR_USER_ID      => 'Пользователь',
            static::ATTR_EMAIL        => 'Получатель',
            static::ATTR_CREATED_AT   => 'Дата старта',
            static::ATTR_SEND_AT      => 'Дата отправки',
            static::ATTR_OPEN_AT      => 'Дата открытия',
            static::ATTR_IS_SEND      => 'Отправлено ли',
            static::ATTR_ERROR        => 'Ошибка',
            static::ATTR_OPEN_IP      => 'IP пользователя',
            static::ATTR_TEMPLATE_KEY => 'Ключ шаблона',
            static::ATTR_LOG_STEP     => 'Шаг',
            static::ATTR_THEME        => 'Тема',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            static::ATTR_ID => static::ATTR_MONGO_ID,
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class'      => MongoDateBehavior::class,
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => [
                        static::ATTR_CREATED_AT,
                    ],
                    self::EVENT_BEFORE_UPDATE => [],
                ],
            ],
        ];
    }

    /**
     * Если произошла ошибка сохранения лога, пользователь не найден или отписан возвращаем false
     * Тем самым останавливаем продолжение работы отправки пользователю
     *
     * @param $email
     * @param $templateKey
     * @return bool
     */
    public static function start($email, $templateKey, $user)
    {
        $model = new self();
        $model->email = $email;
        $model->templateKey = $templateKey;
        $model->logStep = static::LOG_STEP_START;

        $template = Template::findByKey($templateKey);

        $model->error = "";
        $model->isSend = false;

        if (!$template) {
            $model->error = "Шаблон {$templateKey} для пользователя с почтой {$email} не найден";
            $model->theme = $templateKey;
            $model->save();

            return false;
        }

        $model->theme = $template->name;

        if (!$user) {
            $model->error = "Пользователь с почтой {$email} не найден";
            $model->save();

            return false;
        }
        
        $model->userId = $user->_id;

        if (!$model->save()) {
            return false;
        }

        return (string)$model->_id;
    }

    /**
     * Письмо отправлено в службу доставки
     */
    public function send()
    {
        $this->touch(static::ATTR_SEND_AT);
        $this->isSend = true;
        $this->save();
    }

    /**
     * Ошибка в процессе работы
     *
     * @param $message
     */
    public function setError($message)
    {
        $this->error .= date('Y-m-d H:i') . ': <br><code>' . $message . '</code><br>';
        $this->save();
    }

    /**
     * Пометка что письмо открыто
     *
     * @param $logId
     * @param $ip
     */
    public static function open($logId, $ip)
    {
        $log = EmailSendLog::findOne($logId);
        if ($log) {
            $log->touch(static::ATTR_OPEN_AT);
            $log->openIp = $ip;
            $log->save();
        }
    }
}
