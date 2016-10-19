<?php include("includes/header.php");
if(!$session->isSignedIn()){redirect("login.php");}

if(empty($_GET["id"])){
  redirect("comments.php");
}

$comment = Comment::findId($_GET["id"]);

if($comment){
  $comment->delete();
  $session->message("The comment was  deleted");
  redirect("comments.php");
}else{
  $session->message("The comment was not deleted");
  redirect("comments.php");
}
?>
