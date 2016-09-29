<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%menus}}".
 *
 * @property integer $id
 * @property integer $root
 * @property string $route
 * @property string $name
 */
class Menus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menus}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['root'], 'integer'],
            [['route'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'root' => 'Root',
            'route' => 'Route',
            'name' => 'Name',
        ];
    }
}
