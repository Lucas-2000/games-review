<?php

include_once("models/game.php");

interface GameRepository
{
  public function create(Game $game);
  public function findAll();
  public function findBySlug($slug);
  public function update(Game $game);
  public function delete($id);
}