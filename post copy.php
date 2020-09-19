<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                
                
                
                <?php
                    if(isset($_GET['post_title']) && $_GET['p_id'])
                    {
                        $post_title = $_GET['post_title'];
                        $post_id = $_GET['p_id'];
                    }
                ?>
                
                
               <?php 
                
                //Here we can see every single post entirely by clicking on the link of the name of the post
                
                $query = "select * from posts WHERE post_id = {$post_id}";
                $result = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_assoc($result))
                {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                
                ?>
               

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                
                <?php
                }
                ?>
                         
               
                <!-- Blog Comments -->

               
               <?php
                    if(isset($_POST["create_comment"]))
                    {
                        $p_id = $_GET['p_id'];
                        $cmt_author = $_POST['cmt_author'];
                        $cmt_email = $_POST['cmt_email'];
                        $cmt_content = $_POST['cmt_content'];
                        
                        if(!empty($cmt_author) && !empty($cmt_email) && !empty($cmt_content))
                        {
                            $query = "INSERT INTO comments (cmt_post_id, cmt_author, cmt_email, cmt_content, cmt_status,
                                        cmt_date) ";
                            $query .= "VALUES ($p_id, '{$cmt_author}', '{$cmt_email}', '{$cmt_content}', 'unapproved', now())";

                            $cmt_query = mysqli_query($connection, $query);

                            $query = "UPDATE posts set post_comment_count = post_comment_count + 1 ";
                            $query .= "WHERE post_id = $p_id ";
                            $update_cmt_count = mysqli_query($connection, $query);
    
                        }
                        else
                        {
                            echo "<script>alert('Fields cannot be empty!')</script>";
                        }
                                                
                        
                        
                    }
                
                ?>
               
               
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label for="cmt_author">Author</label>
                            <input type="text" class="form-control" name="cmt_author">
                        </div>
                        <div class="form-group">
                            <label for="cmt_email">Email</label>
                            <input type="email" class="form-control" name="cmt_email">
                        </div>
                        <div class="form-group">
                            <label for="cmt_content">Your Comment</label>
                            <textarea class="form-control" rows="3" name="cmt_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

               
               <?php
                
                    $query = "SELECT * from comments WHERE cmt_post_id = $post_id ";
                    $query .= "AND cmt_status = 'approved' ";
                    $query .= "ORDER BY cmt_id DESC ";
                    
                    $get_cmt = mysqli_query($connection, $query);
                    if(!$get_cmt)
                    {
                        die("There is a problem in the Command ".mysqli_error($connection));    
                    }
                
                    while($row = mysqli_fetch_assoc($get_cmt))
                    {
                        $cmt_date = $row["cmt_date"];
                        $cmt_content = $row["cmt_content"];
                        $cmt_author = $row["cmt_author"];
                    
                
                ?>
               
               
                <!-- Comment -->
               
                   
            
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $cmt_author; ?>
                            <small><?php echo $cmt_date; ?></small>
                        </h4>
                        <?php echo $cmt_content; ?>
                    </div>
                </div>
                <?php
                    }
                ?>
                <hr>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php"; ?>