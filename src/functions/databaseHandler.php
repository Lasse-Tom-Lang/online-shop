<?php
  function logInToDatabase() {
    $servername = "192.168.43.131";
    $database = "db";
    $username = "root";
    $password = "12345678";
    $port = 3306;

    return mysqli_connect($servername, $username, $password, $database, $port);
  }

  function checkConnection(mysqli | bool $conn) {
    if ($conn == false) {
      die("Can't access database");
    }
    if ($conn->connect_error) {
      die("Can't access database");
    }
  }
?>