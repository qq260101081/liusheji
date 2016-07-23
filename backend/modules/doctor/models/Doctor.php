<?php

namespace backend\modules\doctor\models;

use Yii;

/**
 * This is the model class for table "{{%doctor}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $logo
 * @property string $aptitude
 * @property string $goodat
 * @property string $create_time
 */
class Doctor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%doctor}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'logo', 'aptitude', 'goodat', 'create_time'], 'required'],
            [['create_time'], 'integer'],
            [['name'], 'string', 'max' => 12],
            [['logo'], 'string', 'max' => 120],
            [['aptitude', 'goodat'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'logo' => 'Logo',
            'aptitude' => '资质',
            'goodat' => '擅长',
            'create_time' => 'Create Time',
        ];
    }
}
