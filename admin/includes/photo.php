<?php

class Photo extends DbObject{

  protected static $dbTable = "photos";
  protected static $dbTableFields = array("title", "description", "filename", "type", "size", "alternateText", "caption");
  public $id;
  public $title;
  public $description;
  public $filename;
  public $alternateText;
  public $type;
  public $size;
  public $tmpPath;
  public $uploadDir = "images";
  public $customErrors = array();
  public $uploadErrorArr = array(
    UPLOAD_ERR_OK => "There is no error",
    UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive",
    UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive",
    UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded",
    UPLOAD_ERR_NO_FILE => "No file was uploaded",
    UPLOAD_ERR_NO_TMP_DIR => "Missing temporary folder",
    UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
    UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload"
);

  public function setFile($file){
    if(empty($file) || !$file || !is_array($file)){
      $this->errors[] = "There was no file uploaded here";
      return false;
    }else if($file["error"] != 0){
      $this->errors[] = $this->uploadErrorArr[$file["error"]];
      return false;
    }

    $this->filename = basename($file["name"]);
    $this->tmpPath = $file["tmp_name"];
    $this->type = $file["type"];
    $this->size = $file["size"];
  }

  public function picPath(){
    return $this->uploadDir.DS.$this->filename;
  }

  public function save(){
    if($this->id){
      $message = "Photo uploaded!";
      $this->update();
    }else{
      if(!empty($this->errors)){
        return false;
      }
      if(empty($this->filename) || empty($this->tmpPath)){
        $this->errors[] = "the file was not available";
        return false;
      }
      $targetPath = SITE_ROOT . DS . "admin" . DS . $this->uploadDir . DS . $this->filename;

      if(file_exists($targetPath)){
        $this->errors[] = "The file {$this->filename} already exists";
        return false;
      }

      if(move_uploaded_file($this->tmpPath, $targetPath)){
        if($this->create()){
          unset($this->tmpPath);
          return true;
        }
      }else{
        $this->errors[] = "The file directory doesnt have permissions";
        return false;
      }
      $message = "Photo uploaded!";
      $this->create();
    }
    $message = "Photo uploaded!";
  }

  public function deletePhoto(){
    if($this->delete()){
      $targetPath = SITE_ROOT.DS. 'admin' . DS . $this->picPath();

      return unlink($targetPath) ? true : false;
    }else{
      return false;
    }
  }

  public static function sidebarData($photoId){
    $photo = Photo::findId($photoId);
    $sizeMb = round($photo->size*0.00001, 2);
    $output =
    '<a class="thumbnail" href="#"><img src="'.$photo->picPath().'" alt="" /></a>
    <p>'.$photo->filename.'</p>
    <p>'.$photo->type.'</p>
    <p>'.$sizeMb.'Mb</p>';

    echo $output;
  }


}

 ?>
