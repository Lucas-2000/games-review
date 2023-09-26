<?php

class Game
{
  private $id;
  private $image;
  private $name;
  private $description;
  private $price;
  private $platforms;
  private $releaseDate;
  private $gameProducer;
  private $classification;
  private $slug;
  private $userId;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    return $this->id = $id;
  }

  public function getImage()
  {
    return $this->image;
  }

  public function setImage($image)
  {
    return $this->image = $image;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    return $this->name = $name;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($description)
  {
    return $this->description = $description;
  }

  public function getPrice()
  {
    return $this->price;
  }

  public function setPrice($price)
  {
    return $this->price = $price;
  }

  public function getPlatforms()
  {
    return $this->platforms;
  }

  public function setPlatforms($platforms)
  {
    return $this->platforms = $platforms;
  }

  public function getReleaseDate()
  {
    return $this->releaseDate;
  }

  public function setReleaseDate($releaseDate)
  {
    return $this->releaseDate = $releaseDate;
  }

  public function getGameProducer()
  {
    return $this->gameProducer;
  }

  public function setGameProducer($gameProducer)
  {
    return $this->gameProducer = $gameProducer;
  }

  public function getClassification()
  {
    return $this->classification;
  }

  public function setClassification($classification)
  {
    return $this->classification = $classification;
  }

  public function getUserId()
  {
    return $this->userId;
  }

  public function setUserId($userId)
  {
    return $this->userId = $userId;
  }
  public function getSlug()
  {
    return $this->slug;
  }

  public function setSlug($slug)
  {
    return $this->slug = $slug;
  }
}