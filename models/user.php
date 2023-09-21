<?php

class User
{
  private $id;
  private $username;
  private $email;
  private $password;
  private $role;
  private $token;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    return $this->id = $id;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function setUsername($username)
  {
    return $this->username = $username;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    return $this->email = $email;
  }
  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    return $this->password = $password;
  }
  public function getRole()
  {
    return $this->role;
  }

  public function setRole($role)
  {
    return $this->role = $role;
  }
  public function getToken()
  {
    return $this->token;
  }

  public function setToken($token)
  {
    return $this->token = $token;
  }
}