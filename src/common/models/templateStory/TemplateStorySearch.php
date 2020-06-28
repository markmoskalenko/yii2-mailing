<?php

namespace markmoskalenko\mailing\common\models\templateStory;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 *
 */
class TemplateStorySearch extends TemplateStory
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
        $query = TemplateStory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //            'sort'  => ['defaultOrder' => [TemplateStory::ATTR_USER_LIMIT => SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return [];
        }

        return $dataProvider;
    }

    public function searchAdmin($params)
    {
        $query = TemplateStory::find()->orderBy([TemplateStory::ATTR_MONGO_ID => SORT_ASC]);

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
