<?php 

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db   = 'auth';

    $con = new mysqli($host, $user, $pass, $db);


    if ($con->connect_error) {
        die("فشل الاتصال: " . $con->connect_error);
    }

    $con->set_charset("utf8mb4");

?>