<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ArticleCategory;

/**
 * ArticleCategorySearch represents the model behind the search form about `backend\models\ArticleCategory`.
 */
class ArticleCategorySearch extends ArticleCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'status', 'is_hot', 'sort_order', 'is_active', 'type'], 'integer'],
            [['name', 'label', 'slug', 'old_slugs', 'description', 'long_description', 'meta_title', 'meta_description', 'meta_keywords', 'h1', 'page_title', 'image', 'banner', 'image_path', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ArticleCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'is_hot' => $this->is_hot,
            'sort_order' => $this->sort_order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_active' => $this->is_active,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'old_slugs', $this->old_slugs])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'long_description', $this->long_description])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'meta_keywords', $this->meta_keywords])
            ->andFilterWhere(['like', 'h1', $this->h1])
            ->andFilterWhere(['like', 'page_title', $this->page_title])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'banner', $this->banner])
            ->andFilterWhere(['like', 'image_path', $this->image_path])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
