<?php

include_once("../config/connection.php");
include_once("../repositories/userRepository.php");
include_once("../models/user.php");
include_once("../helpers/stringHelpers.php");

class UserController implements UserRepository
{
  private $conn;

  public function __construct(Connection $conn)
  {
    $this->conn = $conn;
  }

  public function create(User $user)
  {
    $stringHelper = new StringHelpers();

    $username = $user->getUsername();
    $email = $user->getEmail();
    $password = $user->getPassword();
    $role = "default";
    $token = $stringHelper->generateToken(10);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $this->conn->getConnection()->prepare("INSERT INTO users(username, email, password, role, token) VALUES (:username, :email, :password, :role, :token)");

    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $hashedPassword);
    $stmt->bindValue(':role', $role);
    $stmt->bindValue(':token', $token);

    $stmt->execute();

    $this->conn->closeConnection();
  }

  public function findAll()
  {
    $users = [];

    $stmt = $this->conn->getConnection()->query("SELECT * FROM users");

    $data = $stmt->fetchAll();

    foreach ($data as $data) {
      $user = new User();
      $user->id = $data['id'];
      $user->username = $data['username'];
      $user->email = $data['email'];
      $user->password = $data['password'];
      $user->role = $data['role'];
      $user->token = $data['token'];

      $users = $user;
    }

    return $users;
  }

  public function findByUsername($username)
  {
    $stmt = $this->conn->getConnection()->prepare("SELECT * FROM users WHERE username = :username");

    $stmt->bindValue(':username', $username);

    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      return $user;
    } else {
      return null;
    }
  }

  public function findByToken($token)
  {
    $stmt = $this->conn->getConnection()->prepare("SELECT * FROM users WHERE token = :token");

    $stmt->bindValue(':token', $token);

    $user = $stmt->fetch();

    $this->conn->closeConnection();

    return $user;
  }

  public function findByUsernameAndPassword($username, $password)
  {
    $stmt = $this->conn->getConnection()->prepare("SELECT * FROM users WHERE username = :username");

    $stmt->bindValue(':username', $username);

    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->conn->closeConnection();

    if ($user) {
      $hashedPassword = $user['password'];
      if (password_verify($password, $hashedPassword)) {
        $_SESSION['user_token'] = $user['token'];
        return $user;
      }
    }

    return null;
  }

  public function findByUsernameOrEmail($username, $email)
  {
    $stmt = $this->conn->getConnection()->prepare("SELECT * FROM users WHERE username = :username OR email = :email");

    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email', $email);

    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      return $user;
    } else {
      return null;
    }
  }

  public function update(User $user)
  {
    $id = $user->getId();
    $username = $user->getUsername();
    $username = $user->getUsername();
    $email = $user->getEmail();
    $password = $user->getPassword();
    $role = $user->getRole();
    $token = $user->getToken();

    $stmt = $this->conn->getConnection()->prepare("UPDATE users SET username = :username, email = :email, password = :password, role = :role, token = :token WHERE id = :id");

    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->bindValue(':role', $role);
    $stmt->bindValue(':token', $token);

    $stmt->execute();

    $this->conn->closeConnection();
  }

  public function delete($id)
  {
    $stmt = $this->conn->getConnection()->prepare("DELETE FROM users WHERE id = :id");

    $stmt->bindValue(':id', $id);

    $stmt->execute();

    $this->conn->closeConnection();
  }
}