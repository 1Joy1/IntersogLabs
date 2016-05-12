<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "albums".
 *
 * @property string $id
 * @property string $users_id
 * @property string $name
 * @property integer $active
 * @property string $created_at
 * @property string $modified_at
 *
 * @property AlbumClients[] $albumClients
 * @property AlbumImages[] $albumImages
 * @property Users $users
 */
class Albums extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'albums';
    }
    
    public function getCarrentUser()
    {
        return Yii::$app->user->identity;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['users_id', 'active'], 'integer'],            
            [['created_at', 'modified_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['users_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['users_id' => 'id']],
            [['users_id'], 'compare', 'compareValue' => $this -> getCarrentUser() -> id, 'operator' => '==', 
              'when' => function() 
              { 
                //return Yii::$app->user->identity->role != 'admin';
                return $this -> getCarrentUser() -> role != 'admin';
              }
            ],
            [['users_id'], 'default', 'value' => Yii::$app->user->identity->id],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'users_id' => 'Users ID',
            'name' => 'Name',
            'active' => 'Active',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbumClients()
    {
        return $this->hasMany(AlbumClients::className(), ['albums_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbumImages()
    {
        return $this->hasMany(AlbumImages::className(), ['albums_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'users_id']);
    }
}
