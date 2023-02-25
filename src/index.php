<?php
  include "functions/loadProducts.php";
  include "functions/databaseHandler.php";
  include "functions/User.php";

  error_reporting(E_ERROR | E_PARSE);

  session_start();

  $conn = logInToDatabase();

  checkConnection($conn);

  $items = getProducts($conn);

  $user = getUserData($conn);

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
    <nav>
      <h1><a href="/">Shop name</a></h1>
      <div id="loginInfos">
        <?php
          setUserInfos($user);
        ?>
      </div>
    </nav>
    <main>
      <h2>Our products</h2>
      <section id="product-section" aria-label="Products">
        <?php
          foreach (array_values($items) as $i => $value) {
            if ($i != 0) {
              renderProduct($value);
            }
          }
        ?>
      </section>
    </main>
    <footer>
      <h2>Shop name</h2>
      <div id="imprint">
        <h3>Imprint</h3>
      </div>
    </footer>
  </body>
</html>