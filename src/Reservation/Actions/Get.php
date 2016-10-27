<?php

namespace Passkey\Reservation\Actions;

use Passkey\Reservation\Client;
use Passkey\Common\UniqueId;

class Get extends Client
{
  protected $root = 'GetReservationRQ';

  protected $showACKInfo;
  protected $showResNotes;
  protected $showCCInfo;

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
      'OTA_ReadRQ' => [],
    ]);
  }

  public function setUniqueId(UniqueId $UniqueId) {
    $this->xmlElements['Data']['OTA_ReadRQ']['UniqueId'] = [
      'attributes' => [
        'Type' => $UniqueId->getType(),
        'Id' => $UniqueId->getId()
      ]
    ];
  }

  public function setShowAckInfo($value)
  {
    $this->showAckInfo = $value;
    $this->xmlElements['Data']['ShowAckInfo'] = $value;
  }

  public function setShowResNotes($value)
  {
    $this->showResNotes = $value;
    $this->xmlElements['Data']['ShowResNotes'] = $value;
  }

  public function setShowCCInfo($value)
  {
    $this->showCCInfo = $value;
    $this->xmlElements['Data']['ShowCCInfo'] = $value;
  }

  protected function fixData() {
    if(isset($this->xmlElements['Data']) && isset($this->xmlElements['Data']['OTA_ReadRQ'])) {
      $this->xmlElements['Data']['OTA_ReadRQ'] = $this->setDataNamespace($this->xmlElements['Data']['OTA_ReadRQ']);
    }
  }
}
