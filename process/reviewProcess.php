<?php

require_once("../config/connection.php");
require_once("../models/review.php");
require_once("../controllers/reviewController.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new Connection();

$reviewController = new ReviewController($conn);

$data = $_POST;

$errors = array();

if ($data['type'] == 'create-review') {
  $slug = $data['slug'];
  $reviewDesc = $data['review'];
  $grade = $data['grade'];
  $userId = $data['user-id'];
  $gameId = $data['game-id'];

  $review = new Review();

  $review->setReview($reviewDesc);
  $review->setGrade($grade);
  $review->setUserId($userId);
  $review->setGameId($gameId);

  if (empty($data['review'])) {
    $errors[] = "Avaliação é obrigatório.";
  }

  if (strlen($data['review']) > 500) {
    $errors[] = "Total de caracteres precisa ser menor ou igual 500.";
  }

  if (empty($data['grade'])) {
    $errors[] = "Nota é obrigatório.";
  }

  if ($grade < 0 || $grade > 100) {
    $errors[] = "Nota precisa ser entre 0 e 100.";
  }

  if (empty($data['game-id'])) {
    $errors[] = "Jogo é obrigatório.";
  }

  if (empty($data['user-id'])) {
    $errors[] = "Usuário é obrigatório.";
  }

  if (empty($errors)) {
    session_start();
    $reviewController->create($review);
    $_SESSION['msg'] = "Avaliação criada com sucesso.";
    header("Location: ../game.php?slug=" . $slug);
  } else {
    if (!empty($errors)) {
      session_start();
      $_SESSION['errors'] = $errors;
      header("Location: ../game.php?slug=" . $slug);
      exit();
    }
  }
}