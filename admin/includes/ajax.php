<?php
require_once("init.php");
$user = new User();

if(isset($_POST["imageName"]) &&  isset($_POST["userId"])){
  $user->ajaxSaveUserImage($_POST["userId"], $_POST["imageName"]);
}

if(isset($_POST["photoId"])){
  Photo::sidebarData($_POST["photoId"]);
}
 ?>
