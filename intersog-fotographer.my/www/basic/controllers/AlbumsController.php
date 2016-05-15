<?php

namespace app\controllers;

 
use app\controllers\CommonActiveController;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

use app\models\Albums;
use app\models\AlbumClients;
use app\models\AlbumImages;
use app\models\UploadForm;

use yii\web\UploadedFile;

use yii\web\NotFoundHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;


 
class AlbumsController extends CommonActiveController
{

    public $modelClass = 'app\models\Albums';
    
    public $searchAttr = 'AlbumsSearch';
    
    public $searchModel = 'app\models\AlbumsSearch';
    
  

    public function isOwnerAlbum()
    {
        if (\Yii::$app->user->identity->id === Albums::findOne(\Yii::$app->request->queryParams['id'])["users_id"]) {
            return true;
        }
    }
    
    public function isAllowAlbum()
    {
        return AlbumClients::findOne(['albums_id' => \Yii::$app->request->queryParams['id'], 
                                      'users_id' => \Yii::$app->user->identity->id]);
    }


    
 /**
 * @api {get} /albums Request All Albums
 * @apiName GetAllAlbums
 * @apiGroup Album
 *
 * @apiDescription Returns the user's albums.
 * Administrator gets albums all users, whereas 
 * photographers are accessible only their personal albums.
 *
 * @apiExample {http} Example usage:
 *     GET: http://localhost/albums
 *
 * @apiSuccess {String[]} JSONobjects JSON objects The group of objects "albums" in the format JSON.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *      {
 *       "id": "1",
 *       "users_id": "3",
 *       "name": "Wedding",
 *       "active": 1,
 *       "created_at": "2016-04-08 18:56:02",
 *       "modified_at": "2016-04-14 13:16:40"
 *       },
 *       {
 *       "id": "7",
 *       "users_id": "3",
 *       "name": "New Year",
 *       "active": 1,
 *       "created_at": "2016-04-14 12:47:13",
 *       "modified_at": null
 *       },
 *       {
 *        ..........
 *        ..........
 *        ..........
 *       },
 *       {
 *        ..........
 *        ..........
 *        ..........
 *       },
 *
 * @apiError Unauthorized The <code>401</code> of the User not authorized.
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
 * @api {get} /albums/:id Request Album unique ID.
 * @apiName GetAlbum
 * @apiGroup Album
 *
 * @apiDescription Returns the user's album unique ID.
 * Administrator gets albums all users, whereas 
 * photographers are accessible only their personal albums.
 *
 * @apiParam {Number} id Albums unique ID.
 *
 * @apiExample {http} Example usage:
 *     GET: http://localhost/albums/2
 *
 * @apiSuccess {String} JSONobjects Album object in the format JSON.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *      {
 *       "id": "1",
 *       "users_id": "3",
 *       "name": "Wedding",
 *       "active": 1,
 *       "created_at": "2016-04-08 18:56:02",
 *       "modified_at": "2016-04-14 13:16:40"
 *       }
 *
 * @apiError Unauthorized The <code>401</code> of the User not authorized.
 * @apiError Forbidden The <code>403</code> You are not allowed to perform this action.
 * @apiError NotFound The <code>404</code> of the Album was not found.   
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
 * @api {post} /albums Create New Album.
 * @apiName CreateNewAlbum
 * @apiGroup Album
 *
 * @apiDescription Create New Album.
 * Administrator may create albums for all users, whereas 
 * photographers are accessible only their personal albums.
 *
 * @apiParam {String} name Album name.
 *
 * @apiExample {http} Example usage:
 *     POST: http://localhost/albums
 *
 * @apiParamExample {json} Request-Example:
 *            { "name" : "Wedding" } 
 *
 * @apiSuccess (Success 201) {String} JSONobjects Album object in the format JSON.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 201 Created
 *      {
 *      "name": "Wedding",
 *      "users_id": "3",
 *      "id": "13"
 *      }
 *
 * @apiError Unauthorized The <code>401</code> of the User not authorized.
 * @apiError Forbidden The <code>403</code> You are not allowed to perform this action.
 * @apiError NotFound The <code>404</code> of the Album was not found.
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
 * @api {delete} /albums/:id Delete Album unique ID.
 * @apiName DeleteAlbum
 * @apiGroup Album
 *
 * @apiDescription Delete the user's album unique ID.
 * Administrator delete albums all users, whereas 
 * photographers are accessible only their personal albums.
 *
 * @apiParam {Number} id Albums unique ID.
 *
 * @apiExample {http} Example usage:
 *     DELETE: http://localhost/albums/2
 *
 * @apiSuccess (Success 204) {String} NoContent
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 204 No Content
 *
 * @apiError Unauthorized The <code>401</code> of the User not authorized.
 * @apiError Forbidden The <code>403</code> You are not allowed to perform this action.
 * @apiError NotFound The <code>404</code> of the Album was not found.   
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
 * @api {put} /albums/:id Update Album unique ID.
 * @apiName UpdateAlbum
 * @apiGroup Album
 *
 * @apiDescription Update the user's album unique ID.
 * Administrator update albums all users, whereas 
 * photographers are accessible only their personal albums.
 *
 * @apiParam {Number} id Albums unique ID.
 *
 * @apiExample {http} Example usage:
 *     PUT: http://localhost/albums/2
 *
 * @apiParamExample {json} Request-Example:
 *            {
 *             "name" : "Wedding"
 *            }
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *      {
 *       "id": "2",
 *       "users_id": "3",
 *       "name": "Wedding",
 *       "active": 1,
 *       "created_at": "2016-04-08 18:56:02",
 *       "modified_at": "2016-04-14 13:16:40"
 *       } 
 *
 * @apiError Unauthorized The <code>401</code> of the User not authorized.
 * @apiError Forbidden The <code>403</code> You are not allowed to perform this action.
 * @apiError NotFound The <code>404</code> of the Album was not found.
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
    
    
 /**
 * @api {get} /albums/:id/images Request All Images of album.
 * @apiName GetAllImages
 * @apiGroup Images
 *
 * @apiDescription Returns the images of albums.
 * Administrator gets images all users, whereas 
 * photographers are accessible only their personal albums & images.
 *
 * @apiExample {http} Example usage:
 *     GET: http://localhost/albums/1/images
 *
 * @apiSuccess {String[]} JSONobjects JSON objects The group of objects "images" in the format JSON.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *      [
 *       {
 *         "id": "7",
 *         "albums_id": "1",
 *         "image": "http://tut_kakoito_URL_7",
 *         "created_at": "2016-04-21 08:35:02"
 *       },
 *       {
 *         "id": "8",
 *         "albums_id": "1",
 *         "image": "http://tut_kakoito_URL_8",
 *         "created_at": "2016-04-21 08:35:13"
 *       },
 *       {
 *         "id": "9",
 *         "albums_id": "1",
 *         "image": "http://tut_kakoito_URL_9",
 *         "created_at": "2016-04-21 08:35:26"
 *       },   
 *       {
 *        ..........
 *        ..........
 *        ..........
 *       },
 *       {
 *        ..........
 *        ..........
 *        ..........
 *       },
 *]
 * @apiError Unauthorized The <code>401</code> of the User not authorized.
 * @apiError Forbidden The <code>403</code> You are not allowed to perform this action.
 * @apiError NotFound The <code>404</code> of the Images was not found.
 * @apiError NotFound The <code>422</code> Data validation Failed. 
 */
 
    public function actionIndexImages()
    {
        $params = \Yii::$app->request->queryParams;
        $allowParams = ['id'];
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                if (!in_array($key, $allowParams)) {
                   throw new BadRequestHttpException('Bad Request');
                }
            }            
        }
        if ($all_images = Albums::findOne($params['id'])) {
            return $all_images -> albumImages;
        } else {  
            throw new NotFoundHttpException($message = "Object not found: " . $params['id']);  
        }
    }
    
 /**
 * @api {get} /albums/:id/images/:image_id Request Image unique ID.
 * @apiName GetImage
 * @apiGroup Images
 *
 * @apiDescription Returns the user's image unique ID.
 * Administrator gets image all users, whereas 
 * photographers are accessible only their personal albums.
 *
 * @apiParam {Number} id Albums unique ID.
 * @apiParam {Number} id Image unique ID.
 *
 * @apiExample {http} Example usage:
 *     GET: http://localhost/albums/1/image/7
 *
 * @apiSuccess {String} JSONobjects Album object in the format JSON.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *       {
 *         "id": "7",
 *         "albums_id": "1",
 *         "image": "http://tut_kakoito_URL_7",
 *         "created_at": "2016-04-21 08:35:02"
 *       }
 *
 * @apiError Unauthorized The <code>401</code> of the User not authorized.
 * @apiError Forbidden The <code>403</code> You are not allowed to perform this action.
 * @apiError NotFound The <code>404</code> of the Album was not found.   
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
    
    public function actionViewImages()
    { 
        $params = \Yii::$app->request->queryParams;
        $allowParams = ['image_id','id'];
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                if (!in_array($key, $allowParams)) {
                   throw new BadRequestHttpException('Bad Request');
                }
            }            
        }
        if (($image = AlbumImages::findOne($params['image_id'])) && $image['albums_id'] == $params['id']) {
            return $image;
        } else {  
            throw new NotFoundHttpException($message = "Object not found: " . $params['image_id']);  
        }
    }
    
    
 /**
 * @api {post} /albums/:id/images Create New Images.
 * @apiName CreateNewImage
 * @apiGroup Images
 *
 * @apiDescription Create New Images.

 * @apiParam {form-data} UploadForm[imageFile] image file.
 *
 * @apiExample {http} Example usage:
 *     POST: http://localhost/albums/1/images
 *
 * @apiParamExample {form-data} Request-Example:
 *            { "UploadForm[imageFile]" : "../pic.jpg" } 
 *
 * @apiSuccess (Success 201) {String} JSONobjects Image data object in the format JSON.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 201 Created
 *      {
 *          "image": "http://tut_kakoito_URL_17",
 *          "albums_id": "1",
 *          "id": "18"
 *      }
 *
 * @apiError Unauthorized The <code>401</code> of the User not authorized.
 * @apiError Forbidden The <code>403</code> You are not allowed to perform this action.
 * @apiError NotFound The <code>404</code> of the Image was not found.    
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
    
    
    public function actionCreateImages()
    {
        $params = \Yii::$app->request->queryParams;
        $allowParams = ['id'];
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                if (!in_array($key, $allowParams)) {
                   throw new BadRequestHttpException('Bad Request. Not supported parametrs');
                }
            }            
        }
        
        $model = new UploadForm();
            
        if (!$model->imageFile = UploadedFile::getInstance($model, 'imageFile')){
            throw new BadRequestHttpException('Bad Request. Not load file');
        }
        
        if (!$model->createDir('albom_id_' . $params['id'] . '/')) {
            throw new ServerErrorHttpException('File not save. Not create album dir');
        }
        

        if (!$model->upload('albom_id_' . $params['id'] . '/')) {
            throw new ServerErrorHttpException('File not save. File format is not image');
        }
        
        // file is uploaded successfully
        $image = new AlbumImages();
        $image->image = $model->uploadDir . 'albom_id_' . $params['id'] . '/' . $model->UploadedFileNewName;
            
        if (!$image->insert()) {
            throw new ServerErrorHttpException('Failed to action for unknown reason.');
        }
        
        \Yii::$app->getResponse()->setStatusCode(201);
        
        
        return $image;        
        
        
    }
    
    
    
    
    
 
 /**
 * @api {put} /albums/:id/images/:image_id Update Image unique ID.
 * @apiName UpdateImage
 * @apiGroup Images
 *
 * @apiDescription Update the user's image unique ID.
 *
 * @apiParam {Number} id Image unique ID.
 *
 * @apiExample {http} Example usage:
 *     PUT: http://localhost/albums/1/images/7
 *
 * @apiParamExample {json} Request-Example:
 *            {
 *             "image" : "http://tut_kakoito_URL_7"
 *            } 
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *       {
 *        "id": "7",
 *        "albums_id": "1",
 *        "image": "http://tut_kakoito_URL_7",
 *        "created_at": "2016-04-21 08:35:02"
 *       }
 *
 * @apiError Unauthorized The <code>401</code> of the User not authorized.
 * @apiError Forbidden The <code>403</code> You are not allowed to perform this action.
 * @apiError NotFound The <code>404</code> of the Album was not found.
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
    public function actionUpdateImages()
    {
        $params = \Yii::$app->request->queryParams;
        $allowParams = ['image_id','id'];
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                if (!in_array($key, $allowParams)) {
                   throw new BadRequestHttpException('Bad Request');
                }
            }            
        } 
        $image = AlbumImages::findOne(\Yii::$app->request->queryParams['image_id']);
        $image->load(\Yii::$app->getRequest()->getBodyParams(), '');
        $image -> update();
        return $image;
    }
        
/**
 * @api {delete} /albums/:id/images/:image_id Delete Image unique ID.
 * @apiName DeleteImage
 * @apiGroup Images
 *
 * @apiDescription Delete the user's image unique ID.
 *
 * @apiParam {Number} id Image unique ID.
 *
 * @apiExample {http} Example usage:
 *     DELETE: http://localhost/albums/1/images/7
 *
 * @apiSuccess (Success 204) {String} NoContent
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 204 No Content
 *
 * @apiError Unauthorized The <code>401</code> of the User not authorized.
 * @apiError Forbidden The <code>403</code> You are not allowed to perform this action.
 * @apiError NotFound The <code>404</code> of the Album was not found.
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
    public function actionDeleteImages()
    {
        $params = \Yii::$app->request->queryParams;
        $allowParams = ['image_id','id'];
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                if (!in_array($key, $allowParams)) {
                   throw new BadRequestHttpException('Bad Request');
                }
            }            
        }
        if (($image = AlbumImages::findOne(\Yii::$app->request->queryParams['image_id'])) && 
             $image['albums_id'] == \Yii::$app->request->queryParams['id']) {
            if ($image->delete() === false) {
                throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
            } else {
                \Yii::$app->getResponse()->setStatusCode(204);
            }
        } else {
            throw new NotFoundHttpException($message = "Object not found: " 
                                                        . \Yii::$app->request->queryParams['image_id']);
        }

        
    }
    

    public function actionNotAllowed()
    {
        throw new MethodNotAllowedHttpException("This Method Not Allowed");
    }
    
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();        
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'ruleConfig' => ['class' => AccessRules::className(),],
            'only' => ['index', 'view', 'create', 'update', 'delete', 'index-images', 'view-images', 'create-images', 'update-images', 'delete-images'],
            'rules' => [
                [
                    'actions' => ['index-images', 'view-images'],
                    'allow' => true,
                     // Admin allow on full index & photographer where his is author
                     // The filter implementation is done in class AlbumsSearch
                    'roles' => ['admin', 'photographer', 'client'],
                    'matchCallback' => function ($rule, $action)
                    {   //if(!$this -> isAdmin() && isset(\Yii::$app->request->queryParams["users_id"])){
                        if ($this -> isAdmin() || $this -> isOwnerAlbum() || $this -> isAllowAlbum()) {
                            
                            return true;
                        }
                    }
                ],
                
                [
                    'actions' => ['create-images', 'update-images', 'delete-images'],
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
                    'roles' => ['admin', 'photographer', 'client'],
                    'matchCallback' => function ($rule, $action)
                    {   
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
                        if ($this -> isAdmin() || $this -> isOwnerAlbum() || $this -> isAllowAlbum()) {
                            
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
