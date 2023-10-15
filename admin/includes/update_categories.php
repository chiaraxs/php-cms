<!-- Edit category -->
<form action="#" method="post">
                            <div class="form-group">
                                <label for="cat_title">Modifica categoria</label>

                                <?php
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
                                ?>


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