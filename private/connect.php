<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "testing";
    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>