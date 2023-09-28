<?php
$currentDirectory = __DIR__;

require_once($currentDirectory . "/../models/game.php");


interface GameRepository
{
  public function create(Game $game);
  public function findAll();
  public function findBySlug($slug);
  public function update(Game $game);
  public function delete($id);
}