<?php include("includes/header.php");
if(!$session->isSignedIn()){redirect("login.php");}
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

           <?php
           include("includes/adminContent.php");
           ?>

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>
