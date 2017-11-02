<?php

namespace Passkey\Bridge\Actions;

use Passkey\Bridge\Reservation;

class Create extends Action
{
  protected $root = 'CreateReservationRQ';

  public function reset()
  {
    // Add elements
    $this->addElement('Data', [
      'OTA_HotelResRQ' => [],
    ]);

    return $this;
  }

  public function setReservation(Reservation $reservation)
  {
    $this->xmlElements['Data']['OTA_HotelResRQ'] = $reservation->getParams();

    return $this;
  }
}
