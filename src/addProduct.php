<?php
  include "functions/databaseHandler.php";
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

  $productAdded = false;

  if (isset($_POST["newProductName"]) && $_POST["newProductName"] != "" && isset($_POST["newProductDescription"]) && $_POST["newProductDescription"] != "" && isset($_POST["newProductPrice"])&& $_POST["newProductPrice"] != "") {
    $newProductName = str_replace("<", "&lt;", $_POST["newProductName"]);
    $newProductName = str_replace(">", "&gt;", $newProductName);
    $newProductDescription = str_replace("<", "&lt;", $_POST["newProductDescription"]);
    $newProductDescription = str_replace(">", "&gt;", $newProductDescription);
    $sql = sprintf(file_get_contents('SQL/createShopItem.sql'), crc32(uniqid()), $newProductName, $newProductDescription, $_POST["newProductPrice"]);
    $result = $conn->query($sql);
    $productAdded = true;
  }

  mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
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
      <?php
        if ($productAdded) {
          echo "Product was added";
        }
      ?>
      <h2>Add product</h2>
      <form id="newProductForm" method="post">
        <input type="text" name="newProductName" placeholder="Name">
        <input type="text" name="newProductDescription" placeholder="Description">
        <input type="number" name="newProductPrice" placeholder="Price">
        <input type="submit" value="Save">
      </form>
    </main>
  </body>
</html>