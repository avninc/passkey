<?php

namespace Passkey\Common;

class AWS
{
  /**
   * Live API endpoint
   *
   * @var string
   */
    protected $live = 'https://aws.passkey.com';
   
   /**
    * Development API endpoint
    *
    * @var string
    */
    protected $development = 'https://uat-aws.passkey.com';

    protected $debug = false;

    protected $bridgeId;

    protected $eventId;

    public function __construct($bridgeId, $eventId = null, $debug = false)
    {
        $this->setDebug($debug)
            ->setBridgeId($bridgeId)
            ->setEventId($eventId);
    }

    public function endpoint()
    {
        return $this->debug ? $this->development : $this->live;
    }

    public function registration()
    {
        return sprintf('%s/reg/%s', $this->endpoint(), $this->getBridgeId());
    }

    public function view()
    {
        return sprintf('%s/event/%s/owner/100/r/%s', $this->endpoint(), $this->getEventId(), $this->getBridgeId());
    }

    public function modify()
    {
        return sprintf('%s/event/%s/owner/100/r/edit/%s', $this->endpoint(), $this->getEventId(), $this->getBridgeId());
    }

    public function cancel()
    {
        return sprintf('%s/event/%s/owner/100/r/%s#cancel-reservation', $this->endpoint(), $this->getEventId(), $this->getBridgeId());
    }

    /**
     * @return string
     */
    public function getLive()
    {
        return $this->live;
    }

    /**
     * @param string $live
     *
     * @return self
     */
    public function setLive($live)
    {
        $this->live = $live;

        return $this;
    }

    /**
     * @return string
     */
    public function getDevelopment()
    {
        return $this->development;
    }

    /**
     * @param string $development
     *
     * @return self
     */
    public function setDevelopment($development)
    {
        $this->development = $development;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDebug()
    {
        return $this->debug;
    }

    /**
     * @param mixed $isDebug
     *
     * @return self
     */
    public function setDebug($isDebug)
    {
        $this->debug = $isDebug;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBridgeId()
    {
        return $this->bridgeId;
    }
 
     /**
      * @param mixed $bridgeId
      *
      * @return self
      */
    public function setBridgeId($bridgeId)
    {
        $this->bridgeId = $bridgeId;
 
        return $this;
    }

     /**
     * @return mixed
     */
    public function getEventId()
    {
        return $this->eventId;
    }
 
     /**
      * @param mixed $eventId
      *
      * @return self
      */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
 
        return $this;
    }
}
