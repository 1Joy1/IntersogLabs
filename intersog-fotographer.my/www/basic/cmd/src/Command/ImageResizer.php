<?php

namespace Command;

use \PDO;

class ImageResizer

{
    public $serverName;
    public $db;
    public $userName;
    public $password;
    public $size;
    public $imageDir;
    public $prefixPathFromDB;
    
    
    
    /**
     *  
     */
    public function __construct($config)
    {
        $this->serverName = $config['serverName'];
        $this->db =  $config['db'];
        $this->userName=  $config['userName'];
        $this->password =  $config['password'];
        $this->size =  $config['size'];
        $this->imageDir =  $config['imageDir'];
        $this->prefixPathFromDB =  $config['prefixPathFromDB'];
    }
    
    
    
    /**
     * @init method
     *
     */
    public function init()
    {
        $connection = $this->getConnection();
        if ($images = $this->getNewImages($connection)) {
            
            foreach ($images as $i => $image) {
                $src = $this->getNameImages($connection, $images[$i]['image_id']);
                
                if ($newResProperty = $this->resizePhoto ($src, $images[$i]['size'])) {
                    $this->updateImages($connection, 'complete', 'done',  $newResProperty['src'], $image['id'], $newResProperty['size']);                
                } else {                    
                    $this->updateImages($connection, 'error', 'something wrong',  null, $image['id'],  null);
                }
                
            }
            
            echo "Everything is done \n";

            $connection = null;
        } else echo "Everything is done \n";
        
    }
    
    
    
    /**
     * Update record on db
     *
     * @param Object $connection
     * @param String $status
     * @param String $message
     * @param String $imagepath
     * @param String $size
     * @param Intger $id
     *
     *
     * @return bool
     */
    public function updateImages($connection, $status, $message, $imagepath, $id, $size)
    {
        $sql = 'UPDATE resized_photos SET status="' . $status . '", size="' . $size . '", src="' . $imagepath . '" WHERE id = ' . $id;        
        $query = $connection->prepare($sql);
        $query->execute();
        echo $message."\n";
        return true;
    }


    /**
     * @getConnection() method 
     *
     * @return Object $connection
     */
     
    public function getConnection()
    {
        try {
            $connection = new PDO("mysql:host=$this->serverName;dbname=$this->db", $this->userName, $this->password);
            // set the PDO error mode to exception
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully \n\n";
        } 
        
        catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
        }
        
        return $connection;
    }


    
    
    /**
     * @getNewImages() method
     *
     * @param Object $connection
     * 
     * @return Array $images
     */
     
    public function getNewImages($connection)
    {
        $sql = "SELECT id, size, image_id, src, status, comment FROM resized_photos WHERE status='new' ORDER BY id ASC";
        $query = $connection->prepare($sql);
        $query->execute();
        $result = $query->setFetchMode(PDO::FETCH_ASSOC);
        $images = $query->fetchAll();
        if (count($images) > 0) {
            $this->changeStatus($connection, 'in_progress', 'new');
            echo "Changed status to 'in_progress' on " . count($images) . " images. \n\n";
        }
        
        if (count($images) == 0)
            {
                echo "No new images. \n";
                return false;
            }
        return $images;
    }

    
    
    
    /**
     * @changeStatus() method
     *
     * @param Object $connection
     * @param String $statusNew
     * @param String $statusOld
     *
     * @return Bool
     */
     
    public function changeStatus($connection, $statusNew, $statusOld)
    {
        $sql = 'UPDATE resized_photos SET status = "' . $statusNew . '" WHERE status = "' . $statusOld . '"';
        $query = $connection->prepare($sql);
        $query->execute();
        return true;
    }
    

    
    /**
     * @getNameImages() method
     *
     * @param Object $connection
     * @param integer $image_id
     *
     * @return String $src
     */
     
    public function getNameImages($connection, $image_id)
    {
        $sql = 'SELECT image FROM album_images WHERE id = ' . $image_id;
        $query = $connection->prepare($sql);
        $query->execute();
        $result = $query->setFetchMode(PDO::FETCH_ASSOC);
        return $src = rtrim($query->fetchAll()[0]['image']);

    }
 
    
    
    /**
     * @getNameImages() method
     *
     * @param String $imagePath
     * @param String $size
     *
     * @return Array $newResProperty
     */
     
    public function resizePhoto($imagePath, $size)
    {

        $pref = $this->prefixPathFromDB;
        $sourceImagePath = $pref . $imagePath;
        $sourceFolder = dirname($sourceImagePath) . "/";
        $originPathFolder = dirname($imagePath) . "/";
        
        
        if (!file_exists($sourceFolder . $size)) {
            
            echo "Path " . $sourceFolder . $size . " not found \nCreate new directory " . $sourceFolder . $size . "\n\n";            
            if (!mkdir($sourceFolder . $size)) {
                die('Unable to create directory: ' . $sourceFolder . $size);
            }
        }

        echo "Open image " . basename($sourceImagePath) . "\n";        
        
        if (!$imagesize = getimagesize( $sourceImagePath )) {
            echo "This not image \n\n";
            return false;
        }
        
        switch ($imagesize[2]) {
            case 1: //GIF
                $image = imagecreatefromgif($sourceImagePath);
                break;
            case 2: //JPEG
                $image = imagecreatefromjpeg($sourceImagePath);
                break;
            case 3: //PNG
                $image = imagecreatefrompng($sourceImagePath);
                break;
            case 6: //BMP
                $image = imagecreatefromwbmp($sourceImagePath);
                break;
            default:
                echo "Not support image format \n\n";
                return false;
        } 
        
        echo "Resize image \n";
        $sourceWidth = $imagesize[0];
        $sourceHeight = $imagesize[1];
        
        $ratio = $sourceWidth / $sourceHeight;
        
        $newWidth = (int)$size;
        $newHeight = round($newWidth / $ratio);
        
        echo "oldSize:  " . $sourceWidth . "x" . $sourceHeight . " ratio: " . $ratio . " -> ";
        echo "NewSize:  " . $newWidth . "x" . $newHeight . "\n";
        
        $resizedWorkFolder = $sourceFolder . $size . "/";
       
        $pathinfo = pathinfo($imagePath);   
        $resizedFileName = basename($imagePath, '.' . $pathinfo['extension']) . "_" . $size;
        
                
        $newResImage = imagecreatetruecolor($newWidth, $newHeight);
        
           
        if ((!imagecopyresampled($newResImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $sourceWidth, $sourceHeight)) || 
            (!imagejpeg($newResImage, $resizedWorkFolder . $resizedFileName . '.jpg'))) {
                
            return false;
        }
        
        echo "Save to " . $resizedWorkFolder . $resizedFileName . ".jpg \n\n";
        imagedestroy($newResImage);
        imagedestroy($image);
        $newResProperty = array('size' => $newWidth . "x" . $newHeight, 
                                 'src' => $originPathFolder . $size . "/" . $resizedFileName . '.jpg');
        return $newResProperty;    

    }
    
    
}

