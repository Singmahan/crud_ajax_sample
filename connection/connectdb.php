<?php 
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $databasename = 'crud_ajax_sample';

    date_default_timezone_set('Asia/Bangkok');
    $condb = mysqli_connect($hostname,$username,$password,$databasename);
    mysqli_set_charset($condb, "utf8");

    if(mysqli_connect_errno()){
        echo "No Connection ! :" .mysqli_connect_error();
    }
?>