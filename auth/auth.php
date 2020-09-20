<?php include "db.php"; ?>
<?php session_start(); ?>


<?php

    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        
        $query = "SELECT * from users WHERE user_name = '{$username}' "; //AND user_password = {$password} ";
        $result = mysqli_query($connection, $query);
        
        if(!$result)
        {
            die("Failed! ".mysqli_error($connection));
        }
        
        while($row = mysqli_fetch_assoc($result))
        {
            $u_id = $row["user_id"];
            $u_name = $row["user_name"];
            $u_password = $row["user_password"];
            $u_firstname = $row["user_firstname"];
            $u_lastname = $row["user_lastname"];
            $u_role = $row["user_role"];
        }
        
        // used to decrypt the password
        $password = crypt($password, $u_password);

        
        if($username === $u_name && $password === $u_password)
        {
             //This would tell that username "Example" is online, and it would assign the logged in username to //session['username']
            
            //$_SESSION['user_id'] = $u_id;
            $_SESSION['username'] = $u_name;
            $_SESSION['firstname'] = $u_firstname;
            $_SESSION['lastname'] = $u_lastname;
            $_SESSION['user_role'] = $u_role;
            
            header("Location: ../blog_admin_access/index.php");
        }
        else
        {
            header("Location: ../login.php ");
        }
        
        
    }
    else{
        header("Location: ../login.php");
    }

?>