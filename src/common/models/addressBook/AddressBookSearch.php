<?php

namespace markmoskalenko\mailing\common\models\addressBook;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 *
 */
class AddressBookSearch extends AddressBook
{
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
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return array|ActiveDataProvider
     */
    public function search($params)
    {
        $query = AddressBook::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //            'sort'  => ['defaultOrder' => [AddressBook::ATTR_USER_LIMIT => SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return [];
        }

        return $dataProvider;
    }

    public function searchAdmin($params)
    {
        $query = AddressBook::find()->orderBy([AddressBook::ATTR_MONGO_ID => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return [];
        }

        return $dataProvider;
    }
}
