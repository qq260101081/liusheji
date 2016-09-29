<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Warehouse;

/**
 * WarehouseSearch represents the model behind the search form about `backend\models\Warehouse`.
 */
class WarehouseSearch extends Warehouse
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'update_at', 'number', 'issue_at', 'estimated_at', 'storage_at'], 'integer'],
            [['product_series', 'product_name', 'keyword', 'type', 'remark', 'zh_remark', 'supplier', 'code_content'], 'safe'],
            [['processing_price', 'unit_price'], 'number'],
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
        $query = Warehouse::find();

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
            'update_at' => $this->update_at,
            'number' => $this->number,
            'issue_at' => $this->issue_at,
            'estimated_at' => $this->estimated_at,
            'storage_at' => $this->storage_at,
            'processing_price' => $this->processing_price,
            'unit_price' => $this->unit_price,
        ]);

        $query->andFilterWhere(['like', 'product_series', $this->product_series])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'keyword', $this->keyword])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'zh_remark', $this->zh_remark])
            ->andFilterWhere(['like', 'supplier', $this->supplier])
            ->andFilterWhere(['like', 'code_content', $this->code_content]);

        return $dataProvider;
    }
}
