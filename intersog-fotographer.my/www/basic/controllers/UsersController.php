<?php

namespace app\controllers;

use yii\rest\Controller;
use yii\rest\ActiveController;
use app\controllers\SearchActiveController;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
use app\controllers\AccessRule;
use app\models\Users;

class UsersController extends SearchActiveController
{
    public $modelClass = 'app\models\Users';

    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpBearerAuth::className();
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'ruleConfig' => ['class' => AccessRules::className(),],
            'only' => ['create', 'update', 'delete'],
            'rules' => [
                [
                    'actions' => ['create'],
                    'allow' => true,
                     // Allow client, photographer and admin to create
                    'roles' => [
                        Users::ROLE_CLIENT,
                        Users::ROLE_PHOTOGRAPHER,
                        Users::ROLE_ADMIN],
                ],
                
                [
                    'actions' => ['update'],
                    'allow' => true,
                    // Allow admin to update
                    'roles' => [
                        Users::ROLE_ADMIN,],
                ],
                
                [
                    'actions' => ['delete'],
                    'allow' => true,
                    // Allow admins to delete
                    'roles' => [
                    Users::ROLE_ADMIN ],
                ],
            ],
        ];
        //$behaviors['authenticator']['only'] = ['index'];
        /*$behaviors['authenticator']['auth'] = function ($username, $password) {
            return \app\models\Users::findOne([
                'username' => $username,
                'password' => $password,
            ]);
        };*/
        return $behaviors;
    }
    

}
