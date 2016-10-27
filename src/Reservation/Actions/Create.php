<?php

namespace Passkey\Reservation\Actions;

use Passkey\Reservation\Client;
use Passkey\Common\Reservation;

class Create extends Client
{
  protected $root = 'CreateReservationRQ';

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
      'OTA_HotelResRQ' => [],
    ]);
  }

  public function setReservation(Reservation $reservation)
  {
    $this->xmlElements['Data']['OTA_HotelResRQ'] = $reservation->getParams();
  }
}
