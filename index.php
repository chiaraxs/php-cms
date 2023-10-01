    <!DOCTYPE html>
    <html lang="en">

    <!--Db connection -->
    <?php
        include "includes/db.php";
    ?>

    <!-- Header -->
    <?php
        include "includes/head.php";
    ?>

    <body>
        <!-- Navigation -->
        <?php
            include "includes/navbar.php";
        ?>

        <!-- Page Content -->
        <div class="container">

            <div class="row">

                <!-- Blog Entries Column -->
                <div class="col-md-8">

                <?php 

                $query = "SELECT * FROM posts";
                $all_posts = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($all_posts)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];

                    ?>

                    <h1 class="page-header"> Page Heading <small>Secondary Text</small></h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>

                    <hr>
                    <img class="img-responsive" src="./img/<?php echo $post_image;?>" alt="post-img">
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

                    <?php
                }
                ?>

                </div>


                <!-- Blog Sidebar Widgets Column -->
                <?php
                    include "includes/sidebar.php";
                ?>

            </div>
            <!-- /.row -->

            <hr>

            <!-- Footer -->
            <?php
                include "includes/footer.php";
            ?>

        </div>
        <!-- /.container -->

        <!-- Script -->
        <?php
            include "includes/script.php";
        ?>

    </body>
    </html>
