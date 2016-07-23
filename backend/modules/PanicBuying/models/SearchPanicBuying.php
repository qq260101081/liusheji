<?php

namespace backend\module\PanicBuying\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\module\PanicBuying\models\PanicBuying;

/**
 * SearchPanicBuying represents the model behind the search form about `backend\module\PanicBuying\models\PanicBuying`.
 */
class SearchPanicBuying extends PanicBuying
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'original_price', 'price', 'prepay_price', 'e_time', 'sel_num', 'typeid', 'hospital_id', 'create_time'], 'integer'],
            [['name', 'thum_img', 'big_img', 'spec', 'security', 'hospital_name', 'content'], 'safe'],
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
        $query = PanicBuying::find();

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
            'original_price' => $this->original_price,
            'price' => $this->price,
            'prepay_price' => $this->prepay_price,
            'e_time' => $this->e_time,
            'sel_num' => $this->sel_num,
            'typeid' => $this->typeid,
            'hospital_id' => $this->hospital_id,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'thum_img', $this->thum_img])
            ->andFilterWhere(['like', 'big_img', $this->big_img])
            ->andFilterWhere(['like', 'spec', $this->spec])
            ->andFilterWhere(['like', 'security', $this->security])
            ->andFilterWhere(['like', 'hospital_name', $this->hospital_name])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
