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
                        <?php
                        if (isset($_SESSION['success_message'])) {
                            echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_message'] . '</div>';
                            unset($_SESSION['success_message']); // Rimuovi il messaggio dalla sessione
                        }

                        if (isset($_SESSION['error_message'])) {
                            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
                            unset($_SESSION['error_message']); // Rimuovi il messaggio dalla sessione
                        }
                        ?>
                        <!-- /Mostra messaggi di errore o conferma eliminazione -->


                        <!-- Add category -->
                        <?php
                        if (isset($_POST['submit'])) {
                            $cat_title = $_POST['cat_title'];

                            if ($cat_title == "" || empty($cat_title)) {
                                echo '<div class="alert alert-danger" role="alert">Il campo non può essere vuoto.</div>';
                            } else {
                                // Controlla se la categoria esiste già nel database
                                $check_query = "SELECT * FROM categories WHERE cat_title = '{$cat_title}'";
                                $check_result = mysqli_query($connection, $check_query);

                                if (mysqli_num_rows($check_result) > 0) {
                                    echo '<div class="alert alert-danger" role="alert">La categoria esiste già nel database.</div>';
                                } else {
                                    // La categoria non esiste, quindi la puoi inserire nel database
                                    $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}')";
                                    $create_category_query = mysqli_query($connection, $query);

                                    if (!$create_category_query) {
                                        die('CREAZIONE FALLITA!' . mysqli_error($connection));
                                    } else {
                                        echo '<div class="alert alert-success" role="alert">Categoria inserita con successo!</div>';
                                    }
                                }
                            }
                        }
                        ?>
                        <!-- /Add category -->

                        <form action="#" method="post">
                            <div class="form-group">
                                <label for="cat_title">Category Title</label>
                                <input type="text" class="form-control" name="cat_title" id="category">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add category">
                            </div>
                        </form>
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
                                <?php
                                //  All categories query
                                $query = "SELECT * FROM categories";
                                $select_categories = mysqli_query($connection, $query);
                                //  /All categories query 

                                //  Show dynamic categories 
                                while ($row = mysqli_fetch_assoc($select_categories)) {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];

                                    echo '<tr>
                                                    <th scope="row">' . $cat_id . '</th>
                                                    <td>' . $cat_title . '</td>
                                                    <td><a href="categories.php?delete=' . $cat_id . '"><i class="fa fa-times text-danger"></i></a></td>
                                                </tr>';
                                }
                                ?>
                                <!-- / Show dynamic categories -->

                                <!-- Delete category -->
                                <?php
                                if (isset($_GET['delete'])) {
                                    $cat_id = $_GET['delete'];
                                    $query = "DELETE FROM categories WHERE cat_id = {$cat_id}";

                                    $delete_query = mysqli_query($connection, $query);

                                    if ($delete_query) {
                                        $_SESSION['success_message'] = "Categoria eliminata con successo!";
                                    } else {
                                        $_SESSION['error_message'] = "Errore durante l'eliminazione della categoria.";
                                    }

                                    header("Location: categories.php"); // Refresh automatico della pagina
                                }
                                ?>
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