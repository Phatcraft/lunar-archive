<?php
    $env = parse_ini_file(__DIR__. "/.env");

    $database_hostname = $env["DB_HOST"];
    $database_user = $env["DB_USER"];
    $database_password = $env["DB_PASS"];
    $database = $env["DB"];

    try{
        $mysql = new mysqli($database_hostname, $database_user, $database_password, $database);
    }catch(mysqli_sql_exception){
        die("Server error. Please try again!");
    }
?>