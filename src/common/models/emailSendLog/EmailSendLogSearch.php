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
            [self::ATTR_EMAIL, 'safe'],
            [self::ATTR_TEMPLATE_KEY, 'safe'],
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
            'sort' => ['defaultOrder' => [static::ATTR_MONGO_ID => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return [];
        }

        return $dataProvider;
    }

    public function searchAdmin($params)
    {
        $query = EmailSendLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => [static::ATTR_MONGO_ID => SORT_DESC]]
        ]);

        $this->load($params, null);

        if (!$this->validate()) {
            return [];
        }

        $query->andFilterWhere(['like', self::ATTR_EMAIL, $this->email]);
        $query->andFilterWhere([self::ATTR_TEMPLATE_KEY => $this->templateKey]);

        return $dataProvider;
    }
}
