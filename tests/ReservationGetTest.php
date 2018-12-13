<?php

namespace Passkey\Tests;

use PHPUnit\Framework\TestCase;
use Passkey\Reservation\Client as ReservationClient;
use Passkey\Reservation\Actions\Create;
use Passkey\Reservation\Actions\Modify;
use Passkey\Reservation\Actions\Get;
use Passkey\Reservation\Actions\Cancel;
use Passkey\Reservation\Actions\Status;
use Passkey\Common\Message;
use Passkey\Common\Security;
use Passkey\Common\UniqueId;
use Passkey\Reservation\Reservation;
use Passkey\Reservation\Model\Guest;
use Passkey\Reservation\Model\RoomStay;
use Passkey\Reservation\Model\Info;
use Passkey\Reservation\Model\GlobalInfo;
use Passkey\Reservation\Model\Guarantee;
use Passkey\Reservation\Model\OtherPayment;

class ReservationGetTest extends TestCase
{
    protected $client;

    public function setUp()
    {
        parent::setUp();

        $this->client = (new ReservationClient())->setDebug(false)->refresh();
    }

    public function testGet()
    {
        echo 1;
        $client = new Get;
        $security = new Security('reglinkapi', 'passkey1', 136260);
        $client->setSecurity($security);

        $message = new Message('GetReservation', 'GetReservation');
        $client->setMessage($message);

        $uniqueId = new UniqueId('32K99QTP');

        $client->setUniqueId($uniqueId);
        $client->setShowAckInfo('true');
        $client->setShowResNotes('true');
        $client->setShowCCInfo('true');

        $xml = $client->getXml();

        $result = $client->get($xml);
      
        print_r($result);
        exit;

        $parsed = $client->parse($result);

        print_r($parsed);

        $this->assertContains('<ota:UniqueId Type="RES" Id="328SZVW7"/>', $xml);
        $this->assertContains('<ShowAckInfo>true</ShowAckInfo>', $xml);
        $this->assertContains('<OP>GetReservation</OP>', $xml);
    }

    protected function _guests($count = 1)
    {
        $guests = [];
        for ($i=1; $i<=$count; $i++) {
            $guest = new Guest;
            $guest->setNamePrefix('test')
              ->setGivenName('test1')
              ->setSurname('TEST3')
              ->setPhoneNumber('88828212312')
              ->setPhoneTechType('1')
              ->setFaxNumber('88828212312')
              ->setFaxTechType('3')
              ->setAddressLine('123 Tujunga Ave')
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
              ->setCompanyName('Test');

            $guests[] = $guest;
        }
        return $guests;
    }
}
