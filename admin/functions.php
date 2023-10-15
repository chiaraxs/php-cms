<?php 

function insert_category(){

    global $connection;

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
}


function showAllCategories(){
    global $connection;

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
                         <td>
                             <a href="categories.php?delete=' . $cat_id . '"><i class="fa fa-times text-danger"></i></a>
                             <a href="categories.php?edit=' . $cat_id . '"><i class="fa fa-pencil text-success"></i></a>
                         </td>
                     </tr>';
     }
}

function deleteCategory(){
    global $connection;

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
}


function editCategory(){
    global $connection;

    if (isset($_GET['edit'])) {
        $cat_id = $_GET['edit'];

        // All categories query
        $query = "SELECT * FROM categories WHERE cat_id = $cat_id"; // Usa un solo uguale (=) per la condizione di confronto
        $select_categories_id = mysqli_query($connection, $query);
        // /All categories query 

        //  Show dynamic categories 
        while ($row = mysqli_fetch_assoc($select_categories_id)) {
            $cat_title = $row['cat_title'];
    ?>
            <input value="<?php if (isset($cat_title)) {
                                echo $cat_title;
                            } ?>" type="text" class="form-control" name="cat_title" id="category">
    <?php
        }
    }
}


function showMessages(){
    global $connection;

    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']); // Rimuovi il messaggio dalla sessione
    }

    if (isset($_SESSION['error_message'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']); // Rimuovi il messaggio dalla sessione
    }
}