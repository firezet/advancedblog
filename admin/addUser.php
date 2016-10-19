<?php include("includes/header.php");
if(!$session->isSignedIn()){redirect("login.php");}

$user = new User();
$message = "";
if(isset($_POST["submit"])){
  if(empty($_POST["password"])){
    $message = "Password cannot be empty!";
  }else{
    if($user){
      $user->username = $_POST["username"];
      $user->password = $_POST["password"];
      $user->fName = $_POST["fName"];
      $user->lName = $_POST["lName"];
      $user->setFile($_FILES["userImage"]);
      $session->message("The user was added");
      $user->saveWithImage();
      redirect("users.php");
    }
  }
}
?>

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
                        <?php echo $message ?>
                      </div>
                      <form class="" action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-6 col-md-offset-3">
                          <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" type="text" name="username" value="">
                          </div>
                          <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="text" name="password" value="">
                          </div>
                          <div class="form-group">
                            <input type="file" name="userImage" value="" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="fName">First Name</label>
                            <input class="form-control" type="text" name="fName" value="">
                          </div>
                          <div class="form-group">
                            <label for="lName">Last Name</label>
                            <input class="form-control" type="text" name="lName" value="">
                          </div>
                          <div class="form-group">
                            <input class="btn btn-primary pull-right" type="submit" name="submit" value="Submit">
                          </div>
                        </div>
                      </form>
                </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>
