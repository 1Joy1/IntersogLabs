<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    
    /**
     * @var UploadedFile
     */

    public $imageFile;
    
    
    
    
    /**
     * @var UploadedFile
     */
    public $uploadDir = '../upload/';
    
    
    
    
    public function rules()
    {
        return [
            [['imageFile'], 'image', 'skipOnEmpty' => false],
            
        ];
    }
    
    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs($this->uploadDir . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
    
    
}