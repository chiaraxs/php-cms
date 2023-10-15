<!-- Edit category -->
<form action="#" method="post">
    <div class="form-group">
        <label for="cat_title">Modifica categoria</label>

        <?php editCategory();?>


        <!-- Update category -->
        <?php
        if (isset($_POST['update_cat'])) {
            $cat_title = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = {$cat_id}";

            $update_query = mysqli_query($connection, $query);

            if (!$update_query) {
                die("Aggiornamento fallito." . mysqli_error($connection));
            }

            if ($update_query) {
                $_SESSION['success_message'] = "Categoria aggiornata con successo!";
            } else {
                $_SESSION['error_message'] = "Errore durante la modifica della categoria.";
            }

            header("Location: categories.php"); // Refresh automatico della pagina
        }



        ?>
        <!-- /Update category -->

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_cat" value="Modifica">
    </div>
</form>
<!-- /Edit category -->