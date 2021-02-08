<?php
    require_once('TableDB.php');

    $server = 'localhost';
    $login  = 'root';
    $password = '123';
    $nameDatabase = 'newdb';

    $connect = new CTable($server,$login,$password,$nameDatabase);
    $connect->connectDB();
?>