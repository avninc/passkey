<?php

namespace Passkey\Bridge\Actions;

use Passkey\Common\UniqueId;

class Get extends Action
{
  protected $root = 'GetReservationRQ';

  protected $showACKInfo;
  protected $showResNotes;
  protected $showCCInfo;

  public function reset()
  {
    // Add elements
    $this->addElement('Data', [
      'OTA_ReadRQ' => [],
    ]);

    return $this;
  }

  public function setUniqueId(UniqueId $UniqueId) {
    $this->xmlElements['Data']['OTA_ReadRQ']['UniqueId'] = [
      'attributes' => [
        'Type' => $UniqueId->getType(),
        'Id' => $UniqueId->getId()
      ]
    ];

    return $this;
  }

  public function setShowAckInfo($value)
  {
    $this->showAckInfo = $value;
    $this->xmlElements['Data']['ShowAckInfo'] = $value;

    return $this;
  }

  public function setShowResNotes($value)
  {
    $this->showResNotes = $value;
    $this->xmlElements['Data']['ShowResNotes'] = $value;

    return $this;
  }

  public function setShowCCInfo($value)
  {
    $this->showCCInfo = $value;
    $this->xmlElements['Data']['ShowCCInfo'] = $value;

    return $this;
  }

  protected function fixData() {
    if(isset($this->xmlElements['Data']) && isset($this->xmlElements['Data']['OTA_ReadRQ'])) {
      $this->xmlElements['Data']['OTA_ReadRQ'] = $this->setDataNamespace($this->xmlElements['Data']['OTA_ReadRQ']);
    }
  }
}
