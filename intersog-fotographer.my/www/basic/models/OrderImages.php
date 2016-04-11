<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_images".
 *
 * @property string $id
 * @property string $orders_id
 * @property string $album_images_id
 * @property string $type
 * @property string $created_at
 *
 * @property AlbumImages $albumImages
 * @property Orders $orders
 */
class OrderImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_id', 'album_images_id', 'type'], 'required'],
            [['orders_id', 'album_images_id'], 'integer'],
            [['type'], 'string'],
            [['created_at'], 'safe'],
            [['album_images_id'], 'unique'],
            [['album_images_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlbumImages::className(), 'targetAttribute' => ['album_images_id' => 'id']],
            [['orders_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['orders_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orders_id' => 'Orders ID',
            'album_images_id' => 'Album Images ID',
            'type' => 'Type',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbumImages()
    {
        return $this->hasOne(AlbumImages::className(), ['id' => 'album_images_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasOne(Orders::className(), ['id' => 'orders_id']);
    }
}
