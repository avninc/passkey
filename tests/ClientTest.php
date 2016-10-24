<?php

namespace Passkey\Tests;

use PHPUnit\Framework\TestCase;
use Passkey\Reservation\Client as ReservationClient;
use Passkey\Common\{Message, Security};

class ClientTest extends TestCase
{
    protected $client;

    public function setUp()
    {
      parent::setUp();

      $this->client = new ReservationClient();
    }

    public function testClientInitiated()
    {
      $this->assertNotNull($this->client->getWsdl(), 'WSDL file should be returned');
    }

    public function testClientXmlWrite()
    {
      $this->assertContains('CreateReservationRQ', (string) $this->client->getXmlService()->write('CreateReservationRQ', []));
    }

    public function testSecurity()
    {
      $security = new Security('reglinkapi', 'passkey1', 136260);
      $this->client->setSecurity($security);

      $message = new Message('CreateReservation', 'CreateReservation');
      $this->client->setMessage($message);

      echo "\n\n\n\n\n\n\n";
      print_r($this->client->getXml());
      echo "\n\n\n\n\n\n\n";
    }
}
