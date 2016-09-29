<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
    	return [
    		'timestamp' => [
    			'class' => 'yii\behaviors\TimestampBehavior',
    			'attributes' => [
    				self::EVENT_BEFORE_UPDATE => ['updated_at'],
    				self::EVENT_BEFORE_INSERT => ['created_at'],
    			],
    		],
    	];
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key' => 'Auth Key',
            'password_hash' => '密码 Hash',
            'password_reset_token' => '重置密码 Token',
            'email' => '邮箱',
            'status' => '状态',
            'created_at' => '创建于',
            'updated_at' => '更新于',
        ];
    }
}
