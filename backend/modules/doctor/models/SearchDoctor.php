<?php

namespace backend\modules\doctor\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\doctor\models\Doctor;

/**
 * SearchDoctor represents the model behind the search form about `backend\modules\doctor\models\Doctor`.
 */
class SearchDoctor extends Doctor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_time'], 'integer'],
            [['name', 'logo', 'aptitude', 'goodat'], 'safe'],
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
        $query = Doctor::find();

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
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'aptitude', $this->aptitude])
            ->andFilterWhere(['like', 'goodat', $this->goodat]);

        return $dataProvider;
    }
}
