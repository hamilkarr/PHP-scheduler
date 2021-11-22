<?php
class DB extends PDO {
  public function __construct() {
    try {
      $dsn = "mysql:host=localhost;dbname=hamilkarr";
      $username = "hamilkarr";
      $password = "aA!13579";
      parent::__construct($dsn, $username, $password);
    } catch (PDOException $e) {
      throw $e;
    }
  }
}