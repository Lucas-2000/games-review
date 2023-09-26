<?php

include_once("config/connection.php");
include_once("repositories/gameRepository.php");
include_once("models/game.php");
include_once("helpers/stringHelpers.php");

class GameController implements GameRepository
{
  private $conn;

  public function __construct(Connection $conn)
  {
    $this->conn = $conn;
  }

  public function create(Game $game)
  {
    $stringHelper = new StringHelpers();

    $image = $game->getImage();
    $name = $game->getName();
    $description = $game->getDescription();
    $price = $game->getPrice();
    $platforms = $game->getPlatforms();
    $releaseDate = $game->getReleaseDate();
    $gameProducer = $game->getGameProducer();
    $classification = $game->getClassification();
    $slug = $stringHelper->generateSlug($name);
    $userId = $game->getUserId();

    $stmt = $this->conn->getConnection()->prepare("INSERT INTO game(image, name, description, price, platforms, release_date, game_producer, classification, user_id, slug) VALUES (:image, :name, :description, :price, :platforms, :releaseDate, :gameProducer, :classification, :userId, :slug)");

    $stmt->bindValue(':image', $image);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':platforms', $platforms);
    $stmt->bindValue(':releaseDate', $releaseDate);
    $stmt->bindValue(':gameProducer', $gameProducer);
    $stmt->bindValue(':classification', $classification);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':slug', $slug);

    $stmt->execute();

    $this->conn->closeConnection();
  }

  public function findAll()
  {
    $games = [];

    $stmt = $this->conn->getConnection()->query("SELECT * FROM games");

    $data = $stmt->fetchAll();

    foreach ($data as $data) {
      $game = new Game();
      $game->setId($data['id']);
      $game->setImage($data['image']);
      $game->setName($data['name']);
      $game->setDescription($data['description']);
      $game->setPrice($data['price']);
      $game->setPlatforms($data['platforms']);
      $game->setReleaseDate($data['release_date']);
      $game->setGameProducer($data['game_producer']);
      $game->setClassification($data['classification']);
      $game->setSlug($data['slug']);
      $game->setUserId($data['user_id']);

      $games[] = $game;
    }

    return $games;
  }

  public function findBySlug($slug)
  {
    $stmt = $this->conn->getConnection()->prepare("SELECT * FROM games WHERE slug LIKE :slug");

    $slug = '%' . $slug . '%';

    $stmt->bindValue(':slug', $slug);

    $stmt->execute();

    $game = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($game) {
      return $game;
    } else {
      return null;
    }
  }

  public function update(Game $game)
  {
    $stringHelper = new StringHelpers();

    $id = $game->getId();
    $image = $game->getImage();
    $name = $game->getName();
    $description = $game->getDescription();
    $price = $game->getPrice();
    $platforms = $game->getPlatforms();
    $releaseDate = $game->getReleaseDate();
    $gameProducer = $game->getGameProducer();
    $classification = $game->getClassification();
    $slug = $stringHelper->generateSlug($name);
    $userId = $game->getUserId();

    $stmt = $this->conn->getConnection()->prepare("UPDATE games SET image = :image, name = :name, description = :description, price = :price, platforms = :platforms, releaseDate = :releaseDate, gameProducer = :gameProducer, classification = :classification, userId = :userId, slug = :slug WHERE id = :id");

    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':image', $image);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':platforms', $platforms);
    $stmt->bindValue(':releaseDate', $releaseDate);
    $stmt->bindValue(':gameProducer', $gameProducer);
    $stmt->bindValue(':classification', $classification);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':slug', $slug);

    $stmt->execute();

    $this->conn->closeConnection();
  }

  public function delete($id)
  {
    $stmt = $this->conn->getConnection()->prepare("DELETE FROM games WHERE id = :id");

    $stmt->bindValue(':id', $id);

    $stmt->execute();

    $this->conn->closeConnection();
  }
}