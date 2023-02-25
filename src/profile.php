<?php
  include "functions/databaseHandler.php";
  include "functions/User.php";
  include "functions/loadProducts.php";
  include "functions/ShoppingCart.php";

  error_reporting(E_ERROR | E_PARSE);

  session_start();

  $conn = logInToDatabase();

  checkConnection($conn);

  $user = getUserData($conn);

  if (!isset($user)) {
    header("Location: /");
    exit();
  }

  getCartItems($conn, $user);

  mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="/style.css">
  </head>
  <body>
    <nav>
      <h1><a href="/">Shop name</a></h1>
    </nav>
    <main>
      <h2>Welcome <?php echo $user->name; ?></h2>
      <h2>Cart</h2>
      <section aria-label="Cart" id="shoppingCart">
        <?php
          printShoppingCart($user);
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