<?php

namespace Passkey\Common;

use Passkey\Common\Security;

class Profile
{
    protected $LastName;
    protected $MiddleInitial;
    protected $FirstName;
    protected $Title;
    protected $Organization;
    protected $Position;
    protected $Address1;
    protected $Address2;
    protected $City;
    protected $State;
    protected $ZipCode;
    protected $CountryCode;
    protected $WorkPhone;
    protected $FaxNumber;
    protected $EmailAddress;
    protected $ArrivalDate;
    protected $DepartureDate;
    protected $ReceivedFrom;
    protected $SpecialRequests;
    protected $PhysChall;
    protected $HowBooked;
    protected $PaymentType;

    protected $BillToLastName;
    protected $BillToMI;
    protected $BillToFirstName;
    protected $BillToAddress1;
    protected $BillToAddress2;
    protected $BillToCity;
    protected $BillToState;
    protected $BillToZipCode;
    protected $BillToCountryCode;
    protected $BillToPhone;

    protected $oPayAmt;
    protected $oPayDate;
    protected $oPayReferenceNum;
    protected $oPayCheckNum;
    protected $oPayReceived;
    protected $oPayComments;
    protected $oPayName;

    protected $UserName;
    protected $Password;
    protected $PartnerID;
    protected $Version = '4.00.03';
    protected $Mode = 'S';
    protected $OP;
    protected $Destination = '02';
    protected $Locale = 'EN_US';

    protected $EventID;
    protected $EventCode;
    protected $BlockID;
    protected $HotelID;

    public function __construct(Security $security, array $defaults=[])
    {
        if(count($defaults)) {
            foreach($defaults as $key => $value) {
                if($this->hasField($key)) {
                    $this->{$key} = $value;
                }
            }
        }

        $this->setUserName($security->getUserName())
            ->setPassword($security->getPassword())
            ->setPartnerID($security->getPartnerId());
    }

    protected function hasField($key)
    {
        return array_key_exists($key, get_object_vars($this));
    }

    /**
     * Return an array with all fields that are not null
     * @return  array
     */
    public function fields()
    {
        $fields = get_object_vars($this);

        $fields = array_filter($fields, function($value, $key) {
            return $value !== null;
        }, ARRAY_FILTER_USE_BOTH);

        return $fields;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->LastName;
    }

    /**
     * @param mixed $LastName
     *
     * @return self
     */
    public function setLastName($LastName)
    {
        $this->LastName = $LastName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMiddleInitial()
    {
        return $this->MiddleInitial;
    }

    /**
     * @param mixed $MiddleInitial
     *
     * @return self
     */
    public function setMiddleInitial($MiddleInitial)
    {
        $this->MiddleInitial = $MiddleInitial;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->FirstName;
    }

    /**
     * @param mixed $FirstName
     *
     * @return self
     */
    public function setFirstName($FirstName)
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * @param mixed $Title
     *
     * @return self
     */
    public function setTitle($Title)
    {
        $this->Title = $Title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrganization()
    {
        return $this->Organization;
    }

    /**
     * @param mixed $Organization
     *
     * @return self
     */
    public function setOrganization($Organization)
    {
        $this->Organization = $Organization;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->Position;
    }

    /**
     * @param mixed $Position
     *
     * @return self
     */
    public function setPosition($Position)
    {
        $this->Position = $Position;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress1()
    {
        return $this->Address1;
    }

    /**
     * @param mixed $Address1
     *
     * @return self
     */
    public function setAddress1($Address1)
    {
        $this->Address1 = $Address1;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->Address2;
    }

    /**
     * @param mixed $Address2
     *
     * @return self
     */
    public function setAddress2($Address2)
    {
        $this->Address2 = $Address2;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->City;
    }

    /**
     * @param mixed $City
     *
     * @return self
     */
    public function setCity($City)
    {
        $this->City = $City;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->State;
    }

    /**
     * @param mixed $State
     *
     * @return self
     */
    public function setState($State)
    {
        $this->State = $State;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->ZipCode;
    }

    /**
     * @param mixed $ZipCode
     *
     * @return self
     */
    public function setZipCode($ZipCode)
    {
        $this->ZipCode = $ZipCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->CountryCode;
    }

    /**
     * @param mixed $CountryCode
     *
     * @return self
     */
    public function setCountryCode($CountryCode)
    {
        $this->CountryCode = $CountryCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWorkPhone()
    {
        return $this->WorkPhone;
    }

    /**
     * @param mixed $WorkPhone
     *
     * @return self
     */
    public function setWorkPhone($WorkPhone)
    {
        $this->WorkPhone = $WorkPhone;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFaxNumber()
    {
        return $this->FaxNumber;
    }

    /**
     * @param mixed $FaxNumber
     *
     * @return self
     */
    public function setFaxNumber($FaxNumber)
    {
        $this->FaxNumber = $FaxNumber;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->EmailAddress;
    }

    /**
     * @param mixed $EmailAddress
     *
     * @return self
     */
    public function setEmailAddress($EmailAddress)
    {
        $this->EmailAddress = $EmailAddress;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArrivalDate()
    {
        return $this->ArrivalDate;
    }

    /**
     * @param mixed $ArrivalDate
     *
     * @return self
     */
    public function setArrivalDate($ArrivalDate)
    {
        $this->ArrivalDate = $ArrivalDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepartureDate()
    {
        return $this->DepartureDate;
    }

    /**
     * @param mixed $DepartureDate
     *
     * @return self
     */
    public function setDepartureDate($DepartureDate)
    {
        $this->DepartureDate = $DepartureDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceivedFrom()
    {
        return $this->ReceivedFrom;
    }

    /**
     * @param mixed $ReceivedFrom
     *
     * @return self
     */
    public function setReceivedFrom($ReceivedFrom)
    {
        $this->ReceivedFrom = $ReceivedFrom;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpecialRequests()
    {
        return $this->SpecialRequests;
    }

    /**
     * @param mixed $SpecialRequests
     *
     * @return self
     */
    public function setSpecialRequests($SpecialRequests)
    {
        $this->SpecialRequests = $SpecialRequests;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhysChall()
    {
        return $this->PhysChall;
    }

    /**
     * @param mixed $PhysChall
     *
     * @return self
     */
    public function setPhysChall($PhysChall)
    {
        $this->PhysChall = $PhysChall;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHowBooked()
    {
        return $this->HowBooked;
    }

    /**
     * @param mixed $HowBooked
     *
     * @return self
     */
    public function setHowBooked($HowBooked)
    {
        $this->HowBooked = $HowBooked;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentType()
    {
        return $this->PaymentType;
    }

    /**
     * @param mixed $PaymentType
     *
     * @return self
     */
    public function setPaymentType($PaymentType)
    {
        $this->PaymentType = $PaymentType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillToLastName()
    {
        return $this->BillToLastName;
    }

    /**
     * @param mixed $BillToLastName
     *
     * @return self
     */
    public function setBillToLastName($BillToLastName)
    {
        $this->BillToLastName = $BillToLastName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillToMI()
    {
        return $this->BillToMI;
    }

    /**
     * @param mixed $BillToMI
     *
     * @return self
     */
    public function setBillToMI($BillToMI)
    {
        $this->BillToMI = $BillToMI;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillToFirstName()
    {
        return $this->BillToFirstName;
    }

    /**
     * @param mixed $BillToFirstName
     *
     * @return self
     */
    public function setBillToFirstName($BillToFirstName)
    {
        $this->BillToFirstName = $BillToFirstName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillToAddress1()
    {
        return $this->BillToAddress1;
    }

    /**
     * @param mixed $BillToAddress1
     *
     * @return self
     */
    public function setBillToAddress1($BillToAddress1)
    {
        $this->BillToAddress1 = $BillToAddress1;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillToAddress2()
    {
        return $this->BillToAddress2;
    }

    /**
     * @param mixed $BillToAddress2
     *
     * @return self
     */
    public function setBillToAddress2($BillToAddress2)
    {
        $this->BillToAddress2 = $BillToAddress2;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillToCity()
    {
        return $this->BillToCity;
    }

    /**
     * @param mixed $BillToCity
     *
     * @return self
     */
    public function setBillToCity($BillToCity)
    {
        $this->BillToCity = $BillToCity;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillToState()
    {
        return $this->BillToState;
    }

    /**
     * @param mixed $BillToState
     *
     * @return self
     */
    public function setBillToState($BillToState)
    {
        $this->BillToState = $BillToState;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillToZipCode()
    {
        return $this->BillToZipCode;
    }

    /**
     * @param mixed $BillToZipCode
     *
     * @return self
     */
    public function setBillToZipCode($BillToZipCode)
    {
        $this->BillToZipCode = $BillToZipCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillToCountryCode()
    {
        return $this->BillToCountryCode;
    }

    /**
     * @param mixed $BillToCountryCode
     *
     * @return self
     */
    public function setBillToCountryCode($BillToCountryCode)
    {
        $this->BillToCountryCode = $BillToCountryCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillToPhone()
    {
        return $this->BillToPhone;
    }

    /**
     * @param mixed $BillToPhone
     *
     * @return self
     */
    public function setBillToPhone($BillToPhone)
    {
        $this->BillToPhone = $BillToPhone;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayAmt()
    {
        return $this->oPayAmt;
    }

    /**
     * @param mixed $oPayAmt
     *
     * @return self
     */
    public function setPayAmt($oPayAmt)
    {
        $this->oPayAmt = $oPayAmt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayDate()
    {
        return $this->oPayDate;
    }

    /**
     * @param mixed $oPayDate
     *
     * @return self
     */
    public function setPayDate($oPayDate)
    {
        $this->oPayDate = $oPayDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayReferenceNum()
    {
        return $this->oPayReferenceNum;
    }

    /**
     * @param mixed $oPayReferenceNum
     *
     * @return self
     */
    public function setPayReferenceNum($oPayReferenceNum)
    {
        $this->oPayReferenceNum = $oPayReferenceNum;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayCheckNum()
    {
        return $this->oPayCheckNum;
    }

    /**
     * @param mixed $oPayCheckNum
     *
     * @return self
     */
    public function setPayCheckNum($oPayCheckNum)
    {
        $this->oPayCheckNum = $oPayCheckNum;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayReceived()
    {
        return $this->oPayReceived;
    }

    /**
     * @param mixed $oPayReceived
     *
     * @return self
     */
    public function setPayReceived($oPayReceived)
    {
        $this->oPayReceived = $oPayReceived;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayComments()
    {
        return $this->oPayComments;
    }

    /**
     * @param mixed $oPayComments
     *
     * @return self
     */
    public function setPayComments($oPayComments)
    {
        $this->oPayComments = $oPayComments;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayName()
    {
        return $this->oPayName;
    }

    /**
     * @param mixed $oPayName
     *
     * @return self
     */
    public function setPayName($oPayName)
    {
        $this->oPayName = $oPayName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->UserName;
    }

    /**
     * @param mixed $UserName
     *
     * @return self
     */
    public function setUserName($UserName)
    {
        $this->UserName = $UserName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * @param mixed $Password
     *
     * @return self
     */
    public function setPassword($Password)
    {
        $this->Password = $Password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPartnerID()
    {
        return $this->PartnerID;
    }

    /**
     * @param mixed $PartnerID
     *
     * @return self
     */
    public function setPartnerID($PartnerID)
    {
        $this->PartnerID = $PartnerID;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->Version;
    }

    /**
     * @param mixed $Version
     *
     * @return self
     */
    public function setVersion($Version)
    {
        $this->Version = $Version;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMode()
    {
        return $this->Mode;
    }

    /**
     * @param mixed $Mode
     *
     * @return self
     */
    public function setMode($Mode)
    {
        $this->Mode = $Mode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOP()
    {
        return $this->OP;
    }

    /**
     * @param mixed $OP
     *
     * @return self
     */
    public function setOP($OP)
    {
        $this->OP = $OP;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->Destination;
    }

    /**
     * @param mixed $Destination
     *
     * @return self
     */
    public function setDestination($Destination)
    {
        $this->Destination = $Destination;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->Locale;
    }

    /**
     * @param mixed $Locale
     *
     * @return self
     */
    public function setLocale($Locale)
    {
        $this->Locale = $Locale;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEventID()
    {
        return $this->EventID;
    }

    /**
     * @param mixed $EventID
     *
     * @return self
     */
    public function setEventID($EventID)
    {
        $this->EventID = $EventID;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEventCode()
    {
        return $this->EventCode;
    }

    /**
     * @param mixed $EventCode
     *
     * @return self
     */
    public function setEventCode($EventCode)
    {
        $this->EventCode = $EventCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBlockID()
    {
        return $this->BlockID;
    }

    /**
     * @param mixed $BlockID
     *
     * @return self
     */
    public function setBlockID($BlockID)
    {
        $this->BlockID = $BlockID;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHotelID()
    {
        return $this->HotelID;
    }

    /**
     * @param mixed $HotelID
     *
     * @return self
     */
    public function setHotelID($HotelID)
    {
        $this->HotelID = $HotelID;

        return $this;
    }
}
