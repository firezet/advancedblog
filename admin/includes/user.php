<?php

class User extends DbObject{

    protected static $dbTable = "users";
    protected static $dbTableFields = array("username", "password", "fName", "lName", "userImage");
    public $id;
    public $username;
    public $password;
    public $fName;
    public $lName;
    public $userImage;
    public $imagePlaceholder = "http://placehold.it/100x100&text=image";
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

    public function userImage(){
      return empty($this->userImage) ? $this->imagePlaceholder : $this->uploadDir.DS.$this->userImage;
    }

    public static function verifyUser($username, $password){
      global $database;

      $username = $database->escapeString($username);
      $password = $database->escapeString($password);

      $sql = "SELECT * FROM " . self::$dbTable . " WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";
      $resultArr = self::findThisQuery($sql);

      return !empty($resultArr) ? array_shift($resultArr) : false;
    }

    public function setFile($file){
      if(empty($file) || !$file || !is_array($file)){
        $this->errors[] = "There was no file uploaded here";
        return false;
      }else if($file["error"] != 0){
        $this->errors[] = $this->uploadErrorArr[$file["error"]];
        return false;
      }

      $this->userImage = basename($file["name"]);
      $this->tmpPath = $file["tmp_name"];
      $this->type = $file["type"];
      $this->size = $file["size"];
    }

    public function saveWithImage(){
      if(!$this->id){
        $this->create();
      }else{
        if(!empty($this->errors)){
          return false;
        }
        if(empty($this->userImage) || empty($this->tmpPath)){
          $this->errors[] = "the file was not availabuserImage";
          return false;
        }
        $targetPath = SITE_ROOT . DS . "admin" . DS . $this->uploadDir . DS . $this->userImage;

        if(file_exists($targetPath)){
          $this->errors[] = "The file {$this->userImage} already exists";
          return false;
        }

        if(move_uploaded_file($this->tmpPath, $targetPath)){
          if($this->update()){
            unset($this->tmpPath);
            return true;
          }
        }else{
          $this->errors[] = "The file directory doesnt have permissions";
          return false;
        }
        $this->update();
      }

    }

    public function ajaxSaveUserImage($userId, $userImage){
      global $database;

      $userId = $database->escapeString($userId);
      $userImage = $database->escapeString($userImage);
      $this->id = $userId;
      $this->userImage = $userImage;

      $sql = "UPDATE users SET userImage='{$this->userImage}' WHERE id={$this->id}";
      $updateImage = $database->query($sql);

      echo $this->userImage();
    }

} /// USER CLASS END ///
?>
