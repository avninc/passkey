<?php

namespace Passkey\Reservation\Actions;

use Passkey\Reservation\Reservation;

class Create extends Action
{
  protected $root = 'CreateReservationRQ';

  public function reset()
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
