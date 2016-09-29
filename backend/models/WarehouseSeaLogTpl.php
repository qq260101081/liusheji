<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%warehouse_sea_log}}".
 *
 * @property integer $id
 * @property string $series
 * @property string $product_name
 * @property integer $number
 * @property integer $box_number
 * @property string $code_content
 * @property string $requirements
 * @property string $remark
 */
class WarehouseSeaLogTpl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%warehouse_sea_log_tpl}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'box_number'], 'integer'],
            [['requirements', 'remark'], 'string'],
            [['series'], 'string', 'max' => 80],
            [['product_name'], 'string', 'max' => 120],
            [['code_content'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'series' => 'Series',
            'product_name' => 'Product Name',
            'number' => 'Number',
            'box_number' => 'Box Number',
            'code_content' => 'Code Content',
            'requirements' => 'Requirements',
            'remark' => 'Remark',
        ];
    }
}
