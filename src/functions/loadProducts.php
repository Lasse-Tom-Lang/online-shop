<?php
  class Product {
    public string $name;
    public int $price;
    public string $description;
    public int $id;

    function __construct(string $name, int $price, string $description, int $id) {
      $this->name = $name;
      $this->price = $price;
      $this->description = $description;
      $this->id = $id;
    }
  }

  function renderProduct(Product $product) {
    echo "
      <div class='product'>
        <h3>$product->name</h3>
        <p>$product->description</p>
        <a href='/product.php?productID=$product->id'>Show more</a>
        <span>\$$product->price</span>
      </div>
    ";
  }

  function getProducts(mysqli $conn) {
    $items = array([]);
    $sql = file_get_contents('SQL/getShopItems.sql');
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
      array_push($items, new Product($row["Name"], $row["Price"], $row["Description"], $row["ID"]));
    }
    return $items;
  }

  function getProduct(mysqli $conn, int $id = null) {
    if ($_GET["productID"] || isset($id)) {
      $productID = $_GET["productID"];
      if (isset($id)) {
        $productID = $id;
      }

      $sql = sprintf(file_get_contents('SQL/getShopItem.sql'), $productID);

      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      return new Product($row["Name"], $row["Price"], $row["Description"], $row["ID"]);
    }
    return null;
  }
?>