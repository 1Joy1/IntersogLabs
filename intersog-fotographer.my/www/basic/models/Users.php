<?php

namespace app\models;

use Yii;
use yii\web\ServerErrorHttpException;

/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property string $role
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $modified_at
 * @property string $created_at
 * @property string $access_token
 * @property integer $token_timelife 
 *
 * @property AlbumClients $albumClients
 * @property Albums[] $albums
 * @property Orders[] $orders
 * @property UserPackages[] $userPackages
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    
   /* 
    public function fields()
    {
        $fields = parent::fields();

        // удаляем не безопасные поля
        unset($fields['token_timelife']);
        unset($fields['access_token']);
        unset($fields['password']);

    return $fields;
    }
    */
    
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }
    
 
    /**
     * 
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) 
            {
                $this->setPassword($this->password);
            }
            if ($this->isAttributeChanged('password'))
            {
                $this->setPassword($this->password);   
            }
            return true;
        } else {
            return false;
        }   
    }
    
    
    /**
    * 
    */ 
    //public static function resetPassword($user, $newPassword)
    public function resetPassword($newPassword)
    {
        $this->password = $newPassword;
        if ($this->update()) {
            return true;
        } else {
            return false;
        }
    }
    
   
    /**
     * 
     */    
    /* Хелперы */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    
    
    
    /**
     * 
     */    
    public static function validateUser($email, $password)
    {
        $authUser = static::findOne(['email' => $email]);
        
        if ( $authUser && $password) {
            if ($authUser->validatePassword($password)) {
                if ($authUser->generateAccessToken()) {
                    return $authUser;
                }
            }
        }
        return false;        
    }

    
    /**
     * 
     */    
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    

    /**
     * 
     */
    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString();
        $this->token_timelife = time();
        
        if ( $this->update()) {
            return true;
        } else {
            //return false;
            throw new ServerErrorHttpException("Тут что то поломалось!!! Срочно бежим к админу с криками <Не могу залогиниться по токену>.");
        }
    }
    
    
    /**
     * 
     */    
    public static function resetToken($authUser)
    {
        //if ($authUser = static::findIdentityByAccessToken($token)) {
            $authUser->access_token = '';
            $authUser->token_timelife = 0;
        if ($authUser->update()) {
            return true;
        } else {
            //return false;
            throw new ServerErrorHttpException("Тут что то поломалось!!! Срочно бежим к админу с криками <Не сбрасывается токен>.");
        }
    }
    
    
    
    /**
     * 
     */    
    /* Реализуем IdentityInterface Аунтетификация пользователей */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        if ( $authUser = static::findOne(['access_token' => $token]) ) {
            if ( (time() - $authUser['token_timelife']) < 6000 ) {
                return $authUser;            
            } else {                
                static::resetToken($authUser);
            }
        } else {
            return false;
        }
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
            [['role', 'name', 'email', 'password'], 'required'],
            [['role'], 'string'],
            //[['modified_at', 'created_at'], 'safe'],
            [['name', 'email'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 60],            
            [['phone'], 'string', 'max' => 15],
            //[['access_token'], 'string', 'max' => 64],
            //[['token_timelife'], 'integer'],
            [['email'], 'unique'],
            [['email'], 'email'],
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
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Phone',
            'modified_at' => 'Modified At',
            'created_at' => 'Created At',
            'access_token' => 'Access Token',
            'token_timelife' => 'Token Timelife',
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
