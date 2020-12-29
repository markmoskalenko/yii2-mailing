<?php

namespace markmoskalenko\mailing\common\models\mailingTestEmail;

use markmoskalenko\mailing\common\models\ActiveRecord;

/**
 * Список адресатов для тестирования
 *
 * @property string _id
 * @property string email
 */
class MailingTestEmail extends ActiveRecord
{
    const ATTR_MONGO_ID = '_id';
    const ATTR_EMAIL = 'email';

    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'mailingTestEmail';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            static::ATTR_MONGO_ID,
            static::ATTR_EMAIL,
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            static::ATTR_MONGO_ID => 'ID',
            static::ATTR_EMAIL => 'Почта',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [static::ATTR_EMAIL, 'required'],
            [static::ATTR_EMAIL, 'email'],
        ];
    }

    /**
     * @return string
     */
    public static function getAllForView()
    {
        $emails = self::find()->select(['email'])->column();
        return implode(',', $emails);
    }
}
