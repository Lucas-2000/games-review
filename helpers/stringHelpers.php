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
}