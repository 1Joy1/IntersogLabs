<?php

namespace app\controllers;


use app\controllers\CommonActiveController;
use yii\filters\AccessControl;


class UsersController extends CommonActiveController
{
    public $modelClass = 'app\models\Users';

    public $searchAttr = 'UsersSearch';
    
    public $searchModel = '\app\models\UsersSearch';
    
    public function isOwnerAccount()
    {
        if (\Yii::$app->user->identity->id === \Yii::$app->request->queryParams['id']) {
            return true;
        }            
    }
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();        
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'ruleConfig' => ['class' => AccessRules::className(),],
            'only' => ['index', 'view', 'create', 'update', 'delete'],
            'rules' => [
                [
                    'actions' => ['index'],
                    'allow' => true,
                     // Allow admin to index
                    'roles' => ['admin'],
                ],
                
                [
                    'actions' => ['view'],
                    'allow' => true,
                    // Allow client, photographer and admin to view
                    'roles' => ['admin', 'photographer', 'client'],
                    // Admin full allow, other some allow.
                    'matchCallback' => function ($rule, $action)
                    {
                        if ($this -> isAdmin() || $this -> isOwnerAccount()) {
                            return true;
                        }
                    }
                ],
                
                [
                    'actions' => ['create'],
                    'allow' => true,
                     // Allow admin to create
                    'roles' => ['admin'],
                ],
                
                [
                    'actions' => ['update'],
                    'allow' => true,
                    // Allow client, photographer and admin to view
                    'roles' => ['admin', 'photographer', 'client'],
                    // Admin full allow, other some allow.
                    'matchCallback' => function ($rule, $action)
                    {
                        if ($this -> isAdmin() || $this -> isOwnerAccount()) {
                            return true;
                        }
                    }
                ],
                
                [
                    'actions' => ['delete'],
                    'allow' => true,
                    // Allow admins to delete
                    'roles' => ['admin', 'photographer', 'client'],
                    // Admin full allow, other some allow.
                    'matchCallback' => function ($rule, $action)
                    {
                        if ($this -> isAdmin() || $this -> isOwnerAccount()) {
                            return true;
                        }
                    }
                ],
            ],
        ];
        return $behaviors;
    }
}
