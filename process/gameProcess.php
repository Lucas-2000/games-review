<?php

require_once("../config/connection.php");
require_once("../models/game.php");
require_once("../controllers/gameController.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new Connection();

$gameController = new GameController($conn);

$data = $_POST;

$errors = array();

$platformsString = "";
$selectedClassification = "";

if ($data['type'] == 'create-game') {
  $image = $data['image'];
  $name = $data['name'];
  $description = $data['description'];
  $price = $data['price'];
  $platforms = $data['platforms'];
  $releaseDate = $data['release-date'];
  $gameProducer = $data['game-producer'];
  $classification = $data['classification'];
  $userId = $data['user-id'];

  if (!empty($platforms)) {
    $platformsString = implode(', ', $platforms);

    $platformsString = rtrim($platformsString, ', ');
  }

  if (isset($data['classification'])) {
    $selectedClassification = $data['classification'];
  }

  $game = new Game();

  $game->setImage($image);
  $game->setName($name);
  $game->setDescription($description);
  $game->setPrice($price);
  $game->setPlatforms($platformsString);
  $game->setReleaseDate($releaseDate);
  $game->setGameProducer($gameProducer);
  $game->setClassification($selectedClassification);
  $game->setUserId($userId);

  if (empty($data['image'])) {
    $errors[] = "Imagem Url é obrigatório.";
  }

  if (empty($data['name'])) {
    $errors[] = "Nome é obrigatório.";
  }

  if (empty($data['description'])) {
    $errors[] = "Descrição é obrigatória.";
  }

  if (empty($data['price'])) {
    $errors[] = "Price é obrigatório.";
  }

  if (empty($data['platforms'])) {
    $errors[] = "Plataformas é obrigatório.";
  }

  if (empty($data['release-date'])) {
    $errors[] = "Data de lançamento é obrigatório.";
  }

  if (empty($data['game-producer'])) {
    $errors[] = "Produtor é obrigatório.";
  }

  if (empty($data['classification'])) {
    $errors[] = "Faixa etária é obrigatório.";
  }

  if (empty($data['user-id'])) {
    $errors[] = "Usuário é obrigatório.";
  }

  if (empty($errors)) {
    session_start();
    $gameController->create($game);
    $_SESSION['msg'] = "Cadastro realizado com sucesso.";
    header("Location: ../index.php");
  } else {
    if (!empty($errors)) {
      session_start();
      $_SESSION['errors'] = $errors;
      header("Location: ../new_game.php");
      exit();
    }
  }
}