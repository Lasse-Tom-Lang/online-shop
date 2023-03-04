<?php
  function getCartItems(mysqli $conn, User $user) {
    $result = $conn->query("SELECT * FROM CartItem WHERE userID = '$user->id'");
    while($row = $result->fetch_assoc()) {
      $product = getProduct($conn, $row["productID"]);
      if (isset($product)) {
        $user->addItemToCart($product);
      }
    }
  }
  function printShoppingCart(User $user) {
    $totalPrice = 0;
    for ($i = 0; $i < sizeof($user->cart); $i++) {
      $price = $user->cart[$i]->price;
      $name = $user->cart[$i]->name;
      $id = $user->cart[$i]->id;
      $totalPrice += $price;
      echo "
        <div class='cartItem'>
          <a href='/product.php?productID=$id'><h3>$name</h3></a>
          <span>\$$price</span>
        </div>
      ";
    }
    return $totalPrice;
  }
?>