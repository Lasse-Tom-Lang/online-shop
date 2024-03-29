<?php
  include "functions/databaseHandler.php";
  include "functions/loadProducts.php";
  include "functions/User.php";

  error_reporting(E_ERROR | E_PARSE);

  $conn = logInToDatabase();

  session_start();

  checkConnection($conn);

  $user = getUserData($conn);

  if ($user->role != "admin") {
    header("Location: /");
    exit();
  }

  $items = getProducts($conn);

  mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
      <h2>Admin dashboard</h2>
      <h3>All products</h3>
      <section id="productList">
        <?php
          foreach (array_values($items) as $i => $value) {
            if ($i == 0) {
              continue;
            }
            echo "<a class='listItem'><span>" . $value->name . "</span></a>";
          }
        ?>
      </section>
      <a href="/addProduct.php" id="newProductLink">Add product</a>
    </main>
  </body>
</html>