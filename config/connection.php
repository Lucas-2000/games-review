<?php

class Connection
{
  private $conn;

  public function __construct()
  {
    try {
      $this->conn = new PDO("mysql:dbname=games;host=localhost", "root", "");
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Erro de conexão: " . $e->getMessage();
    }
  }

  public function getConnection()
  {
    return $this->conn;
  }

  public function closeConnection()
  {
    $this->conn = null;
  }
}