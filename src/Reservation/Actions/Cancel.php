<?php

namespace Passkey\Reservation\Actions;

use Passkey\Reservation\Client;
use Passkey\Common\UniqueId;

class Cancel extends Client
{
  protected $root = 'CancelReservationRQ';

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
      'OTA_CancelRQ' => [
        'attributes' => [
          'CancelType' => null
        ],
        'value' => [],
      ],
    ]);
  }

  public function setUniqueId(UniqueId $UniqueId) {
    $this->xmlElements['Data']['OTA_CancelRQ']['value']['UniqueId'] = [
      'attributes' => [
        'Type' => $UniqueId->getType(),
        'Id' => $UniqueId->getId()
      ]
    ];
  }
}
