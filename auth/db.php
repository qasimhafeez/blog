<?php

//This is the more secure way to make a connection with a database

$db['db_host'] = "localhost";
$db['db_users'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "teaching_blog";

foreach($db as $key => $value)
{
    define(strtoupper($key), $value);
}

    
$connection = mysqli_connect(DB_HOST, DB_USERS, DB_PASS, DB_NAME);

?>