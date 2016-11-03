<?php

namespace Passkey\Reservation;

use Verdant\XML2Array;

class Response
{
  protected $isSuccess = false;

  protected $statusId = 0;
  protected $status = null;
  protected $guid;

  protected $errorMessage = null;
  protected $errorCode = 0;

  protected $uniqueId = null;
  protected $type = null;

  protected $raw;


  public function parse($xml)
  {
    $this->raw = XML2Array::createArray($xml);

    // Set status message
    if (isset($this->raw['PasskeyRS']) && isset($this->raw['PasskeyRS']['Message'])) {
        if (isset($this->raw['PasskeyRS']['Message']['Status'])) {
          if (isset($this->raw['PasskeyRS']['Message']['Status']['@value'])) {
            $this->setStatus($this->raw['PasskeyRS']['Message']['Status']['@value']);
          }

          if (isset($this->raw['PasskeyRS']['Message']['Status']['@attributes']['ID'])) {
            $this->setStatusId($this->raw['PasskeyRS']['Message']['Status']['@attributes']['ID']);
          }
        }

        if (isset($this->raw['PasskeyRS']['Message']['@attributes']['GUID'])) {
          $this->setGuid($this->raw['PasskeyRS']['Message']['@attributes']['GUID']);
        }

        if ($this->getStatus() == 'PROCESSED') {
          $this->setSuccess(true);
        }

        // Set Error
        if ($this->getStatus() == 'ERROR') {
          if (isset($this->raw['PasskeyRS']['Message']['Errors'])) {
            $this->setErrorMessage($this->raw['PasskeyRS']['Message']['Errors']['Error']);

            $explode = explode(':', $this->getErrorMessage());
            $this->setErrorCode(trim($explode[0]));
          }
        }
    }

    // Set data
    if (isset($this->raw['PasskeyRS']['Data'])) {
      $data = $this->raw['PasskeyRS']['Data'];

      // Hotel reservation
      if (isset($data['ota:OTA_HotelResRS'])) {
        // Gather unique ID
        if (isset($data['ota:OTA_HotelResRS']['ota:HotelReservations'])
            && isset($data['ota:OTA_HotelResRS']['ota:HotelReservations']['ota:HotelReservation'])
            && isset($data['ota:OTA_HotelResRS']['ota:HotelReservations']['ota:HotelReservation']['ota:UniqueId']))
        {
            $this->setUniqueId($data['ota:OTA_HotelResRS']['ota:HotelReservations']['ota:HotelReservation']['ota:UniqueId']['@attributes']['Id']);
            $this->setType($data['ota:OTA_HotelResRS']['ota:HotelReservations']['ota:HotelReservation']['ota:UniqueId']['@attributes']['Type']);
        }
      }
    }

    return $this;
  }

  public function getUniqueId()
  {
    return $this->uniqueId;
  }

  public function getType()
  {
    return $this->type;
  }

  protected function setUniqueId($id)
  {
    $this->uniqueId = $id;

    return $this;
  }

  protected function setType($type)
  {
    $this->type = $type;

    return $this;
  }

  public function isError()
  {
    return !$this->isSuccess;
  }

  public function isSuccess()
  {
    return $this->isSuccess;
  }

  protected function setSuccess($value)
  {
    $this->isSuccess = $value;

    return $this;
  }

  protected function setErrorMessage($message)
  {
      $this->errorMessage = $message;

      return $this;
  }

  protected function setErrorCode($code)
  {
      $this->errorCode = $code;

      return $this;
  }

  public function getErrorCode()
  {
    return $this->errorCode;
  }

  public function getErrorMessage()
  {
    return $this->errorMessage;
  }

  protected function setGuid($id)
  {
    $this->guid = $id;

    return $this;
  }

  public function getGuid()
  {
    return $this->guid;
  }

  protected function setStatus($status)
  {
    $this->status = $status;

    return $this;
  }

  public function getStatus()
  {
    return $this->status;
  }

  protected function setStatusId($id)
  {
    $this->statusId = $id;

    return $this;
  }

  public function getStatusId()
  {
    return $this->statusId;
  }

  public function getRaw()
  {
    return $this->raw;
  }
}
