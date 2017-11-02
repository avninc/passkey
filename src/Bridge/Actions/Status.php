<?php

namespace Passkey\Bridge\Actions;

class Status extends Action
{
  protected $root = 'GetStatusRQ';
  protected $encodeData = false;

  public function reset()
  {
    // Add elements
    $this->addElement('Data', [
      'GUID' => []
    ]);

    return $this;
  }

  public function setGuid($id) {
    $this->xmlElements['Data']['GUID'] = $id;

    return $this;
  }
}
