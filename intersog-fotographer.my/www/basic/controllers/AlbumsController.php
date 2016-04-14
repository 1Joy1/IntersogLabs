<?php

namespace app\controllers;

 
use app\controllers\CommonActiveController;
use yii\filters\AccessControl;
use app\models\Albums;


 
class AlbumsController extends CommonActiveController
{
    public $modelClass = 'app\models\Albums';
    
    public $searchAttr = 'AlbumsSearch';
    
    public $searchModel = '\app\models\AlbumsSearch';
    
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
                        $thisModelUserId = Albums::findOne(\Yii::$app->request->queryParams['id'])["users_id"];
                        
                        if (\Yii::$app->user->identity->role === 'admin' || 
                            \Yii::$app->user->identity->id === $thisModelUserId) {
                            return true;
                        }
                    }
                ],
                
                [
                    'actions' => ['create'],
                    'allow' => true,
                     // Allow admin to create
                    'roles' => ['admin', 'photographer'],
                ],
                
                [
                    'actions' => ['update'],
                    'allow' => true,
                    // Allow client, photographer and admin to view
                    'roles' => ['admin', 'photographer'],
                    // Admin full allow, photographer some allow.
                    'matchCallback' => function ($rule, $action)
                    {
                        $thisModelUserId = Albums::findOne(\Yii::$app->request->queryParams['id'])["users_id"];
                        
                        if (\Yii::$app->user->identity->role === 'admin' || 
                            \Yii::$app->user->identity->id === $thisModelUserId) {
                            return true;
                        }
                    }
                ],
                
                [
                    'actions' => ['delete'],
                    'allow' => true,
                    // Allow admins to delete
                    'roles' => ['admin', 'photographer'],
                    // Admin full allow, photographer some allow.
                    'matchCallback' => function ($rule, $action)
                    {
                        $thisModelUserId = Albums::findOne(\Yii::$app->request->queryParams['id'])["users_id"];
                        
                        if (\Yii::$app->user->identity->role === 'admin' || 
                            \Yii::$app->user->identity->id === $thisModelUserId) {
                            return true;
                        }
                    }
                ],
            ],
        ];
        return $behaviors;
    }
   /* public function checkAccess($action, $model = null, $params = [])
    {
        var_dump($model->attributes["users_id"]);
        echo "\n\r";
        var_dump($action);
        echo "\n\r";
        var_dump($params);
    }*/
}
