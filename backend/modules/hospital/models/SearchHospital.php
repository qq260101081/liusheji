<?php

namespace backend\modules\hospital\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\hospital\models\Hospital;

/**
 * SearchHospital represents the model behind the search form about `backend\module\hospital\models\Hospital`.
 */
class SearchHospital extends Hospital
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nature', 'auth', 'created_at'], 'integer'],
            [['logo', 'photo', 'name', 'province', 'city', 'address', 'doctor_ids', 'content'], 'safe'],
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
        $query = Hospital::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'nature' => $this->nature,
            'auth' => $this->auth,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'doctor_ids', $this->doctor_ids])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
