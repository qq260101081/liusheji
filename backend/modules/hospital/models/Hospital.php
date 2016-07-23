<?php

namespace backend\modules\hospital\models;

use Yii;

/**
 * This is the model class for table "{{%hospital}}".
 *
 * @property integer $id
 * @property string $logo
 * @property string $photo
 * @property string $name
 * @property integer $nature
 * @property string $province
 * @property string $city
 * @property string $address
 * @property integer $auth
 * @property string $doctor_ids
 * @property string $content
 * @property string $created_at
 */
class Hospital extends \yii\db\ActiveRecord
{ 
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%hospital}}';
    }
    
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['created_at'],
                    //self::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    //self::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                //'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['logo', 'photo', 'name', 'province', 'city', 'address', 'doctor_ids'], 'required'],
            [['nature', 'auth', 'created_at'], 'integer'],
            [['content'], 'string'],
            [['logo', 'photo'], 'string', 'max' => 120],
            [['name'], 'string', 'max' => 90],
            [['province', 'city'], 'string', 'max' => 15],
            [['address'], 'string', 'max' => 150],
            [['doctor_ids'], 'string', 'max' => 500]
        ];
    }

    
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'logo' => 'Logo',
            'photo' => 'Photo',
            'name' => '医院名称',
            'nature' => '性质',
            'province' => '省份',
            'city' => '城市',
            'address' => '医院地址',
            'auth' => '医院认证',
            'doctor_ids' => '医生们',
            'content' => '介绍内容',
            'created_at' => '创建时间',
        ];
    }
}
