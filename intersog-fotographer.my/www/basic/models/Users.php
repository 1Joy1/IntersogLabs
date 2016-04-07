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
 *
 * @property Albums[] $albums
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasMany(Albums::className(), ['user' => 'id']);
    }
}
