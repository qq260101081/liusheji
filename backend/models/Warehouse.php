<?php
/**
 * 国内仓库 Model
*/
namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%warehouse}}".
 *
 * @property integer $id
 * @property string $product_name
 * @property integer $number
 */
class Warehouse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%warehouse_zh}}';
    }
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number'], 'integer'],
            [['product_name'], 'string', 'max' => 120],
        	['product_name','unique'],
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
            'number' => '数量',
        ];
    }
}
