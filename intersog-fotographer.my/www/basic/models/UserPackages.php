<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_packages".
 *
 * @property string $id
 * @property string $packages_id
 * @property string $users_id
 * @property string $created_at
 *
 * @property Users $users
 * @property Packages $packages
 */
class UserPackages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_packages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['packages_id', 'users_id'], 'required'],
            [['packages_id', 'users_id'], 'integer'],
            [['created_at'], 'safe'],
            [['users_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['users_id' => 'id']],
            [['packages_id'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['packages_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'packages_id' => 'Packages ID',
            'users_id' => 'Users ID',
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
    public function getPackages()
    {
        return $this->hasOne(Packages::className(), ['id' => 'packages_id']);
    }
}
