<?php
class DbObject{

  public static function findAll(){
      return static::findThisQuery("SELECT * FROM " . static::$dbTable . " ");
  }

  public static function findId($id){
      $resultArr = static::findThisQuery("SELECT * FROM  " . static::$dbTable . " WHERE id=$id");
      return !empty($resultArr) ? array_shift($resultArr) : false;
  }

  public static function findThisQuery($sql){
      global $database;
      $resultSet = $database->query($sql);
      $objArr = array();

      while($row = mysqli_fetch_array($resultSet)){
          $objArr[] = static::instantation($row);
      }
      return $objArr;
  }

  public static function instantation($Record){
      $callingClass = get_called_class();
      $obj = new $callingClass;

      foreach ($Record as $attribute => $value) {
          if($obj->hasAttribute($attribute)){
              $obj->$attribute = $value;
          }
      }

      return $obj;
  }

  protected function properties(){
    $properties = array();

    foreach (static::$dbTableFields as $dbField) {
      if(property_exists($this, $dbField)){
        $properties[$dbField] = $this->$dbField;
      }
    }
    return $properties;
  }

  protected function cleanProperties(){
    global $database;
    $cleanProperties = array();

    foreach ($this->properties() as $key => $value) {
      $cleanProperties[$key] = $database->escapeString($value);
    }
    return $cleanProperties;
  }

  private function hasAttribute($attribute){
      $objProperties = get_object_vars($this);
      return array_key_exists($attribute, $objProperties);
  }

  public function create(){
    global $database;
    $properties = $this->cleanProperties();

    $sql = "INSERT INTO " . static::$dbTable . "(". implode(",", array_keys($properties)) . ")";
    $sql .= "VALUES ('". implode("','", array_values($properties)) ."')";

    if($database->query($sql)){
      $this->id = $database->insertId();
      return true;
    }else{
      return false;
    }
  }

  public function save(){
    return isset($this->id) ? $this->update() : $this->create();
  }

  public function update(){
    global $database;
    $properties = $this->cleanProperties();
    $propertiesPairs = array();
    foreach ($properties as $key => $value) {
      if(!empty($value)){
        $propertiesPairs[] = "{$key}='{$value}'";
      }
    }

    $sql = "UPDATE " . static::$dbTable . " SET ";
    $sql .= implode(",", $propertiesPairs);
      $sql .= " WHERE id= '" . $database->escapeString($this->id) . "' ";

    if($database->query($sql)){
      return (mysqli_affected_rows($database->connection) == 1) ? true : die();
    }
  }

  public function delete(){
    global $database;

    $sql = "DELETE FROM " . static::$dbTable;
    $sql .= " WHERE id= '" . $database->escapeString($this->id) . "' ";


    if($database->query($sql)){
      return (mysqli_affected_rows($database->connection) == 1) ? true : die();
    }
  }

  public static function countAll(){
    global $database;
    $sql = "SELECT COUNT(*) FROM " . static::$dbTable;
    $resultSet = $database->query($sql);
    $row = mysqli_fetch_array($resultSet);
    return array_shift($row);
  }

}// OBJECT CLASS END

 ?>
