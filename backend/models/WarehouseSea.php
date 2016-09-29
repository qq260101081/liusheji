<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%warehouse_sea}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $send_date
 * @property integer $estimated_date
 * @property integer $created_at
 */
class WarehouseSea extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%warehouse_sea}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['send_date', 'estimated_date', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['name'], 'unique'],
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
            'name' => '名称',
            'send_date' => '发出时间',
            'estimated_date' => '预计到达时间',
            'created_at' => '添加时间',
        ];
    }
}
