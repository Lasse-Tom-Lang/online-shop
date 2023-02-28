<?php
  class User {
    public string $name;
    public string $id;
    public array $cart = [];
    public string $role;

    function __construct(string $name, string $id, string $role) {
      $this->name = $name;
      $this->id = $id;
      $this->role = $role;
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
    return new User($rows[0]["name"], $userID, $rows[0]["role"]);
  }

  function setUserInfos(User $user = null) {
    if (isset($user)) {
      if ($user->role == "user") {
        echo "<a href='/profile.php'>$user->name</a>";
      }
      else if ($user->role == "admin") {
        echo "<a href='/admin.php'>$user->name</a>";
      }
      echo "<a href='/logout.php' id='logout'>Logout</a>";
    }
    else {
      echo "<a href='/login.php'>Login</a>";
    }
  }
?>