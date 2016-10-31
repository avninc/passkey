<?php

namespace Passkey\Reservation\Model;

use Passkey\Common\Element;

class OtherPayment extends Element
{
    protected $Amount;
    protected $OPayDate;
    protected $OPayReferenceNum;
    protected $OPayCheckNum;
    protected $OPayReceived;
    protected $OPayComments;
    protected $OPayName;
    protected $PhoneNumber;

    protected $AddressLine;
    protected $AddressLine2;
    protected $CityName;
    protected $StateProv;
    protected $PostalCode;
    protected $CountryCode;
    protected $CountryName;

    public function __construct(array $params=[])
    {
        $params = [
          'OtherPayment' => [
            'OPayAmt' => [
              'attributes' => [
                'Amount' => $params['Amount'] ?? null,
              ],
            ],
            'OPayDate' => $params['OPayDate'] ?? null,
            'OPayReferenceNum' => $params['OPayReferenceNum'] ?? null,
            'OPayCheckNum' => $params['OPayCheckNum'] ?? null,
            'OPayReceived' => $params['OPayReceived'] ?? null,
            'OPayComments' => $params['OPayComments'] ?? null,
            'OPayName' => $params['OPayName'] ?? null,
            'OBillAddress' => [
              'AddressLine' => $params['AddressLine'] ?? null,
              'AddressLine2' => $params['AddressLine2'] ?? null,
              'CityName' => $params['CityName'] ?? null,
              'StateProv' => $params['StateProv'] ?? null,
              'PostalCode' => $params['PostalCode'] ?? null,
              'CountryName' => [
                'attributes' => [
                  'Code' => $params['CountryCode'] ?? null,
                ],
                'value' => $params['CountryName'] ?? null,
              ],
            ],
            'OPhone' => [
              'attributes' => [
                'PhoneNumber' => $params['PhoneNumber'] ?? null,
              ],
            ],
          ],
        ];

        $this->setParams($params);

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
     * Gets the value of Amount.
     *
     * @return mixed
     */
    public function getAmount()
    {
        return $this->Amount;
    }

    /**
     * Sets the value of Amount.
     *
     * @param mixed $Amount the amount
     *
     * @return self
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;
        $this->set('Amount', $Amount);

        return $this;
    }

    /**
     * Gets the value of OPayDate.
     *
     * @return mixed
     */
    public function getOPayDate()
    {
        return $this->OPayDate;
    }

    /**
     * Sets the value of OPayDate.
     *
     * @param mixed $OPayDate the opay date
     *
     * @return self
     */
    public function setOPayDate($OPayDate)
    {
        $this->OPayDate = $OPayDate;
        $this->set('OPayDate', $OPayDate);

        return $this;
    }

    /**
     * Gets the value of OPayReferenceNum.
     *
     * @return mixed
     */
    public function getOPayReferenceNum()
    {
        return $this->OPayReferenceNum;
    }

    /**
     * Sets the value of OPayReferenceNum.
     *
     * @param mixed $OPayReferenceNum the opay reference num
     *
     * @return self
     */
    public function setOPayReferenceNum($OPayReferenceNum)
    {
        $this->OPayReferenceNum = $OPayReferenceNum;
        $this->set('OPayReferenceNum', $OPayReferenceNum);

        return $this;
    }

    /**
     * Gets the value of OPayCheckNum.
     *
     * @return mixed
     */
    public function getOPayCheckNum()
    {
        return $this->OPayCheckNum;
    }

    /**
     * Sets the value of OPayCheckNum.
     *
     * @param mixed $OPayCheckNum the opay check num
     *
     * @return self
     */
    public function setOPayCheckNum($OPayCheckNum)
    {
        $this->OPayCheckNum = $OPayCheckNum;
        $this->set('OPayCheckNum', $OPayCheckNum);

        return $this;
    }

    /**
     * Gets the value of OPayReceived.
     *
     * @return mixed
     */
    public function getOPayReceived()
    {
        return $this->OPayReceived;
    }

    /**
     * Sets the value of OPayReceived.
     *
     * @param mixed $OPayReceived the opay received
     *
     * @return self
     */
    public function setOPayReceived($OPayReceived)
    {
        $this->OPayReceived = $OPayReceived;
        $this->set('OPayReceived', $OPayReceived);

        return $this;
    }

    /**
     * Gets the value of OPayComments.
     *
     * @return mixed
     */
    public function getOPayComments()
    {
        return $this->OPayComments;
    }

    /**
     * Sets the value of OPayComments.
     *
     * @param mixed $OPayComments the opay comments
     *
     * @return self
     */
    public function setOPayComments($OPayComments)
    {
        $this->OPayComments = $OPayComments;
        $this->set('OPayComments', $OPayComments);

        return $this;
    }

    /**
     * Gets the value of OPayName.
     *
     * @return mixed
     */
    public function getOPayName()
    {
        return $this->OPayName;
    }

    /**
     * Sets the value of OPayName.
     *
     * @param mixed $OPayName the opay name
     *
     * @return self
     */
    public function setOPayName($OPayName)
    {
        $this->OPayName = $OPayName;
        $this->set('OPayName', $OPayName);

        return $this;
    }

    /**
     * Gets the value of PhoneNumber.
     *
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->PhoneNumber;
    }

    /**
     * Sets the value of PhoneNumber.
     *
     * @param mixed $PhoneNumber the phone number
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
     * Gets the value of CountryCode.
     *
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->CountryCode;
    }

    /**
     * Sets the value of CountryCode.
     *
     * @param mixed $CountryCode the country code
     *
     * @return self
     */
    public function setCountryCode($CountryCode)
    {
        $this->CountryCode = $CountryCode;
        $this->set('CountryCode', $CountryCode);

        return $this;
    }
}
