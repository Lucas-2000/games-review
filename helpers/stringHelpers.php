<?php

class StringHelpers
{
  public function generateToken($length)
  {
    $characters = "abcdefghijklmnopqrstuvwxysABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $token = "";

    for ($i = 0; $i <= $length; $i++) {
      $randomIndex = mt_rand(0, strlen($characters) - 1);
      $token .= $characters[$randomIndex];
    }

    return $token;
  }

  public function generateSlug($name)
  {
    $slug = "";
    $array = explode(" ", strtolower(trim($name)));
    $count = count($array);

    for ($i = 0; $i < $count; $i++) {
      $slug .= $array[$i];
      if ($i < $count - 1) {
        $slug .= "-";
      }
    }

    return $slug;
  }
}