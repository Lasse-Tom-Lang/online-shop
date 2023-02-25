<?php
  class User {
    public string $name;
    public string $id;
    public array $cart = [];

    function __construct(string $name, string $id) {
      $this->name = $name;
      $this->id = $id;
    }

    function addItemToCart(Product $product) {
      array_push($this->cart, $product);
    }
  }

  function getUserData(mysqli $conn) {
    if (!isset($_SESSION["userID"])) {
      return null;
    }
    $userID = $_SESSION["userID"];
    $result = $conn->query("SELECT * FROM User WHERE ID = $userID");
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    return new User($rows[0]["name"], $userID);
  }

  function setUserInfos(User $user = null) {
    if (isset($user)) {
      echo "<a href='/profile.php'>$user->name</a>";
      echo "<a href='/logout.php' id='logout'>Logout</a>";
    }
    else {
      echo "<a href='/login.php'>Login</a>";
    }
  }
?>