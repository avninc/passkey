<?php

namespace Passkey\Common;

class Security
{
  protected $username;
  protected $password;
  protected $partnerId;

  public function __construct($username, $password, $partnerId) {
    $this->setUsername($username)
          ->setPassword($password)
          ->setPartnerId($partnerId);

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

  public function getUsername() {
    return $this->username;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getPartnerId() {
    return $this->partnerId;
  }
}
