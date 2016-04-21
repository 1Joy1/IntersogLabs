<?php

namespace app\controllers;


use yii\rest\ActiveController;
use yii\filters\AccessControl;


class AlbumImagesController extends ActiveController
{
    public $modelClass = 'app\models\AlbumImages';

    //public $searchAttr = 'UsersSearch';
    
    //public $searchModel = '\app\models\UsersSearch';
}