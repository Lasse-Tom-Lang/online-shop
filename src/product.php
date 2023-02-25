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
          if (isset($user)) {
            echo $user->name;
          }
          else {
            echo "<a href='/login.php'>Login</a>";
          }
        ?>
      </div>
    </nav>
    <main>
      <?php
        echo $product->name;
      ?>
    </main>
    <footer>
      <h2>Shop name</h2>
      <div id="imprint">
        <h3>Imprint</h3>
      </div>
    </footer>
  </body>
</html>