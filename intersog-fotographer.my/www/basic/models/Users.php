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
    
   /* public function fields()
    {
        $fields = parent::fields();

        // удаляем не безопасные поля
        unset($fields['auth_key']);
        unset($fields['access_token']);
        unset($fields['password']);

    return $fields;
    }*/
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }
    
    /* Хелперы */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    
    
    /* Реализуем IdentityInterface Аунтетификация пользователей */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Тут должны быть Правила валидации и проверки токена
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }
  /* Реализовали IdentityInterface Аунтетификация пользователей */
  
    
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
            [['auth_key'], 'string', 'max' => 64],
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
            'auth_key' => 'Auth Key',
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
