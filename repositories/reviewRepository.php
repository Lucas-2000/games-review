<?php
$currentDirectory = __DIR__;

require_once($currentDirectory . "/../models/review.php");


interface ReviewRepository
{
  public function create(Game $game);
  public function findAll();
  public function findByGameId($gameId);
  public function update(Game $game);
  public function delete($id);
}