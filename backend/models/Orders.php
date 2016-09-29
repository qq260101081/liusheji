<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property integer $id
 * @property string $product_type
 * @property integer $created_at
 * @property string $supplier
 * @property string $order_no
 * @property string $product_name
 * @property string $product_batch_no
 * @property integer $number
 * @property string $unit_price
 * @property string $processing_unit_price
 * @property string $total_price
 * @property string $lamp_batch_no
 * @property string $ic_batch_no
 * @property string $ic
 * @property string $lamp
 * @property string $remark
 * @property string $spec
 * @property string $is_apply
 * @property string $is_complete
 * @property string $product_abbreviation
 * 
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }
    
    public function getQuality()
    {
    	return $this->hasOne(Quality::className(), ['order_id'=>'id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_complete','is_apply'], 'string'],
            [['created_at', 'number', 'ic_number', 'lamp_number'], 'integer'],
            //[['unit_price', 'processing_unit_price', 'total_price'], 'required'],
            [['unit_price', 'processing_unit_price', 'total_price'], 'number'],
            [['supplier'], 'string', 'max' => 30],
            [['order_no', 'lamp_batch_no', 'ic_batch_no', 'username'], 'string', 'max' => 60],
            [['product_name', 'ic', 'lamp'], 'string', 'max' => 120],
            [['product_batch_no'], 'string', 'max' => 150],
        	[['remark'], 'string', 'max' => 500],
        	['created_at','default','value'=>time()],
        	[['ic_number','lamp_number'],'default','value'=>0]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_type' => '产品类型',
            'created_at' => '创建于',
            'supplier' => '供应商',
            'order_no' => '订单号',
            'product_name' => '产品名称',
            'product_batch_no' => '成品批次号',
            'number' => '产品数量',
            'unit_price' => '单价',
            'processing_unit_price' => '加工单价',
            'total_price' => '总价',
            'lamp_batch_no' => '灯珠批号',
            'ic_batch_no' => 'ic批号',
            'ic' => 'IC',
        	'ic_number' => 'IC数量',
        	'spec' => '规格',
            'lamp' => '灯珠',
        	'lamp_number' => '灯珠数量',
        	'remark' => '备注',
        	'is_apply' => '是否已申请入库或提醒',
        	'is_complete' => '已完成',
        ];
    }
}
