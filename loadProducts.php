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
?>