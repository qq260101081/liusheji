<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%files}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $username
 * @property string $path
 * @property string $category
 * @property integer $created_at
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%files}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category'], 'string'],
            [['created_at'], 'integer'],
            [['name'], 'string', 'max' => 105],
            [['username'], 'string', 'max' => 60],
            [['path'], 'string', 'max' => 100],
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
            'name' => 'Name',
            'username' => '添加人',
            'path' => 'Path',
            'category' => 'Category',
            'created_at' => 'Created At',
        ];
    }
}
