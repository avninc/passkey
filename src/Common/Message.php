<?php

namespace Passkey\Common;

class Message
{
  protected $version = '4.00.02';
  protected $mode = 'S';
  protected $operation;
  protected $service;
  protected $locale = 'EN_US';

  public function __construct($operation, $service, $locale=null, $mode=null, $version=null) {
    $this->setOperation($operation)->setService($service);

    if ($locale!==null) {
      $this->setLocale($locale);
    }

    if ($mode!==null) {
      $this->setMode($mode);
    }

    if ($version!==null) {
      $this->setVersion($version);
    }

    return $this;
  }

  public function setOperation($operation)
  {
    $this->operation = $operation;

    return $this;
  }

  public function setMode($mode)
  {
    $this->mode = $mode;

    return $this;
  }

  public function setVersion($version)
  {
    $this->version = $version;

    return $this;
  }

  public function setService($service)
  {
    $this->service = $service;

    return $this;
  }

  public function setLocale($locale)
  {
    $this->locale = $locale;

    return $this;
  }

  public function getOperation()
  {
    return $this->operation;
  }

  public function getService()
  {
    return $this->service;
  }

  public function getMode()
  {
    return $this->mode;
  }

  public function getLocale()
  {
    return $this->locale;
  }

  public function getVersion()
  {
    return $this->version;
  }
}
