<?php

namespace app\controllers;

use yii\rest\Controller;
 
class RestController extends Controller {
 
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpBearerAuth::className();
        //$behaviors['authenticator']['only'] = ['index'];
        $behaviors['authenticator']['auth'] = function ($username, $password) {
            return \app\models\User::findOne([
                'username' => $username,
                'password' => $password,
            ]);
        return $behaviors;
    }
}