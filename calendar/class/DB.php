<?php
class DB extends PDO {
  public function __construct() {
    try {
      $dsn = "mysql:host=localhost;dbname=xxxxxx";
      $username = "xxxxxx";
      $password = "xxxxxx";
      parent::__construct($dsn, $username, $password);
    } catch (PDOException $e) {
      throw $e;
    }
  }
}
