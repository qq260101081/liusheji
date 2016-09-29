<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'number'], 'integer'],
            [['product_type', 'supplier', 'order_no', 'product_name', 'product_series', 'product_batch_no', 'lamp_batch_no', 'ic_batch_no', 'ic', 'lamp'], 'safe'],
            [['unit_price', 'processing_unit_price'], 'number'],
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
        $query = Orders::find();

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
            'created_at' => $this->created_at,
            'number' => $this->number,
            'unit_price' => $this->unit_price,
            'processing_unit_price' => $this->processing_unit_price,
        ]);

        $query->andFilterWhere(['like', 'product_type', $this->product_type])
            ->andFilterWhere(['like', 'supplier', $this->supplier])
            ->andFilterWhere(['like', 'order_no', $this->order_no])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'product_series', $this->product_series])
            ->andFilterWhere(['like', 'product_batch_no', $this->product_batch_no])
            ->andFilterWhere(['like', 'lamp_batch_no', $this->lamp_batch_no])
            ->andFilterWhere(['like', 'ic_batch_no', $this->ic_batch_no])
            ->andFilterWhere(['like', 'ic', $this->ic])
            ->andFilterWhere(['like', 'lamp', $this->lamp]);

        return $dataProvider;
    }
}
