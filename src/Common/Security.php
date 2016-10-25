<?php

namespace Passkey\Common;

class Security
{
  protected $username;
  protected $password;
  protected $partnerId;
  protected $token;

  public function __construct($username, $password, $partnerId, $token=' ') {
    $this->setUsername($username)
          ->setPassword($password)
          ->setPartnerId($partnerId)
          ->setToken($token);

    return $this;
  }

  public function setUsername($username)
  {
    $this->username = $username;

    return $this;
  }

  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }

  public function setPartnerId($partnerId)
  {
    $this->partnerId = $partnerId;

    return $this;
  }

  public function setToken($token)
  {
    $this->token = $token;

    return $this;
  }

  public function getUsername() {
    return $this->username;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getPartnerId() {
    return $this->partnerId;
  }

  public function getToken() {
    return $this->token;
  }
}
