<?php

class Connection
{
  private $conn;

  public function __construct()
  {
    $this->conn = new PDO("mysql:dbname=games;host=localhost", "root", "");
  }

  public function closeConnection()
  {
    $this->conn = null;
  }
}