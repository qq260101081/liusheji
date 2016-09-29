<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%quality}}".
 *
 * @property integer $order_id
 * @property string $fiels
 * @property integer $number
 * @property integer $howmany
 * @property string $username
 * @property string $warehouse_username
 * @property string $remark
 * @property integer $created_at
 */
class Quality extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%quality}}';
    }

    public function getOrders()
    {
    	return $this->hasOne(Orders::className(), ['id'=>'order_id']);
    }
    
    /**
     * @inheritdoc
     */
    
    public function scenarios()
    {
    	return [
    			'create' => ['order_id', 'created_at'],
    			'update' => ['howmany', 'number', 'username', 'remark', 'fiels'],
    	];
    }
    
    public function rules()
    {
        return [
            [['order_id'], 'required','on'=>'create'],
        	[['number','howmany', 'username'], 'required','on'=>'update'],
            [['number', 'howmany', 'created_at'], 'integer','on'=>'update'],
            [['fiels', 'remark'], 'string', 'max' => 500,'on'=>'update'],
            [['username','warehouse_username'], 'string', 'max' => 30,'on'=>'update'],
        	['created_at','default','value'=>time()]
        	//['fiels', 'file', 'extensions' => ['png', 'jpg','jpeg', 'gif','pdf'], 'maxSize' => 1024*1024*1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => '外键订单ID',
            'fiels' => '附件',
            'number' => '实际数量',
            'howmany' => '分几次品检',
            'username' => '品质审核人',
        	'warehouse_username' => '仓库审核人',
            'remark' => '批注',
            'created_at' => '创建于',
        ];
    }
}
