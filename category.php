<?php include "includes/header.php" ?>
<meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
</head>
<body>
    <header class="header">
      <!-- Main Navbar-->
      <nav class="navbar navbar-expand-lg">
        <div class="search-area">
          <div class="search-area-inner d-flex align-items-center justify-content-center">
            <div class="close-btn"><i class="icon-close"></i></div>
            <div class="row d-flex justify-content-center">
              <div class="col-md-8">
                <form action="#">
                  <div class="form-group">
                    <input type="search" name="search" id="search" placeholder="What are you looking for?">
                    <button type="submit" class="submit"><i class="icon-search-1"></i></button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <!-- Navbar Brand -->
          <div class="navbar-header d-flex align-items-center justify-content-between">
            <!-- Navbar Brand --><a href="index.html" class="navbar-brand">Bootstrap Blog</a>
            <!-- Toggle Button-->
            <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span></span><span></span><span></span></button>
          </div>
          <!-- Navbar Menu -->
          <div id="navbarcollapse" class="collapse navbar-collapse">
            <!-- <ul class="navbar-nav ml-auto">
              <li class="nav-item"><a href="index.html" class="nav-link ">Home</a>
              </li>
              </li>
              <li class="nav-item"><a href="post.html" class="nav-link ">Post</a>
              </li>
              <li class="nav-item"><a href="#" class="nav-link ">Contact</a>
              </li>
            </ul>
            <div class="navbar-text"><a href="#" class="search-btn"><i class="icon-search-1"></i></a></div>
            <ul class="langs navbar-text"><a href="#" class="active">EN</a><span>           </span><a href="#">ES</a></ul>
          </div> -->
        </div>
      </nav>
    </header>
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


                $query = "SELECT * from posts WHERE post_cat_id = {$category_id} ORDER BY post_date DESC LIMIT $page_1,$posts_per_page";
                $result = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_assoc($result))
                {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 225);
                    $post_status = $row['post_status'];
                    
                    if($post_status == 'published')
                    {
                        
                ?>
              <div class="post col-xl-6">
                <div class="post-thumbnail"><a href="post.html"><img src="img/blog-post-1.jpeg" alt="..." class="img-fluid"></a></div>
                <div class="post-details">
                  <div class="post-meta d-flex justify-content-between">
                    <div class="date meta-last"><?php echo $post_date; ?></div>
                    <div class="category"><a href="#">Business</a></div>
                  </div><a href="post.html">
                    <h3 class="h4">Alberto Savoia Can Teach You About Interior</h3></a>
                  <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      <div class="avatar"><img src="img/avatar-3.jpg" alt="..." class="img-fluid"></div>
                      <div class="title"><span>John Doe</span></div></a>
                    <div class="date"><i class="icon-clock"></i> 2 months ago</div>
                    <div class="comments meta-last"><i class="icon-comment"></i>12</div>
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