<?php

namespace Passkey\Bridge;

use Passkey\Common\{Element, UniqueId};
use Passkey\Bridge\Model\{RoomStay, Guest, Info, GlobalInfo};

class Bridge extends Element
{
    protected $RoomStayReservation = true;
    protected $CreateDateTime = null;
    protected $LastModifyDateTime = null;

    public function __construct(array $params=[])
    {
        Guest::reset();

        $items = [
          'HotelReservations' => [
            'HotelReservation' => [
              'attributes' => [
                'RoomStayReservation' => $params['RoomStayReservation'] ?? $this->getRoomStayReservation(),
              ],
              'value' => []
            ],
          ],
        ];

        $this->setParams($items);

        if(isset($params['UniqueId']) && $params['UniqueId'] instanceof UniqueId) {
          $this->setUniqueId($params['UniqueId']);
        }

        if(isset($params['CreateDateTime'])) {
          $this->params['HotelReservations']['HotelReservation']['attributes']['CreateDateTime'] = $params['CreateDateTime'];
        }

        if(isset($params['LastModifyDateTime'])) {
          $this->params['HotelReservations']['HotelReservation']['attributes']['LastModifyDateTime'] = $params['LastModifyDateTime'];
        }

        return $this;
    }

    public function setUniqueId(UniqueId $UniqueId) {
      $this->params['HotelReservations']['HotelReservation']['value']['UniqueId'] = [
        'attributes' => [
          'Type' => $UniqueId->getType(),
          'Id' => $UniqueId->getId()
        ]
      ];
    }

    public function addGuest(Guest $guest)
    {
      $this->params['HotelReservations']['HotelReservation']['value']['ResGuests'][] = $guest->getParams();
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
      $this->params['HotelReservations']['HotelReservation']['value']['RoomStays'] = $roomStay->getParams();
    }

    public function setInfo(Info $info)
    {
      $this->params['HotelReservations']['HotelReservation']['value']['TPA_Extensions'] = $info->getParams();
    }

    public function setGlobalInfo(GlobalInfo $info)
    {
      $this->params['HotelReservations']['HotelReservation']['value']['ResGlobalInfo'] = $info->getParams();
    }

    /**
     * Gets the value of RoomStayReservation.
     *
     * @return mixed
     */
    public function getRoomStayReservation()
    {
        return $this->RoomStayReservation;
    }

    /**
     * Sets the value of RoomStayReservation.
     *
     * @param mixed $RoomStayReservation the room stay reservation
     *
     * @return self
     */
    public function setRoomStayReservation($RoomStayReservation)
    {
        $this->RoomStayReservation = $RoomStayReservation;
        $this->set('RoomStayReservation', $RoomStayReservation);

        return $this;
    }

    /**
     * Gets the value of CreateDateTime.
     *
     * @return mixed
     */
    public function getCreateDateTime()
    {
        return $this->CreateDateTime;
    }

    /**
     * Sets the value of CreateDateTime.
     *
     * @param mixed $CreateDateTime the create date time
     *
     * @return self
     */
    public function setCreateDateTime($CreateDateTime)
    {
        $this->CreateDateTime = $CreateDateTime;
        $this->set('CreateDateTime', $CreateDateTime);

        return $this;
    }

    /**
     * Gets the value of LastModifyDateTime.
     *
     * @return mixed
     */
    public function getLastModifyDateTime()
    {
        return $this->LastModifyDateTime;
    }

    /**
     * Sets the value of LastModifyDateTime.
     *
     * @param mixed $LastModifyDateTime the last modify date time
     *
     * @return self
     */
    public function setLastModifyDateTime($LastModifyDateTime)
    {
        $this->LastModifyDateTime = $LastModifyDateTime;
        $this->set('LastModifyDateTime', $LastModifyDateTime);

        return $this;
    }
}
