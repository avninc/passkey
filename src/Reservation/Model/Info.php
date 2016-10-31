<?php

namespace Passkey\Reservation\Model;

use Passkey\Common\Element;

class Info extends Element
{
    protected $EventID;
    protected $AttendeeCode;
    protected $SendAck;
    protected $ExtReferenceID;
    protected $ResSplitFolioTypeId;
    protected $HowBooked;
    protected $ReceivedFrom;
    protected $PaymentType;
    protected $BlockID;
    protected $PhoneNumber;
    protected $PrimaryGuestRPH;
    protected $CustomFields = [];
    protected $Referrer;
    protected $OtherPayment;

    public function __construct(array $params=[])
    {
        $items = [
          'PK_Info' => [
            'EventID' => $params['EventID'] ?? null,
            'AttendeeCode' => $params['AttendeeCode'] ?? null,
            'SendAck' => $params['SendAck'] ?? null,
            'ExtReferenceID' => $params['ExtReferenceID'] ?? null,
            'ResSplitFolioTypeId' => $params['ResSplitFolioTypeId'] ?? null,
            'HowBooked' => $params['HowBooked'] ?? null,
            'ReceivedFrom' => $params['ReceivedFrom'] ?? null,
            'PaymentType' => $params['PaymentType'] ?? null,
            'BlockID' => $params['BlockID'] ?? null,
            'BillPhone' => [
              'attributes' => [
                'PhoneNumber' => $params['PhoneNumber'] ?? null,
              ],
            ],
            'PrimaryGuestRPH' => $params['PrimaryGuestRPH'] ?? null,
            'CustomFields' => null,
            'Referrer' => $params['Referrer'] ?? null,
          ],
        ];

        $this->setParams($items);

        if(isset($params['CustomFields']) && is_array($params['CustomFields'])) {
          $this->setCustomFields($params['CustomFields']);
        }

        if(isset($params['OtherPayment']) && $params['OtherPayment'] instanceof OtherPayment) {
          $this->setOtherPayment($params['OtherPayment']);
        }

        return $this;
    }

    /**
     * Gets the value of EventID.
     *
     * @return mixed
     */
    public function getEventID()
    {
        return $this->EventID;
    }

    /**
     * Sets the value of EventID.
     *
     * @param mixed $EventID the event
     *
     * @return self
     */
    public function setEventID($EventID)
    {
        $this->EventID = $EventID;
        $this->set('EventID', $EventID);

        return $this;
    }

    /**
     * Gets the value of AttendeeCode.
     *
     * @return mixed
     */
    public function getAttendeeCode()
    {
        return $this->AttendeeCode;
    }

    /**
     * Sets the value of AttendeeCode.
     *
     * @param mixed $AttendeeCode the attendee code
     *
     * @return self
     */
    public function setAttendeeCode($AttendeeCode)
    {
        $this->AttendeeCode = $AttendeeCode;
        $this->set('AttendeeCode', $AttendeeCode);

        return $this;
    }

    /**
     * Gets the value of SendAck.
     *
     * @return mixed
     */
    public function getSendAck()
    {
        return $this->SendAck;
    }

    /**
     * Sets the value of SendAck.
     *
     * @param mixed $SendAck the send ack
     *
     * @return self
     */
    public function setSendAck($SendAck)
    {
        $this->SendAck = $SendAck;
        $this->set('SendAck', $SendAck);

        return $this;
    }

    /**
     * Gets the value of ExtReferenceID.
     *
     * @return mixed
     */
    public function getExtReferenceID()
    {
        return $this->ExtReferenceID;
    }

    /**
     * Sets the value of ExtReferenceID.
     *
     * @param mixed $ExtReferenceID the ext reference
     *
     * @return self
     */
    public function setExtReferenceID($ExtReferenceID)
    {
        $this->ExtReferenceID = $ExtReferenceID;
        $this->set('ExtReferenceID', $ExtReferenceID);

        return $this;
    }

    /**
     * Gets the value of ResSplitFolioTypeId.
     *
     * @return mixed
     */
    public function getResSplitFolioTypeId()
    {
        return $this->ResSplitFolioTypeId;
    }

    /**
     * Sets the value of ResSplitFolioTypeId.
     *
     * @param mixed $ResSplitFolioTypeId the res split folio type id
     *
     * @return self
     */
    public function setResSplitFolioTypeId($ResSplitFolioTypeId)
    {
        $this->ResSplitFolioTypeId = $ResSplitFolioTypeId;
        $this->set('ResSplitFolioTypeId', $ResSplitFolioTypeId);

        return $this;
    }

    /**
     * Gets the value of HowBooked.
     *
     * @return mixed
     */
    public function getHowBooked()
    {
        return $this->HowBooked;
    }

    /**
     * Sets the value of HowBooked.
     *
     * @param mixed $HowBooked the how booked
     *
     * @return self
     */
    public function setHowBooked($HowBooked)
    {
        $this->HowBooked = $HowBooked;
        $this->set('HowBooked', $HowBooked);

        return $this;
    }

    /**
     * Gets the value of ReceivedFrom.
     *
     * @return mixed
     */
    public function getReceivedFrom()
    {
        return $this->ReceivedFrom;
    }

    /**
     * Sets the value of ReceivedFrom.
     *
     * @param mixed $ReceivedFrom the received from
     *
     * @return self
     */
    public function setReceivedFrom($ReceivedFrom)
    {
        $this->ReceivedFrom = $ReceivedFrom;
        $this->set('ReceivedFrom', $ReceivedFrom);

        return $this;
    }

    /**
     * Gets the value of PaymentType.
     *
     * @return mixed
     */
    public function getPaymentType()
    {
        return $this->PaymentType;
    }

    /**
     * Sets the value of PaymentType.
     *
     * @param mixed $PaymentType the payment type
     *
     * @return self
     */
    public function setPaymentType($PaymentType)
    {
        $this->PaymentType = $PaymentType;
        $this->set('PaymentType', $PaymentType);

        return $this;
    }

    /**
     * Gets the value of BlockID.
     *
     * @return mixed
     */
    public function getBlockID()
    {
        return $this->BlockID;
    }

    /**
     * Sets the value of BlockID.
     *
     * @param mixed $BlockID the block
     *
     * @return self
     */
    public function setBlockID($BlockID)
    {
        $this->BlockID = $BlockID;
        $this->set('BlockID', $BlockID);

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
     * Gets the value of PrimaryGuestRPH.
     *
     * @return mixed
     */
    public function getPrimaryGuestRPH()
    {
        return $this->PrimaryGuestRPH;
    }

    /**
     * Sets the value of PrimaryGuestRPH.
     *
     * @param mixed $PrimaryGuestRPH the primary guest
     *
     * @return self
     */
    public function setPrimaryGuestRPH($PrimaryGuestRPH)
    {
        $this->PrimaryGuestRPH = $PrimaryGuestRPH;
        $this->set('PrimaryGuestRPH', $PrimaryGuestRPH);

        return $this;
    }

    /**
     * Gets the value of customFields.
     *
     * @return mixed
     */
    public function getCustomFields()
    {
        return $this->CustomFields;
    }

    /**
     * Sets the value of customFields.
     *
     * @param mixed $customFields the custom fields
     *
     * @return self
     */
    public function setCustomFields(array $customFields)
    {
        $this->CustomFields = $customFields;
        $i = 1;
        foreach($this->CustomFields as $field) {
          $this->params['PK_Info']['CustomFields']['CustomField' . $i] = $field;
          $i++;
        }

        return $this;
    }

    /**
     * Gets the value of Referrer.
     *
     * @return mixed
     */
    public function getReferrer()
    {
        return $this->Referrer;
    }

    /**
     * Sets the value of Referrer.
     *
     * @param mixed $Referrer the referrer
     *
     * @return self
     */
    public function setReferrer($Referrer)
    {
        $this->Referrer = $Referrer;
        $this->set('Referrer', $Referrer);

        return $this;
    }

    /**
     * Gets the value of OtherPayment.
     *
     * @return mixed
     */
    public function getOtherPayment()
    {
        return $this->OtherPayment;
    }

    /**
     * Sets the value of OtherPayment.
     *
     * @param mixed $OtherPayment the guarantee
     *
     * @return self
     */
    public function setOtherPayment(OtherPayment $OtherPayment)
    {
        $this->OtherPayment = $OtherPayment;
        $this->params['PK_Info'] += $OtherPayment->getParams();
        return $this;
    }
}
