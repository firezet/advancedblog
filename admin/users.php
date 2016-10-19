<?php include("includes/header.php");
if(!$session->isSignedIn()){redirect("login.php");}

$users = User::findAll();

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

                        <h1 class="page-header">
                            users
                            <small>Subheading</small>
                        </h1>
                        <p class="bg-success"><?php echo $message ?></p>
                        <a href="addUser.php" class="btn btn-primary">Add User</a>

                      <div class="col-md-12">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Photo</th>
                              <th>Username</th>
                              <th>First Name</th>
                              <th>Last Name</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($users as $user) : ?>
                            <tr>
                              <td><?php echo $user->id ?></td>
                              <td><img src="<?php echo $user->userImage() ?>" alt="" width="150" height=""></img>

                              </td>
                              <td>
                                <?php echo $user->username ?>
                                <br>
                                <div class="picturesLink">
                                  <a class="deleteLink" href="deleteuser.php?id=<?php echo $user->id ?>">Delete</a>
                                  <a href="edituser.php?id=<?php echo $user->id ?>">Edit</a>
                                  <a href="#">View</a>
                                </div>
                              </td>
                              <td><?php echo $user->fName ?></td>
                              <td><?php echo $user->lName ?></td>
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
