<?php
  include "loadProducts.php";

  $servername = "192.168.178.36";
  $database = "db";
  $username = "root";
  $password = "12345678";
  $port = 3306;

  $conn = mysqli_connect($servername, $username, $password, $database, $port);

  if ($conn == false) {
    die();
  }
  if ($conn->connect_error) {
    die();
  }

  $items = array([]);

  $sql = file_get_contents('SQL/getShopItems.sql');

  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()) {
    array_push($items, new Product($row["Name"], $row["Price"], $row["Description"]));
  }

  mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
    <link rel="stylesheet" href="/style.css">
  </head>
  <body>
    <h1>Welcome</h1>
    <h2>Our products</h2>
    <section id="product-section" aria-label="Products">
      <?php
        foreach (array_values($items) as $i => $value) {
          if ($i != 0) {
            echo $value->renderProduct();
          }
        }
      ?>
    </section>
  </body>
</html>