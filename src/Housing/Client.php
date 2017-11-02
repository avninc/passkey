<?php

namespace Passkey\Bridge;

use Passkey\Client as PasskeyClient;

class Client extends PasskeyClient
{
  protected $service = 'PasskeyHousing';
  protected $namespace = ['http://www.opentravel.org/OTA/2002/11' => ''];

  public function parse($xml)
  {
    return $xml;
  }
}
