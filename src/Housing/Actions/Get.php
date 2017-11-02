<?php

namespace Passkey\Bridge\Actions;

use DateTime;
use Passkey\Common\UniqueId;

class Get extends Action
{
  protected $root = 'GetAvailabilityRQ';

  public function reset()
  {
    // Add elements
    $this->addElement('Data', [
      'GetAvailability' => [],
    ]);

    return $this;
  }

  public function setEventId($id) {
    $this->xmlElements['Data']['GetAvailability']['EventId'] = $id;

    return $this;
  }

  public function setAttendeeCode($code) {
    $this->xmlElements['Data']['GetAvailability']['AttendeeCode'] = $code;

    return $this;
  }

  public function setStartDate(DateTime $date) {
    $this->xmlElements['Data']['GetAvailability']['StartDate'] = $date->format('Y-m-d');

    return $this;
  }

  public function setEndDate(DateTime $date) {
    $this->xmlElements['Data']['GetAvailability']['EndDate'] = $date->format('Y-m-d');

    return $this;
  }
}
