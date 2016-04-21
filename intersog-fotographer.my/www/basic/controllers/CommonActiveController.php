<?php

namespace app\controllers;


use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;



 
class CommonActiveController extends ActiveController
{
    public $searchModel = Null;
    public $searchAttr = Null;
    
    
    public $reservedParams = ['sort','q'];
    
    public function isAdmin()
    {
        if (\Yii::$app->user->identity->role ==='admin') {
            return true;
        }
    }
    

    
    public function actions() 
    {
        $actions = parent::actions();
        // Переопределяем 'prepareDataProvider' из indexAction
        $actions['index']['prepareDataProvider'] = [$this, 'indexDataProvider'];
        return $actions;
    }

    public function indexDataProvider() 
    {
        $params = \Yii::$app->request->queryParams;

        $model = new $this->modelClass;
        // I'm using yii\base\Model::getAttributes() here
        // In a real app I'd rather properly assign 
        // $model->scenario then use $model->safeAttributes() instead
        $modelAttr = $model->attributes;

        // this will hold filtering attrs pairs ( 'name' => 'value' )
        $search = [];

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                // In case if you don't want to allow wired requests
                // holding 'objects', 'arrays' or 'resources'
                if(!is_scalar($key) or !is_scalar($value)) {
                    throw new BadRequestHttpException('Bad Request');
                }
                // if the attr name is not a reserved Keyword like 'q' or 'sort' and 
                // is matching one of models attributes then we need it to filter results
                if (!in_array(strtolower($key), $this->reservedParams) 
                    && ArrayHelper::keyExists($key, $modelAttr, false)) {
                    $search[$key] = $value;
                } else {throw new BadRequestHttpException('Bad Request');}
            }
        }

        // you may implement and return your 'ActiveDataProvider' instance here.
        // in my case I prefer using the built in Search Class generated by Gii which is already 
        // performing validation and using 'like' whenever the attr is expecting a 'string' value.
        $searchByAttr[$this->searchAttr] = $search;
        
        $searchModel = new $this->searchModel;
        // возвращаем отфильтрованные данные
        return $searchModel->search($searchByAttr);     
    }
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::className(),
                    'auth' => function ($username, $password) {
                        return \app\models\Users::findOne([
                            'username' => $username,
                            'password' => $password,
                        ]);
                    }
                ],
                [
                    'class' => HttpBearerAuth::className(),
                ]
            ],
        ];
        //$behaviors['authenticator']['only'] = ['index'];
        return $behaviors;
    }
    
}