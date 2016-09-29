<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%shipment_reality}}".
 *
 * @property integer $shipment_id
 * @property string $product_name
 * @property integer $number
 * @property string $processing_price
 * @property string $total_price
 * @property string $freight_no
 * @property string $freight_factory_no
 * @property string $shipping_address
 * @property string $ship_type
 * @property string $ask_remark
 * @property string $reality_username
 * @property integer $created_at
 */
class ShipmentReality extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shipment_reality}}';
    }

    public function scenarios()
    {
    	return [
    			'create' => ['number', 'product_name', 'freight_no', 'shipping_address', 'ask_remark','ship_type', 'created_at'],
    			'update' => ['processing_price', 'total_price', 'freight_factory_no','reality_username'],
    	];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number'], 'integer'],
        	[['processing_price','total_price'], 'number' ,'on'=>'update'],
            [['ship_type'], 'string', 'on'=>'create'],
        	[['is_apply'], 'string'],
        	[['freight_no','freight_factory_no','reality_username'], 'string', 'on'=>'update'],
            [['product_name'], 'string', 'max' => 60, 'on'=>'create'],
            [['shipping_address'], 'string', 'max' => 150, 'on'=>'create'],
            [['ask_remark'], 'string', 'max' => 600, 'on'=>'create'],
        	['created_at','default','value'=>time(), 'on'=>'create']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shipment_id' => 'Shipment ID',
            'product_name' => '产品名称',
            'number' => '数量',
            'processing_price' => '加工价格',
            'total_price' => '总价',
            'freight_no' => '运单号',
            'freight_factory_no' => '工厂运单号',
            'shipping_address' => '配送地址',
            'ship_type' => '运输方式',
            'ask_remark' => '发货需求',
        	'reality_username' => '实际出货人',
            'created_at' => '创建于',
        ];
    }
}
