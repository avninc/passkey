<?php

namespace Passkey\Bridge;

use Passkey\Client as PasskeyClient;

class Client extends PasskeyClient
{
  protected $service = 'PasskeyBridge';
  protected $namespace = ['http://www.opentravel.org/OTA/2002/11' => 'ota'];

  public function parse($xml)
  {
    return (new Response())->parse($xml);
  }
}
