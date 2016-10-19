<?php include("includes/header.php");
if(!$session->isSignedIn()){redirect("login.php");}

$comments = Comment::findAll();

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
                        <h1 class="page-header">All Comments</h1>
                        <p class="bg-success"><?php echo $message ?></p>
                      <div class="col-md-12">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Author</th>
                              <th>Body</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($comments as $comment) : ?>
                            <tr>
                              <td><?php echo $comment->id ?></td>
                              <td>
                                <?php echo $comment->author ?>
                                <div class="picturesLink">
                                  <a class="deleteLink" href="deletecomment.php?id=<?php echo $comment->id ?>">Delete</a>
                                  <a href="editcomment.php?id=<?php echo $comment->id ?>">Edit</a>
                                  <a href="#">View</a>
                                </div>
                              </td>
                              <td><?php echo $comment->body ?></td>
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
