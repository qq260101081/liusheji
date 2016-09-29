<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%orders_material}}".
 *
 * @property integer $id
 * @property string $type
 * @property string $supplier
 * @property string $order_no
 * @property integer $number
 * @property string $spec
 * @property string $unit_price
 * @property string $batch_no
 * @property string $name
 * @property string $remark
 * @property string $username
 * @property integer $created_at
 */
class OrdersMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%orders_material}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'string'],
            [['number', 'created_at'], 'integer'],
            [['unit_price'], 'number'],
            [['supplier'], 'string', 'max' => 30],
            [['order_no', 'batch_no', 'username'], 'string', 'max' => 60],
            [['spec'], 'string', 'max' => 150],
            [['name'], 'string', 'max' => 120],
            [['remark'], 'string', 'max' => 500],
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
            'type' => '原料类型',
            'supplier' => '供应商',
            'order_no' => '订单号',
            'number' => '数量',
            'spec' => '规格',
            'unit_price' => '单价',
            'batch_no' => '批号',
            'name' => '原料名称',
            'remark' => '备注',
            'username' => '下单人',
            'created_at' => '创建于',
        ];
    }
}
