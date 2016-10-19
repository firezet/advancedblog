<?php
include("includes/header.php");
if(!$session->isSignedIn()){redirect("login.php");}

$message = "";
if(isset($_FILES["file"])){
  $photo = new Photo();
  $photo->title = $_POST["title"];
  $photo->setFile($_FILES["file"]);
  if($photo->save()){
    $message = "Photo uploaded!";
  }else{
    $message = join("<br>", $photo->errors);
  }
}
?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->


            <?php
              include("includes/topNav.php");
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
                        <h1 class="page-header">Upload</h1>
                        <?php echo $message; ?>
                </div>
                </div>
                <div class="row">
                  <div class="col-md-6">

                    <form class="" action="upload.php" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <h4>New file name</h2>
                        <input type="text" name="title" value="" class="form-control">
                      </div>

                      <div class="form-group">
                        <input type="file" name="file" value="" class="form-control">
                      </div>

                      <div class="form-group">
                        <input type="submit" name="submit" value="Upload" class="">
                      </div>
                    </form>
                  </div>
                </div>
                <!-- /.row -->
                <div class="row">
                  <div class="col-lg-12">
                    <form class="dropzone" action="upload.php" method="post"></form>
                  </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>
