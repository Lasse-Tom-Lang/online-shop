<?php
  include "loadProducts.php";
  include "databaseHandler.php";
  include "User.php";

  error_reporting(E_ERROR | E_PARSE);

  $conn = logInToDatabase();

  session_start();

  checkConnection($conn);

  $product = getProduct($conn);

  $user = getUserData($conn);

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