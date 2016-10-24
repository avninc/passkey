<?php

namespace Passkey\Reservation;

use Passkey\Client as PasskeyClient;

class Client extends PasskeyClient
{
  protected $wsdlFile = 'https://training-api.passkey.com/axis/services/PasskeyReservation?wsdl';

  protected $namespace = ['http://www.opentravel.org/OTA/2002/11' => 'ota'];

  protected $root = 'CreateReservationRQ';
}
