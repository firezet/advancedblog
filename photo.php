<?php
include("includes/header.php");
require_once("admin/includes/init.php");

$photo = Photo::findId($_GET["id"]);
$photoId = $photo->id;

if(empty($_GET["id"])){
  redirect("index.php");
}

if(isset($_POST["submit"])){
  $author = trim($_POST["author"]);
  $body = trim($_POST["body"]);
  $newComment = Comment::createComment($photoId, $author, $body);

  if($newComment && $newComment->save()){
    redirect("photo.php?id={$photo->id}");
  }else{
    $message = "There was some problem with comment";
  }
}else{
  $author = "";
  $body = "";
}

$comments = Comment::findComments($photoId);
 ?>

          <div class="row">
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <!-- <p class="lead">
                    by <a href="#">$photo->author</a>
                </p> -->

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on Some Date</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="admin/<?php echo $photo->picPath() ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead">
                  <?php echo $photo->description ?>
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                      <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" name="author" value="" class="form-control">
                      </div>
                        <div class="form-group">
                          <label for="body">Comment</label>
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php foreach ($comments as $comment):  ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author; ?>
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        <?php echo $comment->body; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <!-- Blog Sidebar Widgets Column -->
        </div>
        <!-- /.row -->
</div>
      <?php include("includes/footer.php") ?>
