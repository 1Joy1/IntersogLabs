<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Albums;

/**
 * SearchUsers represents the model behind the search form about `app\models\Albums`.
 */
class AlbumsSearch extends Albums
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['users_id', 'name', 'active', 'created_at', 'modified_at'], 'safe'],
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
        $query = Albums::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'modified_at' => $this->modified_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'users_id', $this->users_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'active', $this->active]);

        return $dataProvider;
    }
}