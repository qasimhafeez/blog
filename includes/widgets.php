<!-- Widget [Search Bar Widget]-->
<!-- <div class="widget search">
  <header>
    <h3 class="h6">Search the blog</h3>
  </header>
  <form action="#" class="search-form">
    <div class="form-group">
      <input type="search" placeholder="What are you looking for?">
      <button type="submit" class="submit"><i class="icon-search"></i></button>
    </div>
  </form>
</div> -->
<!-- Widget [Latest Posts Widget]        -->
<div class="widget latest-posts">
  <header>
    <h3 class="h6">Latest Posts</h3>
  </header>
  <div class="blog-posts">
  <?php 
  $query = "SELECT * from posts ORDER BY post_date DESC LIMIT 3";
  $result = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($result))
  {
    
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_comment_count = $row['post_comment_count'];

  ?>
    <a href="#">
      <div class="item d-flex align-items-center">
        <div class="image"><img src="img/small-thumbnail-3.jpg" alt="..." class="img-fluid"></div>
        <div class="title"><strong><?php echo $post_title ?></strong>
          <div class="d-flex align-items-center">
            <!-- <div class="views"><i class="icon-eye"></i> 500</div> -->
            <div class="comments"><i class="icon-comment"></i><?php echo $post_comment_count; ?></div>
          </div>
        </div>
      </div>
    </a>
  <?php } ?>
  </div>
</div>
<!-- Widget [Categories Widget]-->
<div class="widget categories">
  <header>
    <h3 class="h6">Categories</h3>
  </header>

  <?php
                    
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection, $query);
  
  ?>
<?php 
  while($row = mysqli_fetch_assoc($result))
  {       
      $cat_id = $row['cat_id'];
      $cat_title = $row['cat_title'];
      // echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
      echo "<div class='item d-flex justify-content-between'><a href='category.php?category={$cat_id}'>{$cat_title}</a></div>";
  }
?>
  
  <!-- <div class="item d-flex justify-content-between"><a href="#">Growth</a><span>12</span></div> -->

</div>
<!-- Widget [Tags Cloud Widget]-->
<!-- <div class="widget tags">       
  <header>
    <h3 class="h6">Tags</h3>
  </header>
  <ul class="list-inline">
    <li class="list-inline-item"><a href="#" class="tag">#Business</a></li>
    <li class="list-inline-item"><a href="#" class="tag">#Technology</a></li>
    <li class="list-inline-item"><a href="#" class="tag">#Fashion</a></li>
    <li class="list-inline-item"><a href="#" class="tag">#Sports</a></li>
    <li class="list-inline-item"><a href="#" class="tag">#Economy</a></li>
  </ul>
</div> -->