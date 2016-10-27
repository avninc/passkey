<?php

namespace Passkey\Common;

class RoomStay extends Element
{
    protected $NumberOfUnits = 1;
    protected $AgeQualifyingCode = 1;
    protected $Count = 2;

    public function __construct(array $params=[])
    {
        $params = [
          'RoomStay' => [
            'attributes' => [],
            'value' => [
              'RoomTypes' => [
                'RoomType' => [
                  'attributes' => [
                    'NumberOfUnits' => $params['NumberOfUnits'] ?? $this->getNumberOfUnits()
                  ],
                ],
              ],
              'GuestCounts' => [
                'GuestCount' => [
                  'attributes' => [
                    'AgeQualifyingCode' => $params['AgeQualifyingCode'] ?? $this->getAgeQualifyingCode(),
                    'Count' => $params['Count'] ?? $this->getCount()
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
     * Gets the value of NumberOfUnits.
     *
     * @return mixed
     */
    public function getNumberOfUnits()
    {
        return $this->NumberOfUnits;
    }

    /**
     * Sets the value of NumberOfUnits.
     *
     * @param mixed $NumberOfUnits the number of units
     *
     * @return self
     */
    public function setNumberOfUnits($NumberOfUnits)
    {
        $this->NumberOfUnits = $NumberOfUnits;
        $this->set('NumberOfUnits', $NumberOfUnits);

        return $this;
    }

    /**
     * Gets the value of AgeQualifyingCode.
     *
     * @return mixed
     */
    public function getAgeQualifyingCode()
    {
        return $this->AgeQualifyingCode;
    }

    /**
     * Sets the value of AgeQualifyingCode.
     *
     * @param mixed $AgeQualifyingCode the age qualifying code
     *
     * @return self
     */
    public function setAgeQualifyingCode($AgeQualifyingCode)
    {
        $this->AgeQualifyingCode = $AgeQualifyingCode;
        $this->set('AgeQualifyingCode', $AgeQualifyingCode);

        return $this;
    }

    /**
     * Gets the value of Count.
     *
     * @return mixed
     */
    public function getCount()
    {
        return $this->Count;
    }

    /**
     * Sets the value of Count.
     *
     * @param mixed $Count the count
     *
     * @return self
     */
    public function setCount($Count)
    {
        $this->Count = $Count;
        $this->set('Count', $Count);

        return $this;
    }
}
