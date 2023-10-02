<?php
$currentDirectory = __DIR__;

require_once($currentDirectory . "/../models/review.php");


interface ReviewRepository
{
  public function create(Review $review);
  public function findAll();
  public function findByGameId($gameId, $offset, $limit);
  public function calculateAverageRating($gameId);
  public function countReviews($gameId);
  public function update(Review $review);
  public function delete($id);
}