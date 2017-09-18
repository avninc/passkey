<?php

namespace Passkey\Common;

class Endpoint
{
  /**
   * Live API endpoint
   *
   * @var string
   */
    protected $live = 'https://api.passkey.com';
   
   /**
    * Development API endpoint
    *
    * @var string
    */
    protected $development = 'https://uat-api.passkey.com';

    protected $debug = false;

    public function __construct($debug=false)
    {
        $this->setDebug($debug);
    }

    public function endpoint()
    {
        return $this->debug ? $this->development : $this->live;
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
}
