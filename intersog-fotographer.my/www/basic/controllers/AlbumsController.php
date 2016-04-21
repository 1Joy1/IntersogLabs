<?php

namespace app\controllers;

 
use app\controllers\CommonActiveController;
use yii\filters\AccessControl;
use app\models\Albums;
use yii\helpers\ArrayHelper;

 
class AlbumsController extends CommonActiveController
{
    public $modelClass = 'app\models\Albums';
    
    public $searchAttr = 'AlbumsSearch';
    
    public $searchModel = '\app\models\AlbumsSearch';
    
    public function isOwnerAlbum()
    {
        if (\Yii::$app->user->identity->id === Albums::findOne(\Yii::$app->request->queryParams['id'])["users_id"]) {
            return true;
        }            
    }
    
    public function actionImages()
    {
        $albums = Albums::findOne(\Yii::$app->request->queryParams['id']);
        $photos = $albums -> albumImages;
        return $photos;
    }
    
    public function actionAddImages()
    {
        $text = "РАБОТАЕТ";
        return $text;
    }
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();        
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'ruleConfig' => ['class' => AccessRules::className(),],
            'only' => ['index', 'view', 'create', 'update', 'delete', 'images', 'add-images'],
            'rules' => [
                [
                    'actions' => ['images', 'add-images'],
                    'allow' => true,
                     // Admin allow on full index & photographer where his is author
                     // The filter implementation is done in class AlbumsSearch
                    'roles' => ['admin', 'photographer'],
                    'matchCallback' => function ($rule, $action)
                    {   //if(!$this -> isAdmin() && isset(\Yii::$app->request->queryParams["users_id"])){
                        if ($this -> isAdmin() || $this -> isOwnerAlbum()) {
                            
                            return true;
                        }
                    }
                ],
                
                [
                    'actions' => ['index'],
                    'allow' => true,
                     // Admin allow on full index & photographer where his is author
                     // The filter implementation is done in class AlbumsSearch
                    'roles' => ['admin', 'photographer'],
                    'matchCallback' => function ($rule, $action)
                    {   //if(!$this -> isAdmin() && isset(\Yii::$app->request->queryParams["users_id"])){
                        if (isset(\Yii::$app->request->queryParams["users_id"])){
                            if (!$this -> isAdmin() && \Yii::$app->request->queryParams["users_id"] != \Yii::$app->user->identity->id){
                                return false;
                            }
                        }
                        return true;
                    }
                ],
                
                [
                    'actions' => ['view'],
                    'allow' => true,
                    // Allow photographer and admin to view
                    'roles' => ['admin', 'photographer', 'client'],
                    // Admin full allow, other some allow.
                    'matchCallback' => function ($rule, $action)
                    {
                        if ($this -> isAdmin() || $this -> isOwnerAlbum()) {
                            
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
                    // Allow photographer and admin to view
                    'roles' => ['admin', 'photographer'],
                    // Admin full allow, photographer some allow.
                    'matchCallback' => function ($rule, $action)
                    {
                        if ($this -> isAdmin() || $this -> isOwnerAlbum()) {
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
                        if ($this -> isAdmin() || $this -> isOwnerAlbum()) {
                            return true;
                        }
                    }
                ],
            ],
        ];
        return $behaviors;
    }
    
    
    /*
    public function indexDataProvider() 
    {
        if (!$this -> isAdmin()) {
            
        $model = new $this->modelClass;

        $modelAttr = $model->attributes;

        $search["users_id"] = \Yii::$app->user->identity->id;

        $searchByAttr[$this->searchAttr] = $search;
        
        $searchModel = new $this->searchModel;

        return $searchModel->search($searchByAttr); 
        } else {
            return parent::indexDataProvider();
        }
    }
    */

   /* public function checkAccess($action, $model = null, $params = [])
    {
        var_dump($model->attributes["users_id"]);
        echo "\n\r";
        var_dump($action);
        echo "\n\r";
        var_dump($params);
    }*/
}
