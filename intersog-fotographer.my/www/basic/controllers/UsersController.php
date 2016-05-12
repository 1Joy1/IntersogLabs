<?php

namespace app\controllers;


use app\controllers\CommonActiveController;
use yii\filters\AccessControl;


class UsersController extends CommonActiveController
{
    public $modelClass = 'app\models\Users';

    public $searchAttr = 'UsersSearch';
    
    public $searchModel = 'app\models\UsersSearch';
    
    
    public function isOwnerAccount()
    {
        if (\Yii::$app->user->identity->id === \Yii::$app->request->queryParams['id']) {
            return true;
        }            
    }
    
    
    /**
 * @api {get} /users Request All Users
 * @apiName GetAllUsers
 * @apiGroup Users
 *
 * @apiDescription Returns the user's.
 * Administrator allow only
 *
 * @apiExample {http} Example usage:
 *     GET: http://localhost/users
 *
 * @apiSuccess {String[]} JSONobjects JSON objects The group of objects "users" in the format JSON.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *      {
 *      "id": "1",
 *      "role": "admin",
 *      "name": "Igor",
 *      "email": "admin@mymail.ru",
 *      "password": "00000",
 *      "phone": "0677015800",
 *      "modified_at": "2016-04-16 18:18:11",
 *      "created_at": "2016-04-08 18:52:14"
 *      },
 *      {
 *      "id": "2",
 *      "role": "client",
 *      "name": "Sergo",
 *      "email": "serg@mymail.ru",
 *      "password": "serg",
 *      "phone": null,
 *      "modified_at": "2016-04-13 21:24:01",
 *      "created_at": "2016-04-08 23:37:20"
 *      },
 *      {
 *        ..........
 *        ..........
 *        ..........
 *      },
 *      {
 *        ..........
 *        ..........
 *        ..........
 *      },
 *
 * @apiError Unauthorized The <code>401</code> of the User not authorized.
 * @apiError Forbidden The <code>403</code> You are not allowed to perform this action.
 * @apiError NotFound The <code>404</code> of the Users was not found.
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 401 Unauthorized
 *     {
 *      "name": "Unauthorized",
 *      "message": "You are requesting with an invalid credential.",
 *      "code": 0,
 *      "status": 401,
 *     }
 */
    public function actionIndex()
    {
        return parent::actionIndex();
    }
    
 /**
 * @api {get} /users/:id Request Users unique ID.
 * @apiName GetUsers
 * @apiGroup Users
 *
 * @apiDescription Returns the user's data unique ID.
 * Administrator gets all users data, other users role
 * gets only personal data.
 *
 * @apiParam {Number} id Users unique ID.
 *
 * @apiExample {http} Example usage:
 *     GET: http://localhost/users/3
 * @apiSuccess {String} JSONobjects Users object in the format JSON.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *      {
 *          "id": "3",
 *          "role": "photographer",
 *          "name": "Alex",
 *          "email": "alex@mymail.ru",
 *          "password": "Alex",
 *          "phone": null,
 *          "modified_at": "2016-04-12 22:10:33",
 *          "created_at": "2016-04-08 23:39:12"
 *      }
 *
 * @apiError Unauthorized The <code>401</code> of the User not authorized.
 * @apiError Forbidden The <code>403</code> You are not allowed to perform this action.
 * @apiError NotFound The <code>404</code> of the Users was not found.   
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 401 Unauthorized
 *     {
 *      "name": "Unauthorized",
 *      "message": "You are requesting with an invalid credential.",
 *      "code": 0,
 *      "status": 401,
 *     }
 */
    public function actionView()
    {
        return parent::actionView();
    }
    
 /**
 * @api {post} /users Create New Users.
 * @apiName CreateNewUsers
 * @apiGroup Users
 *
 * @apiDescription Create New Users.
 * Administrator only may create users.
 *
 * @apiParam {String} role User role.
 * @apiParam {String} name User name.
 * @apiParam {String} email User email.
 * @apiParam {String} password User password.
 *
 * @apiExample {http} Example usage:
 *     POST: http://localhost/users
 *
 * @apiParamExample {json} Request-Example:
 *            {
 *             "role" : "photographer",
 *             "name" : "Alex",
 *             "email" : "alexalex@mymail.ru",
 *             "password" : "12345alex"
 *            } 
 *
 * @apiSuccess (Success 201) {String} JSONobjects Users object in the format JSON.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 201 Created
 *            {
 *             "role": "photographer",
 *             "name": "Alex",
 *             "email": "alexalex@mymail.ru",
 *             "password": "12345alex",
 *             "id": "7"
 *            }
 *
 * @apiError Unauthorized The <code>401</code> of the User not authorized.
 * @apiError Forbidden The <code>403</code> You are not allowed to perform this action.
 * @apiError NotFound The <code>404</code> of the Users was not found.
 * @apiError NotFound The <code>422</code> Data validation Failed.    
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 401 Unauthorized
 *     {
 *      "name": "Unauthorized",
 *      "message": "You are requesting with an invalid credential.",
 *      "code": 0,
 *      "status": 401,
 *     }
 */
    public function actionCreate()
    {
        return parent::actionCreate();
    }
    
 
 /**
 * @api {delete} /users/:id Delete User unique ID.
 * @apiName DeleteUsers
 * @apiGroup Users
 *
 * @apiDescription Delete the user's unique ID.
 * Administrator delete all users, whereas 
 * photographers & client are accessible only their personal data.
 *
 * @apiParam {Number} id Users unique ID.
 *
 * @apiExample {http} Example usage:
 *     DELETE: http://localhost/users/2
 *
 * @apiSuccess (Success 204) {String} NoContent
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 204 No Content
 *
 * @apiError Unauthorized The <code>401</code> of the User not authorized.
 * @apiError Forbidden The <code>403</code> You are not allowed to perform this action.
 * @apiError NotFound The <code>404</code> of the Users was not found.   
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 401 Unauthorized
 *     {
 *      "name": "Unauthorized",
 *      "message": "You are requesting with an invalid credential.",
 *      "code": 0,
 *      "status": 401,
 *     }
 */
    public function actionDelete()
    {
        return parent::actionDelete();
    }
    
 /**
 * @api {put} /users/:id Update Users unique ID.
 * @apiName UpdateUsers
 * @apiGroup Users
 *
 * @apiDescription Update the user's unique ID.
 * Administrator update users all users data, whereas 
 * photographers & client are accessible only their personal data.
 *
 * @apiParam {Number} id Users unique ID.
 *
 * @apiExample {http} Example usage:
 *     PUT: http://localhost/users/3
 *
 * @apiParamExample {json} Request-Example:
 *            {
 *             "password" : "alex12345"
 *            } 
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *      {
 *          "id": "3",
 *          "role": "photographer",
 *          "name": "Alex",
 *          "email": "alex@mymail.ru",
 *          "password": "Alex",
 *          "phone": null,
 *          "modified_at": "2016-04-12 22:10:33",
 *          "created_at": "2016-04-08 23:39:12"
 *      }
 *
 * @apiError Unauthorized The <code>401</code> of the User not authorized.
 * @apiError Forbidden The <code>403</code> You are not allowed to perform this action.
 * @apiError NotFound The <code>404</code> of the Users was not found.
 * @apiError NotFound The <code>422</code> Data validation Failed.  
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 401 Unauthorized
 *     {
 *      "name": "Unauthorized",
 *      "message": "You are requesting with an invalid credential.",
 *      "code": 0,
 *      "status": 401,
 *     }
 */
    public function actionUpdate()
    {
        return parent::actionUpdate();
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
