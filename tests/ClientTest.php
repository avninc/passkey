<?php

namespace Passkey\Tests;

use PHPUnit\Framework\TestCase;
use Passkey\Reservation\Client as ReservationClient;
use Passkey\Reservation\Actions\{Create, Modify, Get, Cancel, Status};
use Passkey\Common\{Message, Security, Guest, RoomStay, Reservation,
                    Info, GlobalInfo, Guarantee, OtherPayment, UniqueId};

class ClientTest extends TestCase
{
    protected $client;

    public function setUp()
    {
      parent::setUp();

      $this->client = new ReservationClient(null, [], true);
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

    public function testGuest()
    {

      $createClient = new Create;
      $security = new Security('reglinkapi', 'passkey1', 136260);
      $createClient->setSecurity($security);

      $message = new Message('CreateReservation', 'CreateReservation');
      $createClient->setMessage($message);

      $reservation = new Reservation;

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
            ->setCompanyName('AVN Media Network, Inc.');

      $guest2 = new Guest;
      $guest2->setNamePrefix('test')
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
            ->setCompanyName('AVN Media Network, Inc.');

      $reservation->addGuests([$guest, $guest2]);

      $createClient->setReservation($reservation);

      $xml = $createClient->getXml();

      $this->assertContains('<ota:EmployeeInfo>Software Engineer</ota:EmployeeInfo>', $xml);
      $this->assertContains('<ota:ResGuest ResGuestRPH="2">', $xml);
      $this->assertContains('<ota:SpecRequestPref>testing special features</ota:SpecRequestPref>', $xml);

    }

    public function testRoomStay() {
      $createClient = new Create;
      $security = new Security('reglinkapi', 'passkey1', 136260);
      $createClient->setSecurity($security);

      $message = new Message('CreateReservation', 'CreateReservation');
      $createClient->setMessage($message);

      $reservation = new Reservation;

      $roomStay = new RoomStay(['NumberOfUnits' => 2, 'AgeQualifyingCode' => 1, 'Count' => 2]);

      $reservation->setRoomStay($roomStay);
      $createClient->setReservation($reservation);

      $xml = $createClient->getXml();

      $this->assertContains('<ota:RoomType NumberOfUnits="2"/>', $xml);
      $this->assertContains('<ota:GuestCount AgeQualifyingCode="1" Count="2"/>', $xml);

      // Modify
      $createClient->resetXml();
      $reservation = new Reservation;
      $roomStay = new RoomStay();
      $roomStay->setAgeQualifyingCode(22)->setNumberOfUnits(1)->setCount(3);

      $reservation->setRoomStay($roomStay);
      $createClient->setReservation($reservation);

      $xml = $createClient->getXml();

      $this->assertContains('<ota:RoomType NumberOfUnits="1"/>', $xml);
      $this->assertContains('<ota:GuestCount AgeQualifyingCode="22" Count="3"/>', $xml);

    }

    public function testInfo() {
      $createClient = new Create;
      $security = new Security('reglinkapi', 'passkey1', 136260);
      $createClient->setSecurity($security);

      $message = new Message('CreateReservation', 'CreateReservation');
      $createClient->setMessage($message);

      $reservation = new Reservation;

      $info = new Info(['CustomFields' => ['test1', 'test2', 'test3']]);
      $info->setEventID(1)->setAttendeeCode('RER')
            ->setSendAck('true')
            ->setExtReferenceID('ABC-123')
            ->setResSplitFolioTypeId(102)
            ->setHowBooked(101)
            ->setReceivedFrom('COMPANY')
            ->setPaymentType('cc')
            ->setBlockID('1049123123')
            ->setPhoneNumber('8182551122')
            ->setPrimaryGuestRPH(1)
            ->setReferrer('avn.com');
      $reservation->setInfo($info);

      $createClient->setReservation($reservation);

      $xml = $createClient->getXml();

      $this->assertContains('<ota:EventID>1</ota:EventID>', $xml);
      $this->assertContains('<ota:BillPhone PhoneNumber="8182551122"/>', $xml);
      $this->assertContains('<ota:ResSplitFolioTypeId>102</ota:ResSplitFolioTypeId>', $xml);
      $this->assertContains('<ota:CustomField2>test2</ota:CustomField2>', $xml);
    }

    public function testGlobalInfo() {
      $createClient = new Create;
      $security = new Security('reglinkapi', 'passkey1', 136260);
      $createClient->setSecurity($security);

      $message = new Message('CreateReservation', 'CreateReservation');
      $createClient->setMessage($message);

      $reservation = new Reservation;

      $info = new GlobalInfo();
      $info->setAgeQualifyingCode(22)->setCount(3)
            ->setEarliestDate('2016-01-01')
            ->setLatestDate('2016-01-12')
            ->setText('some text');
      $reservation->setGlobalInfo($info);

      $createClient->setReservation($reservation);

      $xml = $createClient->getXml();

      $this->assertContains('<ota:StartDateWindow EarliestDate="2016-01-01" LatestDate="2016-01-12"/>', $xml);
      $this->assertContains('<ota:GuestCount AgeQualifyingCode="22" Count="3"/>', $xml);
      $this->assertContains('<ota:Text>some text</ota:Text>', $xml);
    }

    public function testGuarantee() {
      $createClient = new Create;
      $security = new Security('reglinkapi', 'passkey1', 136260);
      $createClient->setSecurity($security);

      $message = new Message('CreateReservation', 'CreateReservation');
      $createClient->setMessage($message);

      $reservation = new Reservation;

      $guarantee = new Guarantee;
      $guarantee->setCardHolderName('Vincent Gabriel')
                ->setCardNumber(4111111111111111)
                ->setCardType('Visa')
                ->setExpireDate(0617)
                ->setAddressLine('100 Tujunga Ave')
                ->setAddressLine2('APT 222')
                ->setCityName('North Hollywood')
                ->setStateProv('CA')
                ->setCountryName('US');

      $info = new GlobalInfo();
      $info->setAgeQualifyingCode(22)->setCount(3)
            ->setEarliestDate('2016-01-01')
            ->setLatestDate('2016-01-12')
            ->setText('some text')
            ->setGuarantee($guarantee);
      $reservation->setGlobalInfo($info);

      $createClient->setReservation($reservation);

      $xml = $createClient->getXml();

      $this->assertContains('<ota:PaymentCard CardNumber="4111111111111111" ExpireDate="399" CardType="Visa">', $xml);
      $this->assertContains('<ota:CardHolderName>Vincent Gabriel</ota:CardHolderName>', $xml);
      $this->assertContains('<ota:AddressLine>100 Tujunga Ave</ota:AddressLine>', $xml);
    }

    public function testOtherPayment() {
      $createClient = new Create;
      $security = new Security('reglinkapi', 'passkey1', 136260);
      $createClient->setSecurity($security);

      $message = new Message('CreateReservation', 'CreateReservation');
      $createClient->setMessage($message);

      $reservation = new Reservation;

      $info = new Info(['CustomFields' => ['test1', 'test2', 'test3']]);
      $info->setEventID(1)->setAttendeeCode('RER')
            ->setSendAck('true')
            ->setExtReferenceID('ABC-123')
            ->setResSplitFolioTypeId(102)
            ->setHowBooked(101)
            ->setReceivedFrom('COMPANY')
            ->setPaymentType('cc')
            ->setBlockID('1049123123')
            ->setPhoneNumber('8182551122')
            ->setPrimaryGuestRPH(1)
            ->setReferrer('avn.com');

      $otherPayment = new OtherPayment;
      $otherPayment->setAmount(250)
                   ->setOPayDate('2016-01-01')
                   ->setOPayReferenceNum(123)
                   ->setOPayCheckNum(2222)
                   ->setOPayReceived('true')
                   ->setOPayComments('some comments')
                   ->setOPayName('vincent')
                   ->setAddressLine('1212 Tujunga Ave')
                   ->setAddressLine2('APT 222')
                   ->setCityName('North Hollywood')
                   ->setStateProv('CA')
                   ->setCountryName('United States')
                   ->setCountryCode('US')
                   ->setPhoneNumber('88827271212');
      $info->setOtherPayment($otherPayment);

      $reservation->setInfo($info);

      $createClient->setReservation($reservation);

      $xml = $createClient->getXml();

      $this->assertContains('<ota:OPayAmt Amount="250"/>', $xml);
      $this->assertContains('<ota:OPayReferenceNum>123</ota:OPayReferenceNum>', $xml);
      $this->assertContains('<ota:AddressLine>1212 Tujunga Ave</ota:AddressLine>', $xml);
    }

    public function testModify() {
      $client = new Modify;
      $security = new Security('reglinkapi', 'passkey1', 136260);
      $client->setSecurity($security);

      $message = new Message('ModifyReservation', 'ModifyReservation');
      $client->setMessage($message);

      $reservation = new Reservation;
      $uniqueId = new UniqueId('328SZVW7');

      $reservation->setUniqueId($uniqueId);

      $client->setReservation($reservation);

      $xml = $client->getXml();

      $this->assertContains('<ota:UniqueId Type="RES" Id="328SZVW7"/>', $xml);
      $this->assertContains('<ModifyReservationRQ xmlns:ota="http://www.opentravel.org/OTA/2002/11">', $xml);
    }

    public function testCancel() {
      $client = new Cancel;
      $security = new Security('reglinkapi', 'passkey1', 136260);
      $client->setSecurity($security);

      $message = new Message('CancelReservation', 'CancelReservation');
      $client->setMessage($message);

      $uniqueId = new UniqueId('328SZVW7');

      $client->setUniqueId($uniqueId);

      $xml = $client->getXml();

      $this->assertContains('<Service>CancelReservation</Service>', $xml);
      $this->assertContains('<ota:UniqueId Type="RES" Id="328SZVW7"/>', $xml);
    }

    public function testStatus() {
      $client = new Status;
      $security = new Security('reglinkapi', 'passkey1', 136260);
      $client->setSecurity($security);

      $message = new Message('GetMessageStatus', 'GetMessageStatus');
      $client->setMessage($message);

      $client->setGuid('GUId-123');

      $xml = $client->getXml();

      $this->assertContains('<Service>GetMessageStatus</Service>', $xml);
      $this->assertContains('<GUID>GUId-123</GUID>', $xml);
    }

    public function testGet() {
      $client = new Get;
      $security = new Security('reglinkapi', 'passkey1', 136260);
      $client->setSecurity($security);

      $message = new Message('GetReservation', 'GetReservation');
      $client->setMessage($message);

      $uniqueId = new UniqueId('328SZVW7');

      $client->setUniqueId($uniqueId);
      $client->setShowAckInfo('true');
      $client->setShowResNotes('true');
      $client->setShowCCInfo('true');

      $xml = $client->getXml();

      $this->assertContains('<ota:UniqueId Type="RES" Id="328SZVW7"/>', $xml);
      $this->assertContains('<ShowAckInfo>true</ShowAckInfo>', $xml);
      $this->assertContains('<OP>GetReservation</OP>', $xml);
    }
}
