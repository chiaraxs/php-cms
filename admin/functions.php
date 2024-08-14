<?php 


// Messages

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



// Categories

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



// Posts

function showAllPosts(){
    global $connection;

     //  All posts query
     $query = "SELECT * FROM posts";
     $select_posts = mysqli_query($connection, $query);
     //  /All posts query 

     //  Show dynamic posts 
     while ($row = mysqli_fetch_assoc($select_posts)) {
         $post_id = $row['post_id'];
         $post_category_id = $row['post_category_id'];
         $post_author = $row['post_author'];
         $post_title = $row['post_title'];
         $post_date = $row['post_date'];
         $post_image = $row['post_image'];
         $post_content = $row['post_content'];
         $post_status = $row['post_status'];
         $post_tags = $row['post_tags'];
         $post_comment_count = $row['post_comment_count'];



         echo '<tr>
                    <th scope="row">' . $post_id . '</th>
                    <td>' . $post_category_id . '</td>
                    <td>' . $post_author . '</td>
                    <td>' . $post_title . '</td>
                    <td>' . $post_date . '</td>
                    <td>' . $post_image . '</td>
                    <td>' . $post_content . '</td>
                    <td>' . $post_status . '</td>
                    <td>' . $post_tags . '</td>
                    <td>' . $post_comment_count . '</td>
                    <td>
                        <a href="posts.php?delete=' . $post_id . '"><i class="fa fa-times text-danger"></i></a>
                    </td>
                </tr>';
     }
}

function deletePost(){
    global $connection;

    if (isset($_GET['delete'])) {
        $post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$post_id}";

        $delete_query = mysqli_query($connection, $query);

        if ($delete_query) {
            $_SESSION['success_message'] = "Post eliminato con successo!";
        } else {
            $_SESSION['error_message'] = "Errore durante l'eliminazione del post.";
        }

        header("Location: posts.php"); // Refresh automatico della pagina
    }
}

