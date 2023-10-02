<?php

class Review
{
  private $id;
  private $review;
  private $grade;
  private $userId;
  private $gameId;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    return $this->id = $id;
  }

  public function getReview()
  {
    return $this->review;
  }

  public function setReview($review)
  {
    return $this->review = $review;
  }

  public function getGrade()
  {
    return $this->grade;
  }

  public function setGrade($grade)
  {
    return $this->grade = $grade;
  }

  public function getUserId()
  {
    return $this->userId;
  }

  public function setUserId($userId)
  {
    return $this->userId = $userId;
  }

  public function getGameId()
  {
    return $this->gameId;
  }

  public function setGameId($gameId)
  {
    return $this->gameId = $gameId;
  }
}