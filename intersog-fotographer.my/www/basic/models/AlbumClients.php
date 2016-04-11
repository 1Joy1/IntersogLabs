<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "album_clients".
 *
 * @property string $id
 * @property string $albums_id
 * @property string $users_id
 * @property string $access
 * @property string $created_at
 *
 * @property Users $users
 * @property Albums $albums
 */
class AlbumClients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'album_clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['albums_id', 'users_id'], 'required'],
            [['albums_id', 'users_id'], 'integer'],
            [['access'], 'string'],
            [['created_at'], 'safe'],
            [['users_id'], 'unique'],
            [['users_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['users_id' => 'id']],
            [['albums_id'], 'exist', 'skipOnError' => true, 'targetClass' => Albums::className(), 'targetAttribute' => ['albums_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'albums_id' => 'Albums ID',
            'users_id' => 'Users ID',
            'access' => 'Access',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'users_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasOne(Albums::className(), ['id' => 'albums_id']);
    }
}
