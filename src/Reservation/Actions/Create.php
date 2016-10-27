<?php

namespace Passkey\Reservation\Actions;

use Passkey\Reservation\Client;
use Passkey\Common\{Guest, RoomStay, Info, GlobalInfo};

class Create extends Client
{
  protected $root = 'CreateReservationRQ';

  /**
   * Constructor.
   *
   * @param string               $wsdl    WSDL file
   * @param array(string=>mixed) $options Options array
   */
  public function __construct($wsdl=null, array $options = [], bool $isDebug=false)
  {
      parent::__construct($wsdl, $options, $isDebug);

      $this->resetXml();
  }

  public function resetXml()
  {
    // Add elements
    $this->addElement('Data', [
      'OTA_HotelResRQ' => [
        'HotelReservations' => [
          'HotelReservation' => [
            'attributes' => ['RoomStayReservation' => 'true'],
            'value' => [
              'RoomStays' => [],
              'ResGuests' => [],
              'ResGlobalInfo' => [],
              'TPA_Extensions' => [],
            ]
          ],
        ],
      ],
    ]);
  }

  public function addGuest(Guest $guest)
  {
    $this->xmlElements['Data']['OTA_HotelResRQ']['HotelReservations']['HotelReservation']['value']['ResGuests'][] = $guest->getParams();
  }

  public function addGuests(array $guests=[])
  {
    foreach($guests as $guest) {
      $this->addGuest($guest);
    }

    return $this;
  }

  public function setRoomStay(RoomStay $roomStay)
  {
    $this->xmlElements['Data']['OTA_HotelResRQ']['HotelReservations']['HotelReservation']['value']['RoomStays'] = $roomStay->getParams();
  }

  public function setInfo(Info $info)
  {
    $this->xmlElements['Data']['OTA_HotelResRQ']['HotelReservations']['HotelReservation']['value']['TPA_Extensions'] = $info->getParams();
  }

  public function setGlobalInfo(GlobalInfo $info)
  {
    $this->xmlElements['Data']['OTA_HotelResRQ']['HotelReservations']['HotelReservation']['value']['ResGlobalInfo'] = $info->getParams();
  }
}
