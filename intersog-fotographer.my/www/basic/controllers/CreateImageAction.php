<?php
namespace app\controllers;

use Yii;

use app\models\UploadForm;
use app\models\AlbumImages;
use app\models\ResizedPhotos;

use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\ServerErrorHttpException;


class CreateImageAction extends \yii\rest\Action
{
    public function run()
    {
        $model = new UploadForm();        

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
                
                $params = \Yii::$app->request->getQueryParams();
                $albumImage = new AlbumImages();
                $albumImage->image = $model->uploadDir . $model->imageFile->name;
                
                /*$resizedPhoto100 = new ResizedPhotos(['status'=>'new']);
                $resizedPhoto400 = new ResizedPhotos(['status' =>'new']);
               
                $albumImage->resized[] =  $resizedPhoto100;
                $albumImage->resized[] =  $resizedPhoto400;*/
                    
                if (!$albumImage->save()) {
                    throw new ServerErrorHttpException('Failed to action for unknown reason.');
                }
                
                return;
            } else {
                throw new ServerErrorHttpException('File not save. Contact the administrator');
            }
        }

        //return $this->render('upload', ['model' => $model]);
    }
}