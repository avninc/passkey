<?php

namespace Passkey\HousingAvailability\Actions;

use Passkey\HousingAvailability\Client;

abstract class Action extends Client
{
  abstract public function reset();
}
