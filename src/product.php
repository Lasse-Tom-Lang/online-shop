<?php
  include "functions/loadProducts.php";
  include "functions/databaseHandler.php";
  include "functions/User.php";

  error_reporting(E_ERROR | E_PARSE);

  $conn = logInToDatabase();

  session_start();

  checkConnection($conn);

  $product = getProduct($conn);

  $user = getUserData($conn);

  if (isset($_POST["addToCart"]) && isset($user) && isset($product)) {
    $conn->query("INSERT INTO CartItem VALUES(\"" . $product->id . "\", \"" . $user->id . "\")");
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
    <link rel="stylesheet" href="/style.css">
  </head>
  <body>
    <nav>
      <h1><a href="/">Shop name</a></h1>
      <div id="loginInfos">
        <?php
          setUserInfos($user);
        ?>
      </div>
    </nav>
    <main>
      <div id="productFlex">
        <div>
          <h2>
            <?php
              if (isset($product)) {
                echo $product->name;
              }
              else {
                echo "Product not found";
              }
            ?>
          </h2>
          <p id="productDescription">
            <?php
              echo $product->description;
            ?>
          </p>
        </div>
        <span id="productPrice">
          <?php
            echo "$" . $product->price;
          ?>
        </span>
      </div>
      <form method="POST">
        <input type="submit" value="Add to cart" name="addToCart">
      </form>
    </main>
    <footer>
      <h2>Shop name</h2>
      <div id="imprint">
        <h3>Imprint</h3>
      </div>
    </footer>
  </body>
</html>