<?php include "includes/admin_header.php"?>
    <div id="wrapper">

        <!-- Navigation -->

       <?php include "includes/admin_navigation.php" ?> 
       
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin Panel
                            
                            <!--This username is comming form the login.php page-->
                            <small><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></small>
                        </h1>
                </div>
                <!-- /.row -->

                       
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    
                                    <?php 
                                        $query = "SELECT * from posts";
                                        $get_all_posts = mysqli_query($connection, $query);
                                        
                                        // this function will count every row so we would get the number of posts
                                        $post_count = mysqli_num_rows($get_all_posts);
                                        
                                    ?>
                                    
                                  <div class='huge'><?php echo $post_count; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    
                                    <?php
                                        $query = "SELECT * from comments";
                                        $get_all_comments = mysqli_query($connection, $query);
                                        
                                        $cmts_count = mysqli_num_rows($get_all_comments);
                                    ?>
                                    
                                     <div class='huge'><?php echo $cmts_count; ?></div>
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    
                                    <?php
                                        $query = "SELECT * from users";
                                        $get_all_users = mysqli_query($connection, $query);
                                        
                                        $users_count = mysqli_num_rows($get_all_users);
                                    ?>
                                    
                                    <div class='huge'><?php echo $users_count; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                       
                                       <?php
                                            $query = "SELECT * from categories";
                                            $get_all_categories = mysqli_query($connection, $query);

                                            $cat_count = mysqli_num_rows($get_all_categories);
                                        ?>
                                        <div class='huge'><?php echo $cat_count; ?></div>
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                                <!-- /.row -->
               
                  
                    <?php
                        // for published posts
                        $query = "SELECT * from posts WHERE post_status = 'published' ";
                        $get_all_published = mysqli_query($connection, $query);
                        $published_count = mysqli_num_rows($get_all_published);
                        
                        // for draft posts
                        $query = "SELECT * from posts WHERE post_status = 'draft' ";
                        $get_all_drafts = mysqli_query($connection, $query);
                        $draft_count = mysqli_num_rows($get_all_drafts);
                    
                        // for Approved comments
                        $query = "SELECT * from comments WHERE cmt_status = 'approved' ";
                        $get_approved_cmts = mysqli_query($connection, $query);
                        $approved_cmts_count = mysqli_num_rows($get_approved_cmts);
                    
                        // for Unapproved comments
                        $query = "SELECT * from comments WHERE cmt_status = 'unapproved' ";
                        $get_unapproved_cmts = mysqli_query($connection, $query);
                        $unapproved_cmts_count = mysqli_num_rows($get_unapproved_cmts);
                    
                        // for Subscribers
                        $query = "SELECT * from users WHERE user_role = 'subscriber' ";
                        $get_all_subscriber = mysqli_query($connection, $query);
                        $subs_count = mysqli_num_rows($get_all_subscriber);
                    ?>   
                    
                 <div class="row">
                    
                    <!-- Now we are using google charts so that we can display charts on dashboard
                         to check that how many posts, comments and other stuff we have and what we
                         need to perform or check, this chart would definitly help us ... and we got 
                         this code snippet from the google charts 
                     -->
                    
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['bar']});
                      google.charts.setOnLoadCallback(drawChart);

                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                          ['Date', 'Count'],
                            
                          <?php
                            
                                // Now we would make it identical to -A- down bellow so that we can 
                                // display data dynamically with google charts that how many posts etc etc we have
                                
                                $texts = ["All Posts", "Active Posts", "Draft Posts", "All Comments", "Approved Comments" ,"UnApproved Comments", "Users", "Subscribers", "Categories"];
                                $counts = [$post_count, $published_count, $draft_count, $cmts_count, 
                                           $approved_cmts_count, $unapproved_cmts_count, $users_count, $subs_count, $cat_count];
                                
                            
                                //We would loop through it to make it identical to -A- down bellow
                            
                                for($i = 0; $i < 7; $i++)
                                {
                                    echo "['{$texts[$i]}'" . ", " . "{$counts[$i]}],";
                                }
                            
                                //['posts', 5], --------- A ---------
                                
                           ?>
                        ]);

                        var options = {
                          chart: {
                            title: '',
                            subtitle: '',
                          }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                      }
                    </script>
                    
                    <div class="col-md-6 col-lg-12" id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                    
                </div>
           
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>