<?php include("includes/header.php");
if(!$session->isSignedIn()){redirect("login.php");}

if(empty($_GET["id"])){
  redirect("users.php");
}else{
  $user = User::findId($_GET["id"]);
}

if(isset($_POST["update"])){
    $user->username = $_POST["username"];
    $user->password = $_POST["password"];
    $user->fName = $_POST["fName"];
    $user->lName = $_POST["lName"];
    redirect("users.php");
    if(empty($_FILES["userImage"])){
      $user->save();
      $session->message("The user has been updated");
      redirect("users.php");
    }else{
      $user->setFile($_FILES["userImage"]);
      $user->saveWithImage();
      $user->save();
      $session->message("The user has been updated");
      redirect("users.php");
    }

}
?>

        <!-- Photo Model Snippet -->
        <?php include("includes/photoModelSnippet.php") ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->


            <?php
            include("includes/topNav.php");
            ?>

            <?php
            include("includes/sideNav.php");
            ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                      <div class="col-lg-12">
                        <h1 class="page-header">users <small>Subheading</small></h1>
                      </div>

                      <div class="col-md-6 user_image_box">
                        <a href="#" data-toggle="modal" data-target="#photoLibrary"><img class="img-responsive" src="<?php echo $user->userImage() ?>" alt="" /></a>
                      </div>

                      <form class="" action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" type="text" name="username" value="<?php echo $user->username ?>">
                          </div>
                          <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="text" name="password" value="<?php echo $user->password ?>">
                          </div>
                          <div class="form-group">
                            <label for="userImage">Upload new Image</label>
                            <input type="file" name="userImage" value="" class="form-control">
                          </div>
                          <div class="form-group">
                            <a href="#" data-toggle="modal" data-target="#photoLibrary" class="btn btn-primary">Select Image from gallery</a>
                          </div>
                          <div class="form-group">
                            <label for="fName">First Name</label>
                            <input class="form-control" type="text" name="fName" value="<?php echo $user->fName ?>">
                          </div>
                          <div class="form-group">
                            <label for="lName">Last Name</label>
                            <input class="form-control" type="text" name="lName" value="<?php echo $user->lName ?>">
                          </div>
                          <div class="form-group">
                            <input class="btn btn-primary pull-right" type="submit" name="update" value="Update">
                          </div>
                          <div class="form-group">
                            <a id="userId" href="deleteuser.php?id=<?php echo $user->id; ?>" class="btn btn-danger">Delete</a>
                          </div>
                        </div>
                      </form>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>
