<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "album_images".
 *
 * @property string $id
 * @property string $albums_id
 * @property resource $image
 * @property string $created_at
 *
 * @property Albums $albums
 * @property OrderImages $orderImages
 */
class AlbumImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'album_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['albums_id', 'image'], 'required'],
            [['albums_id'], 'integer'],
            [['image'], 'string'],
            [['created_at'], 'safe'],
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
            'image' => 'Image',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasOne(Albums::className(), ['id' => 'albums_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderImages()
    {
        return $this->hasOne(OrderImages::className(), ['album_images_id' => 'id']);
    }
}
