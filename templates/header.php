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

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
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
  <style>
    body {
      padding-top: 70px;
      padding-bottom: 60px;
    }

    .footer {
      position: fixed;
      bottom: 0;
      width: 100%;
      background-color: #f8f9fa;
      text-align: center;
      padding: 10px 0;
    }

    .game-image {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .fixed-header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
    }

    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      list-style: none;
      padding: 0;
    }

    .pagination a,
    .pagination .current-page {
      text-decoration: none;
      color: #007BFF;
      background-color: #f8f9fa;
      padding: 5px 10px;
      margin: 5px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    .pagination a:hover {
      background-color: #007BFF;
      color: #fff;
    }

    .pagination .prev-next {
      font-weight: bold;
    }

    .pagination .prev {
      margin-right: 10px;
    }

    .pagination .next {
      margin-left: 10px;
    }
  </style>
  <title>Games Review</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-header">
    <div class="container">
      <a class="navbar-brand" href="<?= $BASE_URL ?>">
        Games Review
      </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <?php if ($role === 'admin'): ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= $BASE_URL ?>/new_game.php">Incluir jogo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= $BASE_URL ?>/my_games.php">Meus jogos</a>
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