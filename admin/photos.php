<?php include("includes/header.php");
if(!$session->isSignedIn()){redirect("login.php");}

$photos = Photo::findAll();

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
                        <h1 class="page-header">Photos</h1>
                        <p class="bg-success"><?php echo $message ?></p>
                      <div class="col-md-12">

                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>Photo</th>
                              <th>Id</th>
                              <th>File Name</th>
                              <th>Title</th>
                              <th>Size</th>
                              <th>Comments</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($photos as $photo) : ?>
                            <tr>
                              <td>
                                <img src="<?php echo $photo->picPath() ?>" alt="" width="150" height=""></img>
                                <div class="actionLinks">
                                  <a class="deleteLink" href="deletePhoto.php?id=<?php echo $photo->id ?>">Delete</a>
                                  <a href="editPhoto.php?id=<?php echo $photo->id ?>">Edit</a>
                                  <a href="../photo.php?id=<?php echo $photo->id ?>">View</a>
                                </div>
                              </td>
                              <td><?php echo $photo->id ?></td>
                              <td><?php echo $photo->filename ?></td>
                              <td><?php echo $photo->title ?></td>
                              <td><?php echo $photo->size;?></td>
                               <td>
                                 <?php $comments = Comment::findComments($photo->id); ?>
                                 <a href="photoComment.php?id=<?php echo $photo->id ?>"><?php echo count($comments);  ?></a>
                               </td>
                            </tr>
                          <?php endforeach; ?>
                          </tbody>
                        </table>

                      </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>
