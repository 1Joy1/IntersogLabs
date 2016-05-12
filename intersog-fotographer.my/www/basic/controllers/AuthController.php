<?php

namespace app\controllers;

 
use yii\rest\Controller;
use yii\rest\ActiveController;

use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\BadRequestHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\web\TooManyRequestsHttpException;

use app\models\Users;

 
class AuthController extends ActiveController
{
    
    public $modelClass = 'app\models\Auth';
    
    
    /**
     * Заглушка для несуществующих действий
     */
    public function actionNotAllowed()
    {
        throw new MethodNotAllowedHttpException("This Method Not Allowed");
    }
    
    
    /**
     * Метод генерации кода сброса пароля и отправки мыла.
     */
    public function actionResetPass()
    {
        if (!$email = \Yii::$app->request->getbodyParam('email')) {
            throw new BadRequestHttpException('Required email address. Field email cannot be blank.', 400);
        }
        
        $validator = new \yii\validators\EmailValidator();
        
        if (!$validator->validate($email, $error)) {
            throw new BadRequestHttpException('Enter correct email address', 400);
        }
        
        if (!$user = \app\models\Users::findOne(['email' => $email])) {
            throw new NotFoundHttpException('This email not registered in system.', 404);
        }        
        
        if ($newAuthValidCode = \app\models\Auth::find()->where(['user_id' => $user['id'], 'used' => false])
                                                        ->andWhere(['>', 'valid_time', time()])
                                                        ->all()) {
           throw new TooManyRequestsHttpException('You can not reset the password so often.', 429);
        }
        
        $newAuth = new $this->modelClass;
        
        if ( !$generateResetCode = $newAuth->generateResetCode($user)) {
           throw new ServerErrorHttpException("Тут что то поломалось!!! Срочно бежим к админу с криками <Не генерируется ключ сброса пароля>.");
           
        }

        $realValidTime = \Yii::$app->formatter->asDatetime($generateResetCode['valid_time']) . ' GMT';
        
        if ( !$message = \Yii::$app->mailer->compose()
                                           ->setFrom('reset_password@intersog-fotographer.my')
                                           ->setTo($email)
                                           ->setSubject('Reset your password')
                                           ->setTextBody('Reset your password.' . PHP_EOL 
                                                       . 'For reset your password, use this code:' . PHP_EOL 
                                                       . $generateResetCode['code'] . PHP_EOL
                                                       . 'Valid to' . $realValidTime)
                                           ->send()) {
            throw new ServerErrorHttpException('Email not sending. Contact the administrator');
        }
          
        \Yii::$app->getResponse()->setStatusCode(201);
        
        return ['message'=>'Reset code, sending on your email',
                'email'=>$email,
                'valid_to'=> $realValidTime,];
               
    }
    
    
    
    
    /**
    * Метод сброса и смены пароля.
    * Вопросы, как правильно вызывать методы модели, через статик или создавая новый объект.
    */
    public function actionChangePass()
    {
        if (!$code = \Yii::$app->request->getbodyParam('reset_code')) {
            throw new BadRequestHttpException('Required reset code. Field code cannot be blank.', 400);
        }
        
        if (!$newPassword = \Yii::$app->request->getbodyParam('new_password')) {
            throw new BadRequestHttpException('Enter new password. Field new_password cannot be blank.', 400);
        }
        
         
        if (!$newAuth = \app\models\Auth::find()->where(['code' => $code, 'used' => false])
                                                   ->andWhere(['>', 'valid_time', time()])
                                                   ->one()) {
           throw new NotFoundHttpException('Reset code not valid', 404);
        }
        
        if (!$user = \app\models\Users::findOne(['id' => $newAuth['user_id']])) {
            throw new NotFoundHttpException('Reset code not valid because user not faund', 404);
        }        
        
        //Обратиться в модель Юзер и изменить там пародь 
        if ( !$resetPassword = $user -> resetPassword($newPassword)) {
        //if ( !$resetPassword = \app\models\Users::resetPassword($user, $newPassword)) {
           throw new ServerErrorHttpException("Тут что то поломалось!!! Срочно бежим к админу с криками <Не обновляется пароль>.");
           
        }
        
        //Обратиться в модель Auth и изменить там used на true 
        if ( !$setCodeUsed = $newAuth -> setCodeUsed()) {
           throw new ServerErrorHttpException("Тут что то поломалось!!! Срочно бежим к админу с криками <Не сбрасывается used>.");
           
        }
        
        //Сообщить что пароль поменян и выдать токен.           
        if (!$authUser = \app\models\Users::validateUser($user['email'], $newPassword)) {
            throw new ServerErrorHttpException("Тут что то поломалось!!! Срочно бежим к админу с криками <Не принимается новый пароль>.");
        } else {
            $authHeader = $authUser->access_token;
            $response = \Yii::$app->response;
            $response->getHeaders()->set('Autorization', 'Bearer '.$authHeader);
            \Yii::$app->getResponse()->setStatusCode(201);
            //return $authUser;
            return ['message'=>'Password changed.'];
        }
        
    }
    

    
    /**
    * Метод проверки валидности кода сброса.
    * 
    */
    public function actionCheckCode()
    {
        if (!$code = \Yii::$app->request->headers['resetCode']) {
            throw new NotFoundHttpException('Required reset code. Header resetCode cannot be blank.', 400);
        }
        
        $response = \Yii::$app->response;
        $response->getHeaders()->set('resetCode code', $code);
        
        if (!$newAuth = \app\models\Auth::find()->where(['code' => $code, 'used' => false])
                                                   ->andWhere(['>', 'valid_time', time()])
                                                   ->one()) {
           throw new NotFoundHttpException('Reset code not valid', 404);
        }
        
        $response->getHeaders()->set('resetCode used', $newAuth['used']);
        $response->getHeaders()->set('resetCode valid-time', $newAuth['valid_time'] - time());
        
        if (!$user = \app\models\Users::findOne(['id' => $newAuth['user_id']])) {
            throw new NotFoundHttpException('Reset code not valid because user not faund', 404);
        } 
        
    }
    
    
    /**
    * Переопределение метода OPTIONS.
    * 
    */
    public function actions() 
    {   
        $actions = parent::actions();
        
        $actions ['options-pass'] = [
            'class' => 'yii\rest\OptionsAction',
            'collectionOptions' => ['POST', 'PUT', 'HEAD', 'OPTIONS'],
            ];
        return $actions;
    }
}