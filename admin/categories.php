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
                        <!-- Mostra messaggi di errore o conferma eliminazione -->
                        <?php showMessages();?>
                        <!-- /Mostra messaggi di errore o conferma eliminazione -->

                        <!-- Add category -->
                        <?php insert_category();?>

                        <form action="#" method="post">
                            <div class="form-group">
                                <label for="cat_title">Crea categoria</label>
                                <input type="text" class="form-control" name="cat_title" id="category">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Crea">
                            </div>
                        </form>
                        <!-- /Add category -->

                        <?php 
                            if(isset($_GET['edit'])){
                                $cat_id = $_GET['edit'];

                                include "includes/update_categories.php";
                            }
                        ?>
                    </div>

                    <div class="col-lg-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Titolo</th>
                                    <th scope="col">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Show dynamic categories  -->
                                <?php showAllCategories();?>
                                <!-- / Show dynamic categories -->

                                <!-- Delete category -->
                                <?php deleteCategory();?>
                                <!-- /Delete category -->
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