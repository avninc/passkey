<?php

namespace Passkey\Tests;

use DateTime;
use PHPUnit\Framework\TestCase;
use Passkey\HousingAvailability\Actions\GetAvilability;
use Passkey\Common\{Message, Security, UniqueId};
use Passkey\HousingAvailability\Client as HousingAvailabilityClient;

class HousingAvailabilityTest extends TestCase
{
    protected $client;

    public function setUp()
    {
      parent::setUp();

      $this->client = (new HousingAvailabilityClient())->setDebug(false)->refresh();
    }

    public function testClientInitiated()
    {
      $this->assertNotNull($this->client->getWsdl(), 'WSDL file should be returned');
    }

    public function testClientXmlWrite()
    {
      $this->assertContains('GetAvailabilityRQ', (string) $this->client->getXmlService()->write('GetAvailabilityRQ', []));
    }

    public function testSecurity()
    {
      $getClient = new GetAvilability;

      $security = new Security('reglinkapi', 'passkey1', 136260);
      $this->client->setSecurity($security);
      $getClient->setSecurity($security);

      $message = new Message('GetHousingAvailability', 'GetHousingAvailability');
      $this->client->setMessage($message);
      $getClient->setMessage($message);

      $getClient->setEventId(222222);
      $getClient->setAttendeeCode('xxxx');
      $getClient->setStartDate(new DateTime('2018-01-19'));
      $getClient->setEndDate(new DateTime('2018-01-29'));

      $xml = $getClient->getXml();

      $result = $getClient->getAvailability($xml);
      
      $parsed = $getClient->parse($result);

      $this->assertContains('Login', $xml);
      $this->assertContains('Version', $xml);
      $this->assertContains('GetAvailabilityRQ', $xml);
    }
}
