<?php

session_start();

include_once("../config/connection.php");
include_once("../models/user.php");
include_once("../controllers/userController.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new Connection();

$userController = new UserController($conn);

$data = $_POST;

$errors = array();

if ($data['type'] == 'register') {
  $username = $data['username'];
  $email = $data['email'];
  $password = $data['password'];
  $rePassword = $data['rePassword'];

  $user = new User();

  $user->setUsername($username);
  $user->setEmail($email);
  $user->setPassword($password);

  if (empty($data['username'])) {
    $errors[] = "Username é obrigatório.";
  }

  if (empty($data['email'])) {
    $errors[] = "Email é obrigatório.";
  } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email inválido.";
  }

  if (empty($data['password'])) {
    $errors[] = "Senha é obrigatória.";
  }

  if (empty($data['rePassword'])) {
    $errors[] = "Redigitar a senha é obrigatório.";
  }

  if ($data['password'] !== $data['rePassword']) {
    $errors[] = "As senhas não coincidem.";
  }

  if (strlen($data['password']) < 7) {
    $errors[] = "A senha precisa ter mais de 7 digitos.";
  }

  if (empty($errors)) {
    if ($userController->findByUsernameOrEmail($username, $email) === null) {
      session_start();
      $userController->create($user);
      $_SESSION['msg'] = "Cadastro realizado com sucesso.";
      header("Location: ../login.php");
    } else {
      session_start();
      $errors[] = "Username ou login estão em uso.";
      $_SESSION['errors'] = $errors;
      header("Location: ../register.php");
      exit();
    }
  } else {
    if (!empty($errors)) {
      session_start();
      $_SESSION['errors'] = $errors;
      header("Location: ../register.php");
      exit();
    }
  }
} else if ($data['type'] == 'login') {
  $username = $data['username'];
  $password = $data['password'];

  if (empty($username)) {
    $errors[] = "Username é obrigatório.";
  }

  if (empty($password)) {
    $errors[] = "Senha é obrigatória.";
  }

  if (empty($errors)) {
    $user = $userController->findByUsernameAndPassword($username, $password);
    if ($user !== null) {
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['role'] = $user['role'];
      $_SESSION['user_id'] = $user['id'];
      header("Location: ../index.php");
      exit();
    } else {
      $errors[] = "Credenciais inválidas.";
    }
  }

  if (!empty($errors)) {
    session_start();
    $_SESSION['errors'] = $errors;
    header("Location: ../login.php");
    exit();
  }
}