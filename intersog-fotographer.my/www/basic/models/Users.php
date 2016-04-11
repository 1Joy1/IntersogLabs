<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property string $role
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $phone
 * @property string $modified_at
 * @property string $created_at
 * @property string $access_token
 *
 * @property AlbumClients $albumClients
 * @property Albums[] $albums
 * @property Orders[] $orders
 * @property UserPackages[] $userPackages
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const ROLE_CLIENT = 'client';
    const ROLE_PHOTOGRAPHER = 'photographer';
    const ROLE_ADMIN = 'admin';
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }


   /* public static function findOne($auth)
    {
        var_dump($_SERVER);
        var_dump($auth);
    }*/
    
    
    // Реализуем IdentityInterface
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
  
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role', 'name', 'username', 'password'], 'required'],
            [['role'], 'string'],
            [['modified_at', 'created_at'], 'safe'],
            [['name', 'username', 'password'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 15],
            [['access_token'], 'string', 'max' => 64], 
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Role',
            'name' => 'Name',
            'username' => 'Username',
            'password' => 'Password',
            'phone' => 'Phone',
            'modified_at' => 'Modified At',
            'created_at' => 'Created At',
            'access_token' => 'Access Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbumClients()
    {
        return $this->hasOne(AlbumClients::className(), ['users_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasMany(Albums::className(), ['users_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['users_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPackages()
    {
        return $this->hasMany(UserPackages::className(), ['users_id' => 'id']);
    }
}
