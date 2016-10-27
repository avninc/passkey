<?php

namespace Passkey\Common;

class UniqueId
{
  protected $Type = 'RES';
  protected $Id;

  public function __construct($id, $Type=null) {
    $this->setId($id);

    if ($Type!==null) {
      $this->setType($Type);
    }

    return $this;
  }

  public function setId($id)
  {
    $this->Id = $id;

    return $this;
  }

  public function setType($type)
  {
    $this->Type = $type;

    return $this;
  }

  public function getId()
  {
    return $this->Id;
  }

  public function getType()
  {
    return $this->Type;
  }
}
