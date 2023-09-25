<?php
include_once("config/url.php");

session_start();

$user = "";
$username = "";
$role = "";

if (isset($_SESSION['user_token']) && !empty($_SESSION['user_token'])) {
  $user = $_SESSION['user_token'];
}

if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  $username = $_SESSION['username'];
}

if (isset($_SESSION['role']) && !empty($_SESSION['role'])) {
  $role = $_SESSION['role'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="styles/global.css">
  <title>Games Review</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="<?= $BASE_URL ?>">
        Games Review
      </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <?php if ($role === 'admin'): ?>
            <li class="nav-item">
              <a class="nav-link" href="">Incluir jogo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">Meus jogos</a>
            </li>
          <?php endif; ?>
          <?php if ($username): ?>
            <li class="nav-item">
              <span class="nav-link text-primary">
                <?= $username ?>
              </span>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <?php if ($user): ?>
              <a class="btn btn-danger" href="<?= $BASE_URL ?>/logout.php">Sair</a>
            <?php else: ?>
              <a class="btn btn-primary" href="<?= $BASE_URL ?>/login.php">Login</a>
            <?php endif; ?>
          </li>
        </ul>
      </div>
  </nav>