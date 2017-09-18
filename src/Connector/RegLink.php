<?php

namespace Passkey\Connector;

use GuzzleHttp\Client;
use Passkey\Common\Profile;
use Passkey\Common\Endpoint;
use Passkey\Exceptions\ResponseException;

class RegLink
{
    protected $client;
    protected $response;
    protected $profile;
    protected $endpoint;
    protected $bridgeId;
    protected $isSuccess = false;
    protected $errorMessage;

    public function __construct(Endpoint $endpoint, Profile $profile)
    {
        $this->setProfile($profile)
             ->setEndpoint($endpoint);
            
        $this->client = new Client;
    }

    public function post()
    {
        $this->response = $this->client->request('GET', $this->build());

        if ($this->response->getStatusCode() != 200) {
            throw new ResponseException(sprintf("HTTP Request Returned %s", $this->response->getStatusCode()));
        }

        $this->parse((string) $this->response->getBody());

        return $this;
    }

    protected function parse($body)
    {
        // See if we have error message
        preg_match('/ERROR : "(.*)"/i', $body, $errors);

        if (count($errors)) {
            $this->setErrorMessage($errors[0]);
            return;
        }

        // Grab bridge id
        preg_match('/([\w\d]+)-([\w\d]+)/i', $body, $matches);

        if (!count($matches)) {
            throw new ResponseException("BridgeID was not found in returned body.");
        }

        $this->setErrorMessage(null);
        $this->setBridgeId($matches[0]);
        $this->setIsSuccess(true);
    }

    protected function build()
    {
        return $this->endpoint . '?' . http_build_query($this->profile->fields());
    }
    
    /**
     * @param mixed $profile
     *
     * @return self
     */
    public function setProfile(Profile $profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     *
     * @return self
     */
    public function setClient($client)
    {
        $this->client = $client;

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
    public function getIsSuccess()
    {
        return $this->isSuccess;
    }

    /**
     * @param mixed $isSuccess
     *
     * @return self
     */
    public function setIsSuccess($isSuccess)
    {
        $this->isSuccess = $isSuccess;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param mixed $errorMessage
     *
     * @return self
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param mixed $endpoint
     *
     * @return self
     */
    public function setEndpoint(Endpoint $endpoint)
    {
        $this->endpoint = $endpoint->endpoint() . '/httpapi/RegLink';

        return $this;
    }
}
