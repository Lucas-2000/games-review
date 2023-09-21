<?php

include_once("../models/user.php");

interface UserRepository
{
  public function create(User $user);
  public function findAll();
  public function findByUsername($username);
  public function findByToken($token);
  public function findByUsernameAndPassword($username, $password);
  public function findByUsernameOrEmail($username, $email);
  public function update(User $user);
  public function delete($id);
}