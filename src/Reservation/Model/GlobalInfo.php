<?php

namespace Passkey\Reservation\Model;

use Passkey\Common\Element;

class GlobalInfo extends Element
{
    protected $AgeQualifyingCode;
    protected $Count;
    protected $EarliestDate;
    protected $LatestDate;
    protected $Text;
    protected $Guarantee;

    public function __construct(array $params=[])
    {
        $items = [
          'GuestCounts' => [
            'GuestCount' => [
              'attributes' => [
                'AgeQualifyingCode' => $params['AgeQualifyingCode'] ?? null,
                'Count' => $params['Count'] ?? null,
              ],
            ],
          ],
          'TimeSpan' => [
            'StartDateWindow' => [
              'attributes' => [
                'EarliestDate' => $params['EarliestDate'] ?? null,
                'LatestDate' => $params['LatestDate'] ?? null,
              ],
            ],
          ],
          'ResGuestRPHs' => [],
          'Memberships' => [],
          'SpecialRequests' => [
            'SpecialRequest' => [
              'Text' => $params['Text'] ?? null,
            ],
          ],
        ];

        if((isset($params['Guarantee']) && $params['Guarantee'] instanceof Guarantee)) {
          $items['Guarantee'] = $params['Guarantee']->getParams();
        }

        $this->setParams($items);

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

    /**
     * Gets the value of EarliestDate.
     *
     * @return mixed
     */
    public function getEarliestDate()
    {
        return $this->EarliestDate;
    }

    /**
     * Sets the value of EarliestDate.
     *
     * @param mixed $EarliestDate the earliest date
     *
     * @return self
     */
    public function setEarliestDate($EarliestDate)
    {
        $this->EarliestDate = $EarliestDate;
        $this->set('EarliestDate', $EarliestDate);

        return $this;
    }

    /**
     * Gets the value of LatestDate.
     *
     * @return mixed
     */
    public function getLatestDate()
    {
        return $this->LatestDate;
    }

    /**
     * Sets the value of LatestDate.
     *
     * @param mixed $LatestDate the latest date
     *
     * @return self
     */
    public function setLatestDate($LatestDate)
    {
        $this->LatestDate = $LatestDate;
        $this->set('LatestDate', $LatestDate);

        return $this;
    }

    /**
     * Gets the value of Text.
     *
     * @return mixed
     */
    public function getText()
    {
        return $this->Text;
    }

    /**
     * Sets the value of Text.
     *
     * @param mixed $Text the text
     *
     * @return self
     */
    public function setText($Text)
    {
        $this->Text = $Text;
        $this->set('Text', $Text);

        return $this;
    }

    /**
     * Gets the value of Guarantee.
     *
     * @return mixed
     */
    public function getGuarantee()
    {
        return $this->Guarantee;
    }

    /**
     * Sets the value of Guarantee.
     *
     * @param mixed $Guarantee the guarantee
     *
     * @return self
     */
    public function setGuarantee(Guarantee $Guarantee)
    {
        $this->Guarantee = $Guarantee;
        $this->params['Guarantee'] = $Guarantee->getParams();

        return $this;
    }
}
