<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resized_photos".
 *
 * @property string $id
 * @property string $size
 * @property string $image_id
 * @property string $src
 * @property string $status
 * @property string $comment
 *
 * @property AlbumImages $image
 */
class ResizedPhotos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resized_photos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id', 'status', 'comment'], 'required'],
            [['image_id'], 'integer'],
            [['status'], 'string'],
            [['size'], 'string', 'max' => 32],
            [['src'], 'string', 'max' => 256],
            [['comment'], 'string', 'max' => 512],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlbumImages::className(), 'targetAttribute' => ['image_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'size' => 'Size',
            'image_id' => 'Image ID',
            'src' => 'Src',
            'status' => 'Status',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(AlbumImages::className(), ['id' => 'image_id']);
    }
}
