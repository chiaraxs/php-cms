<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<?php
include "./includes/admin_head.php";
?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
        include "./includes/admin_navbar.php";
        ?>
        <!-- /Navigation -->

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small>Nome User</small>
                        </h1>
                    </div>


                    <div class="col-lg-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Autore</th>
                                    <th scope="col">Titolo</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Immagine</th>
                                    <th scope="col">Contenuto</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tags</th>
                                    <th scope="col">N.commenti</th>
                                    <th scope="col">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Show dynamic posts  -->
                                <?php showAllPosts();?>
                                <!-- / Show dynamic posts -->

                                <!-- Delete post -->
                                <?php deletePost();?>
                                <!-- /Delete post -->
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Script -->
    <?php
    include "./includes/admin_script.php";
    ?>
    <!-- /Script -->
</body>

</html>