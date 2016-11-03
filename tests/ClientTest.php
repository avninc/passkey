<?php

namespace Passkey\Tests;

use PHPUnit\Framework\TestCase;
use Passkey\Reservation\Reservation;
use Passkey\Common\{Message, Security, UniqueId};
use Passkey\Reservation\Client as ReservationClient;
use Passkey\Reservation\Actions\{Create, Modify, Get, Cancel, Status};
use Passkey\Reservation\Model\{Guest, RoomStay,Info, GlobalInfo, Guarantee, OtherPayment};

class ClientTest extends TestCase
{
    protected $client;

    public function setUp()
    {
      parent::setUp();

      $this->client = (new ReservationClient())->setDebug(true)->refresh();
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
      $createClient = new Create;
      $getClient = new Get;

      $security = new Security('reglinkapi', 'passkey1', 136260);
      $this->client->setSecurity($security);
      $createClient->setSecurity($security);
      $getClient->setSecurity($security);

      $message = new Message('CreateReservation', 'CreateReservation');
      $this->client->setMessage($message);
      $createClient->setMessage($message);
      $getClient->setMessage($message);

      $createXml = $createClient->getXml();
      $getXml = $getClient->getXml();

      $this->assertContains('Login', $createXml);
      $this->assertContains('Version', $createXml);
      $this->assertContains('CreateReservationRQ', $createXml);
      $this->assertContains('GetReservationRQ', $getXml);
    }
}
