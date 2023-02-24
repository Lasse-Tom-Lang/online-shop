<?php
  class User {
    public string $name;
    public string $id;

    function __construct(string $name, string $id) {
      $this->name = $name;
      $this->id = $id;
    }
  }
?>