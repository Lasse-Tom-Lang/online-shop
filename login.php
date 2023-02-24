<?php
  include "databaseHandler.php";

  session_start();

  if (isset($_SESSION["userID"])) {
    header('Location: /');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/style.css">
  </head>
  <body>
    <form method="POST" id="loginForm">
      <h1>Login</h1>
      <input type="text" placeholder="Username" name="username">
      <input type="password" placeholder="Password" name="password">
      <button>Login</button>
      <p>
        <?php
          if (isset($_POST["username"]) && isset($_POST["password"])) {
            $conn = logInToDatabase();
            checkConnection($conn);
            $username = $_POST["username"];
            $password = hash("sha256", $_POST["password"]);
            $result = $conn->query("SELECT * FROM User WHERE name = '$username' AND password = '$password'");
            if ($result == false) {
              die("Login failed");
            }
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if (!isset($rows[0])) {
              die("Login failed");
            }
            $_SESSION["userID"] = $rows[0]["ID"];
            echo "<script>window.location='/'</script>";
          }
        ?>
      </p>
    </form>
  </body>
</html>