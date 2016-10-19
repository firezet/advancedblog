<?php include("includes/header.php");
if(!$session->isSignedIn()){redirect("login.php");}

if(empty($_GET["id"])){
  redirect("photos.php");
}

$photo = Photo::findId($_GET["id"]);

if($photo){
  $photo->deletePhoto();
  redirect("../photos.php");
  $session->message("The photo was deleted");
}else{
  $session->message("The photo was not deleted");
  redirect("photos.php");
}
?>
