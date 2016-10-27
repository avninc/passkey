<?php

namespace Passkey\Reservation\Actions;

use Passkey\Reservation\Client;

class Status extends Client
{
  protected $root = 'GetStatusRQ';
  protected $encodeData = false;

  /**
   * Constructor.
   *
   * @param string               $wsdl    WSDL file
   * @param array(string=>mixed) $options Options array
   */
  public function __construct($wsdl=null, array $options = [], bool $isDebug=false)
  {
      parent::__construct($wsdl, $options, $isDebug);

      $this->resetXml();
  }

  public function resetXml()
  {
    // Add elements
    $this->addElement('Data', [
      'GUID' => []
    ]);
  }

  public function setGuid($id) {
    $this->xmlElements['Data']['GUID'] = $id;
  }
}
