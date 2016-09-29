<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%shipment_arrangement}}".
 *
 * @property integer $id
 * @property string $product_name
 * @property integer $number
 * @property string $shipping_address
 * @property string $ship_type
 * @property string $is_apply
 * @property string $is_complete
 * @property string $ask_remark
 * @property integer $created_at
 */
class ShipmentArrangement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shipment_arrangement}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'created_at'], 'integer'],
            [['ship_type','is_apply','is_complete'], 'string'],
            [['product_name','freight_no'], 'string', 'max' => 60],
            [['shipping_address'], 'string', 'max' => 150],
            [['ask_remark'], 'string', 'max' => 600],
        	['created_at','default','value'=>time()]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_name' => '产品名称',
            'number' => '出货数量',
            'shipping_address' => '配送地址',
            'ship_type' => '运输方式',
            'ask_remark' => '发货需求',
        	'is_apply' => '是否已申请或提醒',
        	'is_complete' => '是否已完成',
            'created_at' => '创建于',
        ];
    }
}
