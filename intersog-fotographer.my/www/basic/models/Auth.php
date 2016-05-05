<?php

namespace app\models;

use Yii;
//use yii\base\ErrorException;

/**
 * This is the model class for table "auth".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $code
 * @property string $create_at
 * @property string $valid_time
 * @property integer $valid
 */
class Auth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth';
    }
    
    /* 
    public function fields()
    {
        $fields = parent::fields();

        // удаляем не безопасные поля
        unset($fields['user_id']);
        unset($fields['code']);
        unset($fields['create_at']);
        unset($fields['valid_time']);        
        unset($fields['used']);
        
    return $fields;
    }
    */
    
    
    /**
    * @inheritdoc
    */
    public function generateResetCode($user)
    {
        $this->user_id = $user['id'];
        $this->code = Yii::$app->security->generateRandomString() . md5($user['email'] . time());
        $this->create_at = time();
        $this->valid_time = time() + 1200;
        $this->used = 0;
        if ( $this->save()) {
            return $this;
        } else {
            return false;
        }
    }
    
    /**
     * @inheritdoc
     */
    public static function setCodeUsed($authCode)
    {
        $authCode->used = true;
        if ($authCode->update()) {
            return true;
        } else {
            return false;
        }
    }    
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'code', 'valid_time'], 'required'],
            [['user_id', 'used'], 'integer'],
            [['create_at', 'valid_time'], 'safe'],
            [['code'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'code' => 'Code',
            'create_at' => 'Create At',
            'valid_time' => 'Valid Time',
            'used' => 'Used',
        ];
    }
}
