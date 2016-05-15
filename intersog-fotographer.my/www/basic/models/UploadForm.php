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
     * @var UploadedDir
     */
    public $uploadDir = '../upload/';
    
    
    
    /**
     * @var UploadedFileNewName
     */
    public $UploadedFileNewName;
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['imageFile'], 'image', 'skipOnEmpty' => false],
            
        ];
    }
    
    
    /**
     * @inheritdoc
     */
    public function createDir($albumDir)
    {
        if (!file_exists($this->uploadDir . $albumDir)) {
           $dir = mkdir($this->uploadDir . $albumDir);
           return $dir;
        }
        return true;
    }
    
    
    
    /**
     * @inheritdoc
     */
    public function upload($albumDir)
    {
        if ($this->validate()) {
            
            $this->UploadedFileNewName = $this->imageFile->baseName . '.' . $this->imageFile->extension;
            
            if (file_exists($this->uploadDir . $albumDir . $this->UploadedFileNewName)) {
                
                $i = 1; //digital prefix for name file
                do {
                    $this->UploadedFileNewName = $this->imageFile->baseName . $i . '.' . $this->imageFile->extension;
                    $i++;
                } while (file_exists($this->uploadDir . $albumDir . $this->UploadedFileNewName));
            }
                
            
            $this->imageFile->saveAs($this->uploadDir . $albumDir . $this->UploadedFileNewName);
            return true;
        } else {
            return false;
        }
    }
    
    
}