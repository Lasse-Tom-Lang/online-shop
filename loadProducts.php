<?php
  class Product {
    public string $name;
    public int $price;
    public string $description;

    function __construct(string $name, int $price, string $description) {
      $this->name = $name;
      $this->price = $price;
      $this->description = $description;
    }

    function renderProduct() {
      echo "
        <div class='product'>
          <h3>$this->name</h3>
          <p>$this->description</p>
          <span>\$$this->price</span>
        </div>
      ";
    }
  }
?>