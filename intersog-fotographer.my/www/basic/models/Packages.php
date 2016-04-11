<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "packages".
 *
 * @property string $id
 * @property string $users_id
 * @property string $name
 * @property integer $price
 * @property integer $limitation
 * @property string $description
 * @property integer $active
 * @property string $created_at
 * @property string $modified_at
 *
 * @property UserPackages[] $userPackages
 */
class Packages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'packages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['users_id', 'name', 'price', 'limitation'], 'required'],
            [['users_id', 'price', 'limitation', 'active'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 500],
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
            'price' => 'Price',
            'limitation' => 'Limitation',
            'description' => 'Description',
            'active' => 'Active',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPackages()
    {
        return $this->hasMany(UserPackages::className(), ['packages_id' => 'id']);
    }
}
