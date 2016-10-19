<?php include("includes/header.php");
if(!$session->isSignedIn()){redirect("login.php");}

if(empty($_GET["id"])){
  redirect("users.php");
}

$user = User::findId($_GET["id"]);

if($user){
  $user->delete();
  $session->message("The user has been deleted");
  redirect("users.php");
}else{
  $session->message("The user was not deleted");
  redirect("users.php");
}
?>
