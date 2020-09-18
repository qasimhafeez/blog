<?php

// For more Security
function escape($string){
    global $connection;

    return mysqli_real_escape_string($connection, trim($string));
}

function confirmQuery($result)
{
    global $connection;
    
    if(!$result)
    {
        die("There is a problem in a Database ".mysqli_error($connection));
    }
}


function insertCategory()
{
    if(isset($_POST["submit"]))
    {
        global $connection;
        $cat_title = $_POST["cat_title"];
        if($cat_title == "" || empty($cat_title))
        {
            echo "Please fill this field!";
        }
        else
        {
            $query = "INSERT into categories(cat_title) ";
            $query .= "VALUE('{$cat_title}') ";

            $create_category = mysqli_query($connection, $query);

            if(!$create_category)
            {
                die("There is a problem with a database!".mysqli_error($connection));
            }
        }
    }

}


function findAllCategories()
{
    global $connection;
    $query = "SELECT * from categories";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result))
    {
        $cat_id = $row["cat_id"];
        $cat_title = $row["cat_title"];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "</tr>";
    }
}


function deleteCategory()
{
    global $connection;
    if(isset($_GET['delete']))
    {
        $delete_id = $_GET['delete'];

        $query = "DELETE from categories WHERE cat_id = {$delete_id}";

        $result = mysqli_query($connection, $query);

        header("Location: categories.php");
    }
}



?>