<?php

namespace Passkey\Reservation;

use Passkey\Helpers;
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
    protected $xml;

    protected $data = [];
    
    public function parse($xml)
    {
        $this->xml = $xml;
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
                if (isset($data['ota:OTA_HotelResRS']['ota:HotelReservations']) && isset($data['ota:OTA_HotelResRS']['ota:HotelReservations']['ota:HotelReservation']) && isset($data['ota:OTA_HotelResRS']['ota:HotelReservations']['ota:HotelReservation']['ota:UniqueId'])) {
                    $this->setUniqueId($data['ota:OTA_HotelResRS']['ota:HotelReservations']['ota:HotelReservation']['ota:UniqueId']['@attributes']['Id']);
                    $this->setType($data['ota:OTA_HotelResRS']['ota:HotelReservations']['ota:HotelReservation']['ota:UniqueId']['@attributes']['Type']);
                }

                $dataReservation = Helpers::data_get($data, 'ota:OTA_HotelResRS.ota:HotelReservations.ota:HotelReservation');
                if($dataReservation) {
                    $this->set('CreateDateTime', Helpers::data_get($dataReservation, '@attributes.CreateDateTime'));
                    $this->set('LastModifyDateTime', Helpers::data_get($dataReservation, '@attributes.LastModifyDateTime'));
                    $this->set('RoomStayReservation', Helpers::data_get($dataReservation, '@attributes.RoomStayReservation'));

                    $roomType = Helpers::data_get($dataReservation, 'ota:RoomStays.ota:RoomStay.ota:RoomTypes.ota:RoomType');
                    if($roomType) {
                        $this->set('roomType', [
                            'NumberOfUnits' => Helpers::data_get($roomType, '@attributes.NumberOfUnits'),
                            'Text' => Helpers::data_get($roomType, 'ota:RoomDescription.ota:Text'),
                        ]);
                    }

                    $roomRates = Helpers::data_get($dataReservation, 'ota:RoomStays.ota:RoomStay.ota:RoomRates.ota:RoomRate.ota:Rates.ota:Rate');
                    if($roomRates) {
                        $rates = [];
                        foreach($roomRates as $roomRate) {
                            $rates[] = [
                                'AgeQualifyingCode' => Helpers::data_get($roomRate, '@attributes.AgeQualifyingCode'),
                                'EffectiveDate' => Helpers::data_get($roomRate, '@attributes.EffectiveDate'),
                                'ExpireDate' => Helpers::data_get($roomRate, '@attributes.ExpireDate'),
                                'AmountBeforeTax' => Helpers::data_get($roomRate, 'ota:Base.@attributes.AmountBeforeTax'),
                                'CurrencyCode' => Helpers::data_get($roomRate, 'ota:Base.@attributes.CurrencyCode'),
                                'DecimalPlaces' => Helpers::data_get($roomRate, 'ota:Base.@attributes.DecimalPlaces'),
                                'AdditionalGuestAmount' => [
                                    'AgeQualifyingCode' => Helpers::data_get($roomRate, 'ota:AdditionalGuestAmounts.ota:AdditionalGuestAmount.@attributes.AgeQualifyingCode'),
                                    'AmountBeforeTax' => Helpers::data_get($roomRate, 'ota:AdditionalGuestAmounts.ota:AdditionalGuestAmount.ota:Amount.@attributes.AmountBeforeTax'),
                                    'CurrencyCode' => Helpers::data_get($roomRate, 'ota:AdditionalGuestAmounts.ota:AdditionalGuestAmount.ota:Amount.@attributes.CurrencyCode'),
                                    'DecimalPlaces' => Helpers::data_get($roomRate, 'ota:AdditionalGuestAmounts.ota:AdditionalGuestAmount.ota:Amount.@attributes.DecimalPlaces'),
                                    'Text' => Helpers::data_get($roomRate, 'ota:AdditionalGuestAmounts.ota:AdditionalGuestAmount.ota:AddlGuestAmtDescription.ota:Text'),
                                ],
                            ];
                        }

                        $this->set('RoomRates', $rates);
                    }

                    $propertyInfo = Helpers::data_get($dataReservation, 'ota:RoomStays.ota:RoomStay.ota:BasicPropertyInfo');
                    if($propertyInfo) {
                        $contacts = [];
                        $contactNumbers = Helpers::data_get($propertyInfo, 'ota:ContactNumbers.ota:ContactNumber');
                        if($contactNumbers) {
                            foreach($contactNumbers as $contactNumber) {
                                $contacts[] = [
                                    'PhoneNumber' => Helpers::data_get($contactNumber, '@attributes.PhoneNumber'),
                                    'PhoneTechType' => Helpers::data_get($contactNumber, '@attributes.PhoneTechType'),
                                ];
                            } 
                        }

                        $this->set('propertyInfo', [
                            'HotelName' => Helpers::data_get($propertyInfo, '@attributes.HotelName'),
                            'Address' => [
                                'AddressLine' => Helpers::data_get($propertyInfo, 'ota:Address.ota:AddressLine.0'),
                                'AddressLine2' => Helpers::data_get($propertyInfo, 'ota:Address.ota:AddressLine.1'),
                                'CityName' => Helpers::data_get($propertyInfo, 'ota:Address.ota:CityName'),
                                'PostalCode' => Helpers::data_get($propertyInfo, 'ota:Address.ota:PostalCode'),
                                'StateProv' => Helpers::data_get($propertyInfo, 'ota:Address.ota:StateProv'),
                                'CountryName' => Helpers::data_get($propertyInfo, 'ota:Address.ota:CountryName'),
                            ],
                            'ContactNumbers' => $contacts,
                        ]);
                    }

                    $reservationGuests = Helpers::data_get($dataReservation, 'ota:ResGuests.ota:ResGuest');
                    if($reservationGuests) {
                        $resGuests = [];
                        foreach($reservationGuests as $reservationGuest) {
                            $profile = Helpers::data_get($reservationGuest, 'ota:Profiles.ota:ProfileInfo.ota:Profile');
                            
                            $contacts = [];
                            $contactNumbers = Helpers::data_get($profile, 'ota:Customer.ota:Telephone');
                            if($contactNumbers) {
                                foreach($contactNumbers as $contactNumber) {
                                    $contacts[] = [
                                        'PhoneNumber' => Helpers::data_get($contactNumber, '@attributes.PhoneNumber'),
                                        'PhoneTechType' => Helpers::data_get($contactNumber, '@attributes.PhoneTechType'),
                                    ];
                                } 
                            }

                            $resGuests[] = [
                                'ResGuestRPH' => Helpers::data_get($reservationGuest, '@attributes.ResGuestRPH'),
                                'NamePrefix' => Helpers::data_get($profile, 'ota:Customer.ota:PersonName.ota:NamePrefix'),
                                'GivenName' => Helpers::data_get($profile, 'ota:Customer.ota:PersonName.ota:GivenName'),
                                'Surname' => Helpers::data_get($profile, 'ota:Customer.ota:PersonName.ota:Surname'),
                                'NameSuffix' => Helpers::data_get($profile, 'ota:Customer.ota:PersonName.ota:NameSuffix'),
                                'Email' => Helpers::data_get($profile, 'ota:Customer.ota:Email'),
                                'Address' => [
                                    'AddressLine' => Helpers::data_get($profile, 'ota:Customer.ota:Address.ota:AddressLine.0'),
                                    'AddressLine2' => Helpers::data_get($profile, 'ota:Customer.ota:Address.ota:AddressLine.1'),
                                    'CityName' => Helpers::data_get($profile, 'ota:Customer.ota:Address.ota:CityName'),
                                    'PostalCode' => Helpers::data_get($profile, 'ota:Customer.ota:Address.ota:PostalCode'),
                                    'StateProv' => Helpers::data_get($profile, 'ota:Customer.ota:Address.ota:StateProv'),
                                    'CountryName' => Helpers::data_get($profile, 'ota:Customer.ota:Address.ota:CountryName'),
                                ],
                                'ContactNumbers' => $contacts,
                                'CompanyName' => Helpers::data_get($profile, 'ota:CompanyInfo.ota:CompanyName'),
                                'PhysChallFeaturePref' => Helpers::data_get($profile, 'ota:PrefCollections.ota:PrefCollection.ota:HotelPref.ota:PhysChallFeaturePref.@value'),
                                'PhysChallFeature' => Helpers::data_get($profile, 'ota:PrefCollections.ota:PrefCollection.ota:HotelPref.@attributes.PhysChallFeature'),
                                'SpecRequestPref' => Helpers::data_get($profile, 'ota:PrefCollections.ota:PrefCollection.ota:HotelPref.ota:SpecRequestPref'),
                            ];
                        }

                        $this->set('reservationGuests', $resGuests);
                    }

                    $globalInfo = Helpers::data_get($dataReservation, 'ota:ResGlobalInfo');
                    if($globalInfo) {

                        $comments = [];
                        $otaComments = Helpers::data_get($globalInfo, 'ota:Comments');
                        foreach($otaComments as $otaComment) {
                            $comments[] = [
                                'CommentOriginatorCode' => Helpers::data_get($otaComment, '@attributes.CommentOriginatorCode'),
                                'CreateDateTime' => Helpers::data_get($otaComment, '@attributes.CreateDateTime'),
                                'CreatorID' => Helpers::data_get($otaComment, '@attributes.CreatorID'),
                                'GuestViewable' => Helpers::data_get($otaComment, '@attributes.GuestViewable'),
                                'Text' => Helpers::data_get($otaComment, 'ota:Text'),
                            ];
                        }

                        $guarantee = Helpers::data_get($globalInfo, 'ota:Guarantee');
                        $paymentAccepted = Helpers::data_get($globalInfo, 'ota:Guarantee.ota:GuaranteesAccepted.ota:GuaranteeAccepted.ota:PaymentCard');

                        $globalReservationInfo = [
                            'GuestCount' => Helpers::data_get($globalInfo, 'ota:GuestCounts.ota:GuestCount.@attributes.Count'),
                            'StartDateWindow' => Helpers::data_get($globalInfo, 'ota:TimeSpan.ota:StartDateWindow.@attributes.EarliestDate'),
                            'EndDateWindow' => Helpers::data_get($globalInfo, 'ota:TimeSpan.ota:EndDateWindow.@attributes.LatestDate'),
                            'Comments' => $comments,
                            'Guarantee' => [
                                'GuaranteeCode' => Helpers::data_get($guarantee, '@attributes.GuaranteeCode'),
                                'PaymentCard' => [
                                    'CardCode' => Helpers::data_get($paymentAccepted, '@attributes.CardCode'),
                                    'CardNumber' => Helpers::data_get($paymentAccepted, '@attributes.CardNumber'),
                                    'ExpireDate' => Helpers::data_get($paymentAccepted, '@attributes.ExpireDate'),
                                    'CardHolderName' => Helpers::data_get($paymentAccepted, 'ota:CardHolderName'),
                                    'Address' => [
                                        'AddressLine' => Helpers::data_get($paymentAccepted, 'ota:Address.ota:AddressLine.0'),
                                        'AddressLine2' => Helpers::data_get($paymentAccepted, 'ota:Address.ota:AddressLine.1'),
                                        'CityName' => Helpers::data_get($paymentAccepted, 'ota:Address.ota:CityName'),
                                        'PostalCode' => Helpers::data_get($paymentAccepted, 'ota:Address.ota:PostalCode'),
                                        'StateProv' => Helpers::data_get($paymentAccepted, 'ota:Address.ota:StateProv'),
                                        'CountryName' => Helpers::data_get($paymentAccepted, 'ota:Address.ota:CountryName'),
                                    ],
                                ],
                            ],
                            'CancelPenalty' => Helpers::data_get($globalInfo, 'ota:CancelPenalties.ota:CancelPenalty.ota:PenaltyDescription.ota:Text'),
                            'HotelReservationID' => Helpers::data_get($globalInfo, 'ota:HotelReservationIDs.ota:HotelReservationID.0.@attributes.ResIDValue'),
                        ];

                        $this->set('globalInfo', $globalReservationInfo);
                    }

                    $tpaExtensions = Helpers::data_get($dataReservation, 'ota:TPA_Extensions');
                    if($tpaExtensions) {
                        $this->set('extensions', [
                            'EventID' => Helpers::data_get($tpaExtensions, 'ota:PK_Info.ota:EventID'),
                            'AttendeeCode' => Helpers::data_get($tpaExtensions, 'ota:PK_Info.ota:AttendeeCode'),
                            'RecordStatus' => Helpers::data_get($tpaExtensions, 'ota:PK_Info.ota:RecordStatus'),
                            'HowBooked' => Helpers::data_get($tpaExtensions, 'ota:PK_Info.ota:HowBooked'),
                            'ReceivedFrom' => Helpers::data_get($tpaExtensions, 'ota:PK_Info.ota:ReceivedFrom'),
                            'PaymentType' => Helpers::data_get($tpaExtensions, 'ota:PK_Info.ota:PaymentType'),
                            'BillPhone' => Helpers::data_get($tpaExtensions, 'ota:PK_Info.ota:BillPhone.@attributes.PhoneNumber'),
                            'PrimaryGuestRPH' => Helpers::data_get($tpaExtensions, 'ota:PK_Info.ota:PrimaryGuestRPH.0'),
                            'BlockId' => Helpers::data_get($tpaExtensions, 'ota:PK_Info.ota:BlockID.@attributes.Id'),
                        ]);
                    }
                }
                
            }
        }
        
        return $this;
    }

    public function __set($key, $value)
    {
        return $this->set($key, $value);
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }

    public function get($key, $default=null)
    {
        return $this->data[$key] ?? $default;
    }

    public function __get($key)
    {
        return $this->get($key);
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