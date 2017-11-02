<?php

namespace Passkey\Bridge\Actions;

use Passkey\Common\UniqueId;

class Cancel extends Action
{
  protected $root = 'CancelReservationRQ';

  public function reset()
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

    return $this;
  }

  public function setUniqueId(UniqueId $UniqueId) {
    $this->xmlElements['Data']['OTA_CancelRQ']['value']['UniqueId'] = [
      'attributes' => [
        'Type' => $UniqueId->getType(),
        'Id' => $UniqueId->getId()
      ]
    ];

    return $this;
  }
}
