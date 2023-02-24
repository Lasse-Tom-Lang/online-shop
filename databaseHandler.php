<?php
  function logInToDatabase() {
    $servername = "192.168.178.36";
    $database = "db";
    $username = "root";
    $password = "12345678";
    $port = 3306;

    return mysqli_connect($servername, $username, $password, $database, $port);
  }
?>