<?php

namespace markmoskalenko\mailing\common\models\story;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 *
 */
class StorySearch extends Story
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
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
     * @return array|ActiveDataProvider
     */
    public function search()
    {
        $query = Story::find()
            ->orderBy(['_id' => SORT_DESC])
            ->owner()
            ->active();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);

        return $dataProvider;
    }
}
