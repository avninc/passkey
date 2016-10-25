<?php

namespace Passkey\Reservation;

use Passkey\Client as PasskeyClient;
use Passkey\Common\{Guest};

class Client extends PasskeyClient
{
  protected $wsdlFile = 'https://training-api.passkey.com/axis/services/PasskeyReservation?wsdl';

  protected $namespace = ['http://www.opentravel.org/OTA/2002/11' => 'ota'];

  /**
   * Constructor.
   *
   * @param string               $wsdl    WSDL file
   * @param array(string=>mixed) $options Options array
   */
  public function __construct($wsdl=null, array $options = [])
  {
      parent::__construct($this->wsdlFile, $options);

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


}
