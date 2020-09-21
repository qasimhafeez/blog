<?php include "includes/header.php" ?>
<meta name="description" content="lurning hub blog">
<meta name="keywords" content="blog, education, learning hub, learning, lurning">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
</head>
<body>
    <header class="header">
      <!-- Main Navbar-->
    <?php include "includes/navigation.php" ?>
    </header>
    <div style="margin-top: 5%"></div>
    <div class="container">
      <div class="row">
        <!-- Latest Posts -->
        <main class="posts-listing col-lg-8"> 
          <div class="container">
            <div class="row">
              <!-- post -->
              <!-- Getting category ID -->
              <?php
                
                if(isset($_GET["category"]))
                {
                    $category_id = $_GET["category"];
                }
            
            ?>
              <?php

                //This is For Pagination

                $posts_per_page = 6;

                if(isset($_GET['page'])){

                    $page = $_GET['page'];

                }
                else {
                    $page = "";

                }

                if ($page == "" || $page == 1) {
                
                    $page_1 = 0;
                
                } else {
                    $page_1 = ($page * $posts_per_page) - $posts_per_page;
                }



                $find_rows_numbers = "select * from posts";
                $get_count = mysqli_query($connection, $find_rows_numbers);
                $count = mysqli_num_rows($get_count);
                $count = ceil($count / $posts_per_page);


                $query = "SELECT * from posts WHERE post_cat_id = {$category_id} ORDER BY post_id DESC LIMIT $page_1,$posts_per_page";
                $result = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_assoc($result))
                {
                    $post_id = $row['post_id'];
                    $post_cat_id = $row['post_cat_id'];
                    $post_title = $row['post_title'];
                    $post_desc = $row['post_desc'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_img_alt = $row['post_img_alt'];
                    $post_content = substr($row['post_content'], 0, 225);
                    $post_status = $row['post_status'];
                    
                    if($post_status == 'published')
                    {
                        
                ?>
              <div class="post col-xl-6">
                <div class="post-thumbnail"><a href="post.php?p_id=<?php echo $post_id; ?>&post_title=<?php echo $post_title; ?>"><img src="images/<?php echo $post_img_alt ?>" alt="<?php echo $post_img_alt ?>" class="img-fluid"></a></div>
                <div class="post-details">
                  <div class="post-meta d-flex justify-content-between">
                    <div class="date meta-last"><?php echo $post_date; ?></div>
                    <div class="category"><a href="#">
                    <?php 
                    global $connection;
                    $cat_query = "SELECT * from categories WHERE cat_id = {$post_cat_id}";
                    $cat_result = mysqli_query($connection, $cat_query);
                    $category = mysqli_fetch_assoc($cat_result);
                    ?>
                    <?php echo $category["cat_title"] ?></a></div>
                  </div><a href="post.php?p_id=<?php echo $post_id; ?>&post_title=<?php echo $post_title; ?>">
                    <h3 class="h4"><?php echo $post_title; ?></h3></a>
                  <p class="text-muted"><?php echo $post_desc; ?></p>
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      <!-- <div class="avatar"><img src="img/avatar-3.jpg" alt="..." class="img-fluid"></div> -->
                      <div class="title"><span><?php echo $post_author; ?></span></div></a>
                    <div class="date"><i class="icon-clock"></i><?php echo $post_date ?></div>
                    <div class="comments meta-last"><i class="icon-comment"></i><?php echo $post_comment_count ?></div>
                  </footer>
                </div>
              </div>
              <?php
                    }
                }
                ?>
              <!-- End row -->
            </div>
            <!-- Pagination -->
            <nav aria-label="Page navigation example">
              <ul class="pagination pagination-template d-flex justify-content-center">
                <!-- <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-left"></i></a></li>
                <li class="page-item"><a href="#" class="page-link active">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item"><a href="#" class="page-link">3</a></li>
                <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-right"></i></a></li> -->
                <?php 
                for ($i=1; $i <= $count; $i++) {
                    if ($i == $page) {
                        echo "<li class='page-item'><a href='index.php?page={$i}' class='page-link active'>{$i}</a></li>";     
                    } else {
                        echo "<li class='page-item'><a href='#' class='page-link active'>1</a></li>";    
                    }   
                }
                ?>
              </ul>
            </nav>
          </div>
        </main>
        <aside class="col-lg-4">
          <?php include "includes/widgets.php" ?>
        </aside>
      </div>
    </div>
    <!-- Page Footer-->
<?php include "includes/footer.php" ?>