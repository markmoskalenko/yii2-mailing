<?php

namespace markmoskalenko\mailing\common\models\templatePush;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 *
 */
class TemplatePushSearch extends TemplatePush
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
        $query = TemplatePush::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return [];
        }

        return $dataProvider;
    }

    /**
     * @param $params
     * @return array|ActiveDataProvider
     */
    public function searchAdmin($params)
    {
        $query = TemplatePush::find()->orderBy([TemplatePush::ATTR_MONGO_ID => SORT_ASC]);

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
