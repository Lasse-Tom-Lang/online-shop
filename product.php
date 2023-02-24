<?php
    include "loadProducts.php";
    include "databaseHandler.php";
    error_reporting(E_ERROR | E_PARSE);

    $conn = logInToDatabase();

    if ($conn == false) {
      die("Can't access database");
    }
    if ($conn->connect_error) {
      die("Can't access database");
    }

    if ($_GET["productID"]) {
      $productID = $_GET["productID"];

      $sql = sprintf(file_get_contents('SQL/getShopItem.sql'), $productID);

      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $product = new Product($row["Name"], $row["Price"], $row["Description"], $row["ID"]);
    }

    mysqli_close($conn);
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
  </head>
  <body>
    <?php
      echo $product->name;
    ?>
  </body>
</html>