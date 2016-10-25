<?php

namespace Passkey\Common;

class Guest extends Element
{
    protected $NamePrefix;
    protected $Surname;
    protected $GivenName;
    protected $MiddleName;

    protected $AddressLine;
    protected $AddressLine2;
    protected $CityName;
    protected $StateProv;
    protected $PostalCode;
    protected $CountryName;
    protected $PhoneNumber;
    protected $PhoneTechType;
    protected $Email;
    protected $CompanyName;
    protected $EmployeeInfo;
    protected $FaxNumber;
    protected $FaxTechType;

    protected $SmokingAllowed;
    protected $SpecRequestPref;
    protected $PhysChallFeaturePref;

    protected static $count = 1;

    public function __construct(array $params=[])
    {
        $params = [
          'ResGuest' => [
            'attributes' => ['ResGuestRPH' => static::$count],
            'value' => [
              'Profiles' => [
                'ProfileInfo' => [
                  'Profile' => [
                    'Customer' => [
                      'PersonName' => [
                        'NamePrefix' => $params['NamePrefix'] ?? null,
                        'GivenName' => $params['GivenName'] ?? null,
                        'MiddleName' => $params['MiddleName'] ?? null,
                        'Surname' => $params['Surname'] ?? null,
                      ],
                      'Telephone' => [
                        'attributes' => [
                          'PhoneNumber' => $params['PhoneNumber'] ?? null,
                          'PhoneTechType' => $params['PhoneTechType'] ?? null,
                        ],
                      ],
                      'FaxTelephone' => [
                        'attributes' => [
                          'FaxNumber' => $params['FaxNumber'] ?? null,
                          'FaxTechType' => $params['FaxTechType'] ?? null,
                        ],
                      ],
                      'Email' => $params['Email'] ?? null,
                      'Address' => [
                        'AddressLine' => $params['AddressLine'] ?? null,
                        'AddressLine2' => $params['AddressLine2'] ?? null,
                        'CityName' => $params['CityName'] ?? null,
                        'StateProv' => $params['StateProv'] ?? null,
                        'PostalCode' => $params['PostalCode'] ?? null,
                        'CountryName' => $params['CountryName'] ?? null,
                      ],
                      'EmployeeInfo' => $params['EmployeeInfo'] ?? null,
                    ],
                    'PrefCollections' => [
                      'PrefCollection' => [
                        'HotelPref' => [
                          'value' => [
                            'PhysChallFeaturePref' => $params['PhysChallFeaturePref'] ?? 0,
                            'SpecRequestPref' => $params['SpecRequestPref'] ?? null,
                          ],
                          'attributes' => [
                            'SmokingAllowed' => $params['SmokingAllowed'] ?? 0
                          ],
                        ],
                      ],
                    ],
                    'CompanyInfo' => [
                      'CompanyName' => $params['CompanyName'] ?? null,
                    ],
                  ],
                ],
              ],
            ],
          ],
        ];

        $this->setParams($params);
        static::$count++;

        return $this;
    }

    /**
     * Gets the value of NamePrefix.
     *
     * @return mixed
     */
    public function getNamePrefix()
    {
        return $this->NamePrefix;
    }

    /**
     * Sets the value of NamePrefix.
     *
     * @param mixed $NamePrefix the name prefix
     *
     * @return self
     */
    public function setNamePrefix($NamePrefix)
    {
        $this->NamePrefix = $NamePrefix;
        $this->set('NamePrefix', $NamePrefix);

        return $this;
    }

    /**
     * Gets the value of Surname.
     *
     * @return mixed
     */
    public function getSurname()
    {
        return $this->Surname;
    }

    /**
     * Sets the value of Surname.
     *
     * @param mixed $Surname the surname
     *
     * @return self
     */
    public function setSurname($Surname)
    {
        $this->Surname = $Surname;
        $this->set('Surname', $Surname);

        return $this;
    }

    /**
     * Gets the value of GivenName.
     *
     * @return mixed
     */
    public function getGivenName()
    {
        return $this->GivenName;
    }

    /**
     * Sets the value of GivenName.
     *
     * @param mixed $GivenName the given name
     *
     * @return self
     */
    public function setGivenName($GivenName)
    {
        $this->GivenName = $GivenName;
        $this->set('GivenName', $GivenName);

        return $this;
    }

    /**
     * Gets the value of MiddleName.
     *
     * @return mixed
     */
    public function getMiddleName()
    {
        return $this->MiddleName;
    }

    /**
     * Sets the value of MiddleName.
     *
     * @param mixed $MiddleName the middle name
     *
     * @return self
     */
    public function setMiddleName($MiddleName)
    {
        $this->MiddleName = $MiddleName;
        $this->set('MiddleName', $MiddleName);

        return $this;
    }

    /**
     * Gets the value of AddressLine.
     *
     * @return mixed
     */
    public function getAddressLine()
    {
        return $this->AddressLine;
    }

    /**
     * Sets the value of AddressLine.
     *
     * @param mixed $AddressLine the address line
     *
     * @return self
     */
    public function setAddressLine($AddressLine)
    {
        $this->AddressLine = $AddressLine;
        $this->set('AddressLine', $AddressLine);

        return $this;
    }

    /**
     * Gets the value of AddressLine2.
     *
     * @return mixed
     */
    public function getAddressLine2()
    {
        return $this->AddressLine2;
    }

    /**
     * Sets the value of AddressLine2.
     *
     * @param mixed $AddressLine2 the address line2
     *
     * @return self
     */
    public function setAddressLine2($AddressLine2)
    {
        $this->AddressLine2 = $AddressLine2;
        $this->set('AddressLine2', $AddressLine2);

        return $this;
    }

    /**
     * Gets the value of CityName.
     *
     * @return mixed
     */
    public function getCityName()
    {
        return $this->CityName;
    }

    /**
     * Sets the value of CityName.
     *
     * @param mixed $CityName the city name
     *
     * @return self
     */
    public function setCityName($CityName)
    {
        $this->CityName = $CityName;
        $this->set('CityName', $CityName);

        return $this;
    }

    /**
     * Gets the value of StateProv.
     *
     * @return mixed
     */
    public function getStateProv()
    {
        return $this->StateProv;
    }

    /**
     * Sets the value of StateProv.
     *
     * @param mixed $StateProv the state prov
     *
     * @return self
     */
    public function setStateProv($StateProv)
    {
        $this->StateProv = $StateProv;
        $this->set('StateProv', $StateProv);

        return $this;
    }

    /**
     * Gets the value of PostalCode.
     *
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->PostalCode;
    }

    /**
     * Sets the value of PostalCode.
     *
     * @param mixed $PostalCode the postal code
     *
     * @return self
     */
    public function setPostalCode($PostalCode)
    {
        $this->PostalCode = $PostalCode;
        $this->set('PostalCode', $PostalCode);

        return $this;
    }

    /**
     * Gets the value of CountryName.
     *
     * @return mixed
     */
    public function getCountryName()
    {
        return $this->CountryName;
    }

    /**
     * Sets the value of CountryName.
     *
     * @param mixed $CountryName the country name
     *
     * @return self
     */
    public function setCountryName($CountryName)
    {
        $this->CountryName = $CountryName;
        $this->set('CountryName', $CountryName);

        return $this;
    }

    /**
     * Gets the value of Telephone.
     *
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->PhoneNumber;
    }

    /**
     * Sets the value of Telephone.
     *
     * @param mixed $Telephone the telephone
     *
     * @return self
     */
    public function setPhoneNumber($PhoneNumber)
    {
        $this->PhoneNumber = $PhoneNumber;
        $this->set('PhoneNumber', $PhoneNumber);

        return $this;
    }

    /**
     * Gets the value of Telephone.
     *
     * @return mixed
     */
    public function getPhoneTechType()
    {
        return $this->PhoneTechType;
    }

    /**
     * Sets the value of Telephone.
     *
     * @param mixed $Telephone the telephone
     *
     * @return self
     */
    public function setPhoneTechType($PhoneTechType)
    {
        $this->PhoneTechType = $PhoneTechType;
        $this->set('PhoneTechType', $PhoneTechType);

        return $this;
    }

    /**
     * Gets the value of Telephone.
     *
     * @return mixed
     */
    public function getFaxNumber()
    {
        return $this->FaxNumber;
    }

    /**
     * Sets the value of Telephone.
     *
     * @param mixed $Telephone the telephone
     *
     * @return self
     */
    public function setFaxNumber($FaxNumber)
    {
        $this->FaxNumber = $FaxNumber;
        $this->set('FaxNumber', $FaxNumber);

        return $this;
    }

    /**
     * Gets the value of Telephone.
     *
     * @return mixed
     */
    public function getFaxTechType()
    {
        return $this->FaxTechType;
    }

    /**
     * Sets the value of Telephone.
     *
     * @param mixed $Telephone the telephone
     *
     * @return self
     */
    public function setFaxTechType($FaxTechType)
    {
        $this->FaxTechType = $FaxTechType;
        $this->set('FaxTechType', $FaxTechType);

        return $this;
    }

    /**
     * Gets the value of Email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * Sets the value of Email.
     *
     * @param mixed $Email the email
     *
     * @return self
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
        $this->set('Email', $Email);

        return $this;
    }

    /**
     * Gets the value of CompanyName.
     *
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->CompanyName;
    }

    /**
     * Sets the value of CompanyName.
     *
     * @param mixed $CompanyName the company name
     *
     * @return self
     */
    public function setCompanyName($CompanyName)
    {
        $this->CompanyName = $CompanyName;
        $this->set('CompanyName', $CompanyName);

        return $this;
    }

    /**
     * Gets the value of EmployeeInfo.
     *
     * @return mixed
     */
    public function getEmployeeInfo()
    {
        return $this->EmployeeInfo;
    }

    /**
     * Sets the value of EmployeeInfo.
     *
     * @param mixed $EmployeeInfo the employee info
     *
     * @return self
     */
    public function setEmployeeInfo($EmployeeInfo)
    {
        $this->EmployeeInfo = $EmployeeInfo;
        $this->set('EmployeeInfo', $EmployeeInfo);

        return $this;
    }

    /**
     * Gets the value of SmokingAllowed.
     *
     * @return mixed
     */
    public function getSmokingAllowed()
    {
        return $this->SmokingAllowed;
    }

    /**
     * Sets the value of SmokingAllowed.
     *
     * @param mixed $SmokingAllowed the smoking allowed
     *
     * @return self
     */
    public function setSmokingAllowed($SmokingAllowed)
    {
        $this->SmokingAllowed = $SmokingAllowed;
        $this->set('SmokingAllowed', $SmokingAllowed);

        return $this;
    }

    /**
     * Gets the value of SpecRequestPref.
     *
     * @return mixed
     */
    public function getSpecRequestPref()
    {
        return $this->SpecRequestPref;
    }

    /**
     * Sets the value of SpecRequestPref.
     *
     * @param mixed $SpecRequestPref the spec request pref
     *
     * @return self
     */
    public function setSpecRequestPref($SpecRequestPref)
    {
        $this->SpecRequestPref = $SpecRequestPref;
        $this->set('SpecRequestPref', $SpecRequestPref);

        return $this;
    }

    /**
     * Gets the value of PhysChallFeaturePref.
     *
     * @return mixed
     */
    public function getPhysChallFeaturePref()
    {
        return $this->PhysChallFeaturePref;
    }

    /**
     * Sets the value of PhysChallFeaturePref.
     *
     * @param mixed $PhysChallFeaturePref the phys chall feature pref
     *
     * @return self
     */
    public function setPhysChallFeaturePref($PhysChallFeaturePref)
    {
        $this->PhysChallFeaturePref = $PhysChallFeaturePref;
        $this->set('PhysChallFeaturePref', $PhysChallFeaturePref);

        return $this;
    }

    /**
     * Gets the value of count.
     *
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Sets the value of count.
     *
     * @param mixed $count the count
     *
     * @return self
     */
    protected function setCount($count)
    {
        $this->count = $count;

        return $this;
    }
}
