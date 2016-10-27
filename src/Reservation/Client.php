<?php

namespace Passkey\Reservation;

use Passkey\Client as PasskeyClient;
use Passkey\Common\{Guest};

class Client extends PasskeyClient
{
  protected $service = 'PasskeyReservation';
  protected $namespace = ['http://www.opentravel.org/OTA/2002/11' => 'ota'];
}
