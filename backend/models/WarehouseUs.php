<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%warehouse_us}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $created_at
 */
class WarehouseUs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%warehouse_us}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['name'], 'unique'],
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
            'created_at' => '创建时间',
        ];
    }
}
