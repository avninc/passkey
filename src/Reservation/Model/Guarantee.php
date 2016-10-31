<?php

namespace Passkey\Reservation\Model;

use Passkey\Common\Element;

class Guarantee extends Element
{
    protected $CardNumber;
    protected $ExpireDate;
    protected $CardType;
    protected $CardHolderName;
    protected $AddressLine;
    protected $AddressLine2;
    protected $CityName;
    protected $StateProv;
    protected $PostalCode;
    protected $CountryName;

    public function __construct(array $params=[])
    {
        $params = [
          'GuaranteesAccepted' => [
            'GuaranteeAccepted' => [
              'PaymentCard' => [
                'attributes' => [
                  'CardNumber' => $params['CardNumber'] ?? null,
                  'ExpireDate' => $params['ExpireDate'] ?? null,
                  'CardType' => $params['CardType'] ?? null,
                ],
                'value' => [
                  'CardHolderName' => $params['CardHolderName'] ?? null,
                  'Address' => [
                    'AddressLine' => $params['AddressLine'] ?? null,
                    'AddressLine2' => $params['AddressLine2'] ?? null,
                    'CityName' => $params['CityName'] ?? null,
                    'StateProv' => $params['StateProv'] ?? null,
                    'PostalCode' => $params['PostalCode'] ?? null,
                    'CountryName' => $params['CountryName'] ?? null,
                  ],
                ],
              ],
            ],
          ],
        ];

        $this->setParams($params);

        return $this;
    }

    /**
     * Gets the value of CardNumber.
     *
     * @return mixed
     */
    public function getCardNumber()
    {
        return $this->CardNumber;
    }

    /**
     * Sets the value of CardNumber.
     *
     * @param mixed $CardNumber the card number
     *
     * @return self
     */
    public function setCardNumber($CardNumber)
    {
        $this->CardNumber = $CardNumber;
        $this->set('CardNumber', $CardNumber);

        return $this;
    }

    /**
     * Gets the value of ExpireDate.
     *
     * @return mixed
     */
    public function getExpireDate()
    {
        return $this->ExpireDate;
    }

    /**
     * Sets the value of ExpireDate.
     *
     * @param mixed $ExpireDate the expire date
     *
     * @return self
     */
    public function setExpireDate($ExpireDate)
    {
        $this->ExpireDate = $ExpireDate;
        $this->set('ExpireDate', $ExpireDate);

        return $this;
    }

    /**
     * Gets the value of CardType.
     *
     * @return mixed
     */
    public function getCardType()
    {
        return $this->CardType;
    }

    /**
     * Sets the value of CardType.
     *
     * @param mixed $CardType the card type
     *
     * @return self
     */
    public function setCardType($CardType)
    {
        $this->CardType = $CardType;
        $this->set('CardType', $CardType);

        return $this;
    }

    /**
     * Gets the value of CardHolderName.
     *
     * @return mixed
     */
    public function getCardHolderName()
    {
        return $this->CardHolderName;
    }

    /**
     * Sets the value of CardHolderName.
     *
     * @param mixed $CardHolderName the card holder name
     *
     * @return self
     */
    public function setCardHolderName($CardHolderName)
    {
        $this->CardHolderName = $CardHolderName;
        $this->set('CardHolderName', $CardHolderName);

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
}
