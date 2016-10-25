<?php

namespace Passkey\Tests;

use PHPUnit\Framework\TestCase;
use Passkey\Reservation\Client as ReservationClient;
use Passkey\Reservation\Actions\{Create, Modify, Get, Cancel, Status};
use Passkey\Common\{Message, Security, Guest};

class ClientTest extends TestCase
{
    protected $client;

    public function setUp()
    {
      parent::setUp();

      $this->client = new ReservationClient();
    }

    public function atestClientInitiated()
    {
      $this->assertNotNull($this->client->getWsdl(), 'WSDL file should be returned');
    }

    public function atestClientXmlWrite()
    {
      $this->assertContains('CreateReservationRQ', (string) $this->client->getXmlService()->write('CreateReservationRQ', []));
    }

    public function atestSecurity()
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

      $this->assertContains('Login', (string) $createClient->getXml());
      $this->assertContains('Version', (string) $createClient->getXml());
      $this->assertContains('CreateReservationRQ', (string) $createClient->getXml());
      $this->assertContains('GetReservationRQ', (string) $getClient->getXml());
    }

    public function testGuest()
    {

      $createClient = new Create;
      $security = new Security('reglinkapi', 'passkey1', 136260);
      $createClient->setSecurity($security);

      $message = new Message('CreateReservation', 'CreateReservation');
      $createClient->setMessage($message);

      $guest = new Guest;
      $guest->setNamePrefix('test')
            ->setGivenName('test1')
            ->setSurname('TEST3')
            ->setPhoneNumber('8182558345')
            ->setPhoneTechType('1')
            ->setFaxNumber('8182558345')
            ->setFaxTechType('3')
            ->setAddressLine('5440 Tujunga Ave')
            ->setAddressLine2('APT 100')
            ->setCityName('North Hollywood')
            ->setStateProv('CA')
            ->setPostalCode('91601')
            ->setCountryName('US')
            ->setEmployeeInfo('Software Engineer')
            ->setEmail('test@test.com')
            ->setSmokingAllowed(1)
            ->setPhysChallFeaturePref(1)
            ->setSpecRequestPref('testing special features')
            ->setCompanyName('AVN Media Network, Inc.');

      $guest2 = new Guest;
      $guest2->setNamePrefix('test')
            ->setGivenName('test1')
            ->setSurname('TEST3')
            ->setPhoneNumber('8182558345')
            ->setPhoneTechType('1')
            ->setFaxNumber('8182558345')
            ->setFaxTechType('3')
            ->setAddressLine('5440 Tujunga Ave')
            ->setAddressLine2('APT 100')
            ->setCityName('North Hollywood')
            ->setStateProv('CA')
            ->setPostalCode('91601')
            ->setCountryName('US')
            ->setEmployeeInfo('Software Engineer')
            ->setEmail('test@test.com')
            ->setSmokingAllowed(1)
            ->setPhysChallFeaturePref(1)
            ->setSpecRequestPref('testing special features')
            ->setCompanyName('AVN Media Network, Inc.');

      $createClient->addGuests([$guest, $guest2]);


      print_r((string) $createClient->getXml());

    }
}
