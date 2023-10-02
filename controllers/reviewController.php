<?php

$currentDirectory = __DIR__;

require_once($currentDirectory . "/../config/connection.php");
require_once($currentDirectory . "/../repositories/reviewRepository.php");
require_once($currentDirectory . "/../models/review.php");

class ReviewController implements ReviewRepository
{
  private $conn;

  public function __construct(Connection $conn)
  {
    $this->conn = $conn;
  }

  public function create(Review $review)
  {
    $reviewDesc = $review->getReview();
    $grade = $review->getGrade();
    $userId = $review->getUserId();
    $gameId = $review->getGameId();

    $stmt = $this->conn->getConnection()->prepare("INSERT INTO reviews(review, grade, game_id, user_id) VALUES (:reviewDesc, :grade, :userId, :gameId)");

    $stmt->bindValue(':reviewDesc', $reviewDesc);
    $stmt->bindValue(':grade', $grade);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':gameId', $gameId);

    $stmt->execute();

    $this->conn->closeConnection();
  }

  public function findAll()
  {
    $reviews = [];

    $stmt = $this->conn->getConnection()->query("SELECT * FROM reviews");

    $data = $stmt->fetchAll();

    foreach ($data as $data) {
      $review = new Review();
      $review->setId($data['id']);
      $review->setReview($data['review']);
      $review->setGrade($data['grade']);
      $review->setUserId($data['user_id']);
      $review->setGameId($data['game_id']);

      $reviews[] = $review;
    }

    return $reviews;
  }

  public function findByGameId($gameId)
  {
    $stmt = $this->conn->getConnection()->prepare("SELECT * FROM reviews WHERE game_id = :gameId");

    $stmt->bindValue(':gameId', $gameId);

    $stmt->execute();

    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $reviews;
  }

  public function update(Review $review)
  {
    $id = $review->getId();
    $reviewDesc = $review->getReview();
    $grade = $review->getGrade();
    $userId = $review->getUserId();
    $gameId = $review->getGameId();

    $stmt = $this->conn->getConnection()->prepare("UPDATE reviews SET review = :review, grade = :grade, game_id = :gameId, user_id = :userId WHERE id = :id");

    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':review', $reviewDesc);
    $stmt->bindValue(':grade', $grade);
    $stmt->bindValue(':game_id', $gameId);
    $stmt->bindValue(':userId', $userId);

    $stmt->execute();

    $this->conn->closeConnection();
  }

  public function delete($id)
  {
    $stmt = $this->conn->getConnection()->prepare("DELETE FROM reviews WHERE id = :id");

    $stmt->bindValue(':id', $id);

    $stmt->execute();

    $this->conn->closeConnection();
  }
}