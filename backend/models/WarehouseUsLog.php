<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%warehouse_us_log}}".
 *
 * @property integer $id
 * @property integer $warehouse_us_id
 * @property string $series
 * @property string $product_name
 * @property integer $number
 * @property integer $box_number
 * @property string $zh_remark
 * @property string $remark
 */
class WarehouseUsLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%warehouse_us_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warehouse_us_id', 'number', 'box_number'], 'integer'],
            [['zh_remark', 'remark'], 'string'],
            [['series'], 'string', 'max' => 80],
            [['product_name'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'warehouse_us_id' => 'Warehouse Us ID',
            'series' => 'Series',
            'product_name' => 'Product Name',
            'number' => 'Number',
            'box_number' => 'Box Number',
            'zh_remark' => 'Zh Remark',
            'remark' => 'Remark',
        ];
    }
}
