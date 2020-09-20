<?php include "includes/header.php" ?>
<?php 
  if(isset($_GET['post_title']) && $_GET['p_id'])
  {
      $post_title = $_GET['post_title'];
      $post_id = $_GET['p_id'];
  }
  global $connection;
  $query = "SELECT post_title,post_tags from posts WHERE post_id = {$post_id}";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);
  
  

?>

<meta name="description" content="<?php echo $row["post_title"]; ?>">
<meta name="keywords" content="<?php echo $row["post_tags"]; ?>">
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
          <?php include "includes/logo.php" ?>
          <div id="navbarcollapse" class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
              <!-- <li class="nav-item"><a href="index.html" class="nav-link ">Home</a>
              </li>
              </li>
              <li class="nav-item"><a href="post.html" class="nav-link ">Post</a>
              </li>
              <li class="nav-item"><a href="#" class="nav-link ">Contact</a>
              </li> -->
            </ul>
            <div class="navbar-text"><a href="#" class="search-btn"><i class="icon-search-1"></i></a></div>
            <ul class="langs navbar-text"><a href="login.php" class="active">Login</a></ul>
          </div>
    </header>
    <div class="container">
      <div class="row">
        <!-- Latest Posts -->
        <main class="post blog-post col-lg-8"> 
          <div class="container">
            <div class="post-single">
              <!-- <div class="post-thumbnail"><img src="img/blog-post-3.jpeg" alt="..." class="img-fluid"></div> -->
              <div class="post-details">

<?php 
  global $connection;
  $query = "SELECT * from posts where post_id = {$post_id}";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);
?>


                <!-- <div class="post-meta d-flex justify-content-between">
                  <div class="category"><a href="#">Business</a><a href="#">Financial</a></div>
                </div> -->
                <h1><?php echo $row["post_title"] ?><a href="#">
                <!-- <i class="fa fa-bookmark-o"></i> -->
                </a></h1>
                <div class="post-footer d-flex align-items-center flex-column flex-sm-row"><a href="#" class="author d-flex align-items-center flex-wrap">
                    <!-- <div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid"></div> -->
                    <div class="title"><span><?php echo $row["post_author"] ?></span></div></a>
                  <div class="d-flex align-items-center flex-wrap">       
                    <div class="date"><i class="icon-clock"></i> <?php echo $row["post_date"] ?></div>
                    <!-- <div class="views"><i class="icon-eye"></i> 500</div> -->
                    <div class="comments meta-last"><i class="icon-comment"></i><?php echo $row["post_comment_count"] ?></div>
                  </div>
                </div>
                <div class="post-body">
                  <p> <img src="images/<?php echo $row["post_image"] ?>" alt="..." class="img-fluid"></p>
                  <?php echo $row["post_content"] ?>
                <div class="post-tags">
                <?php
                  $tags = explode(",", $row["post_tags"]);
                  for ($i=0; $i < count($tags); $i++) { 
                    echo "<a href='#' class='tag'>#$tags[$i]</a>";
                  }
                ?>
                  
                </div>



                <!-- <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row"><a href="#" class="prev-post text-left d-flex align-items-center">
                    <div class="icon prev"><i class="fa fa-angle-left"></i></div>
                    <div class="text"><strong class="text-primary">Previous Post </strong>
                      <h6>I Bought a Wedding Dress.</h6>
                    </div></a><a href="#" class="next-post text-right d-flex align-items-center justify-content-end">
                    <div class="text"><strong class="text-primary">Next Post </strong>
                      <h6>I Bought a Wedding Dress.</h6>
                    </div>
                    <div class="icon next"><i class="fa fa-angle-right">   </i></div></a></div> -->

<?php
  $query = "SELECT post_comment_count from posts WHERE post_id = {$post_id}";
  $comments = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($comments);
  $comments = $row["post_comment_count"];
?>

                <div class="post-comments">
                  <header>
                    <h3 class="h6">Comments<span class="no-of-comments">(<?php echo $comments ?>)</span></h3>
                  </header>
<?php
    global $connection;  
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
                  <div class="comment">
                    <div class="comment-header d-flex justify-content-between">
                      <div class="user d-flex align-items-center">
                        <div class="image"><img src="img/user.svg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="title"><strong><?php echo $cmt_author ?></strong><span class="date"><?php echo $cmt_date ?></span></div>
                      </div>
                    </div>
                    <div class="comment-body">
                      <p><?php echo $cmt_content ?></p>
                    </div>
                  </div>
  <?php } ?>
                </div>


<!-- Create Comment -->

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

                <div class="add-comment">
                  <header>
                    <h3 class="h6">Leave a reply</h3>
                  </header>
                  <form method="post" action="" class="commenting-form">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <input type="text" name="cmt_author" id="cmt_author" placeholder="Name" class="form-control">
                      </div>
                      <div class="form-group col-md-6">
                        <input type="email" name="cmt_email" id="cmt_email" placeholder="Email Address (will not be published)" class="form-control">
                      </div>
                      <div class="form-group col-md-12">
                        <textarea name="cmt_content" id="cmt_content" placeholder="Type your comment" class="form-control"></textarea>
                      </div>
                      <div class="form-group col-md-12">
                        <button type="submit" name="create_comment" class="btn btn-secondary">Submit Comment</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </main>
        <aside class="col-lg-4">
          <?php include "includes/widgets.php" ?>
        </aside>
      </div>
    </div>
    <!-- Page Footer-->
   <?php include "includes/footer.php" ?>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/@fancyapps/fancybox/jquery.fancybox.min.js"></script>
    <script src="js/front.js"></script>
  </body>
</html>