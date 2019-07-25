<?php

namespace markmoskalenko\mailing\common\models\addressBook;

use markmoskalenko\mailing\common\models\ActiveRecord;

/**
 * Шаблоны для писем
 *
 * @property string        _id
 */
class AddressBook extends ActiveRecord
{
    use AddressBookRelations;
    use AddressBookFinder;
    use AddressBookFormatter;

    const ATTR_ID       = 'id';
    const ATTR_MONGO_ID = '_id';


    /**
     * @return AddressBookQuery
     */
    public static function find()
    {
        return new AddressBookQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'addressBook';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            static::ATTR_MONGO_ID,
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            static::ATTR_MONGO_ID => 'ID',
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
        ];
    }
}
