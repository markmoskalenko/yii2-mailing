<?php

namespace markmoskalenko\mailing\common\models\emailSendLog;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 *
 */
class EmailSendLogSearch extends EmailSendLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'safe']
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
        $query = EmailSendLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => ['defaultOrder' => [static::ATTR_MONGO_ID => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return [];
        }

        return $dataProvider;
    }

    public function searchAdmin($params)
    {
        $query = EmailSendLog::find()->orderBy([EmailSendLog::ATTR_MONGO_ID => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, null);

        if (!$this->validate()) {
            return [];
        }

        $query->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
