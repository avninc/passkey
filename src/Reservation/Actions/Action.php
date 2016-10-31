<?php

namespace Passkey\Reservation\Actions;

use Passkey\Reservation\Client;

abstract class Action extends Client
{
  abstract public function reset();
}
