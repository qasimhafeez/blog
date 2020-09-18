                            
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Edit Category</label>
                                    
                                    <?php
                                        
                                        if(isset($_GET['edit']))
                                        {
                                            $edit_id = $_GET["edit"];
                                            
                                            $query = "SELECT * from categories WHERE cat_id = $edit_id";
                                            $result = mysqli_query($connection, $query);
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                                $cat_id = $row["cat_id"];
                                                $cat_title = $row["cat_title"];
                                            ?>
                                            
                                            <input value="<?php if (isset($cat_title)){echo "$cat_title";} ?>" type="text" class="form-control" name="cat_title">
                                            
                                            
                                    <?php    }    
                                        }
                                          
                                    ?>
                                    
                                    <?php
                                        // ------------- Update Query --------//
                                    
                                        if(isset($_POST['update_category']))
                                        {
                                            $update_title = $_POST['cat_title'];

                                            $query = "UPDATE categories set cat_title = '{$update_title}' WHERE cat_id = {$cat_id}";

                                            $result = mysqli_query($connection, $query);
                                            if(!$result)
                                            {
                                                die("Problem in Database".mysqli_error($connection));
                                            }
                                        }
                                    ?>
                                    
                                    
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update_category" 
                                    value="Update Category"> 
                                </div>
                            </form>