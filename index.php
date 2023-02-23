<?php
  include "loadProducts.php";
  $test = new Product("Test", 12, "Lorem ipsum dolor sit amet")
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
    <link rel="stylesheet" href="/style.css">
  </head>
  <body>
    <h1>Welcome</h1>
    <h2>Our products</h2>
    <section id="product-section" aria-label="Products">
      <?php
        $test->renderProduct();
        $test->renderProduct();
        $test->renderProduct();
        $test->renderProduct();
      ?>
    </section>
  </body>
</html>