<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property string $series
 * @property string $product
 * @property string $abbreviation
 * @property string $lamp
 * @property integer $lamp_number
 * @property string $ic
 * @property integer $ic_number
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lamp_number', 'ic_number'], 'integer'],
            [['series', 'lamp', 'ic'], 'string', 'max' => 30],
            [['product'], 'string', 'max' => 60],
            [['abbreviation'], 'string', 'max' => 20],
            [['product'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'series' => '系列',
            'product' => '产品名称',
            'abbreviation' => '简写',
            'lamp' => '灯珠',
            'lamp_number' => '灯珠数量',
            'ic' => 'Ic',
            'ic_number' => 'IC数量',
        ];
    }
}
