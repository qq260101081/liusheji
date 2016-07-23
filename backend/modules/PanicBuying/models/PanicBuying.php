<?php

namespace backend\module\PanicBuying\models;

use Yii;

/**
 * This is the model class for table "{{%panic_buying}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $thum_img
 * @property string $big_img
 * @property string $original_price
 * @property string $price
 * @property string $prepay_price
 * @property string $e_time
 * @property string $sel_num
 * @property string $spec
 * @property string $attr
 * @property string $typeid
 * @property string $hospital_id
 * @property string $hospital_name
 * @property string $content
 * @property string $create_time
 */
class PanicBuying extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%panic_buying}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'thum_img', 'big_img', 'original_price', 'price', 'prepay_price', 'e_time', 'sel_num', 'spec', 'attr', 'typeid', 'hospital_id', 'hospital_name', 'content', 'create_time'], 'required'],
            [['original_price', 'price', 'prepay_price', 'e_time', 'sel_num', 'typeid', 'hospital_id', 'create_time'], 'integer'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 120],
            [['thum_img', 'big_img'], 'string', 'max' => 100],
            [['spec'], 'string', 'max' => 250],
            [['attr'], 'string', 'max' => 255],
            [['hospital_name'], 'string', 'max' => 90]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '项目名称',
            'thum_img' => '缩略图',
            'big_img' => '产品图',
            'original_price' => '原价',
            'price' => '价格',
            'prepay_price' => '预付',
            'e_time' => '结束时间',
            'sel_num' => '已售',
            'spec' => '规格',
            'security' => '保障',
            'typeid' => '栏目ID',
            'hospital_id' => '医院ID',
            'hospital_name' => '医院名称',
            'content' => '内容',
            'create_time' => '创建时间',
        ];
    }
}
