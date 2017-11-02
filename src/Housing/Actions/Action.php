<?php

namespace Passkey\Bridge\Actions;

use Passkey\Bridge\Client;

abstract class Action extends Client
{
  abstract public function reset();
}
