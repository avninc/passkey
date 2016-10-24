<?php

namespace Passkey;

use SoapClient;
use Passkey\Common\{Security, Message};
use Sabre\Xml\Service;

abstract class Client extends SoapClient
{
  /**
   * Soap version.
   *
   * @var int
   */
  protected $soapVersion = SOAP_1_1;
  /**
   * Tracing enabled?
   *
   * @var bool
   */
  protected $tracingEnabled = false;
  /**
  * WSDL File
  *
  * @var string
  */
  protected $wsdlfile = null;

  /**
   * XML reader/writer
   *
   * @var object
   */
  protected $xmlService;

  protected $namespace = [];

  protected $root = null;

  protected $security;

  protected $message;

  protected $xmlElements = [];

  /**
   * Constructor.
   *
   * @param string               $wsdl    WSDL file
   * @param array(string=>mixed) $options Options array
   */
  public function __construct($wsdl=null, array $options = [])
  {
      // tracing enabled: store last request/response header and body
      if (isset($options['trace']) && $options['trace'] === true) {
          $this->tracingEnabled = true;
      }
      // store SOAP version
      if (isset($options['soap_version'])) {
          $this->soapVersion = $options['soap_version'];
      }

      if ($wsdl) {
          $this->setWsdl($wsdl);
      }

      $this->setXmlService(new Service());
      $this->getXmlService()->namespaceMap = $this->namespace;

      parent::__construct($this->wsdlFile, $options);
  }

  public function getXml() {
    return $this->getXmlService()->write($this->root, $this->xmlElements);
  }

  public function setSecurity(Security $security) {
    $this->security = $security;

    $this->addElement('Security', [
      'Login' => [
          'UserName' => $this->security->getUsername(),
          'PassWord' => $this->security->getPassword()
      ],
      'PartnerID' => $this->security->getPartnerId(),
      'Token' => ' ',
    ]);

    return $this;
  }

  public function getSecurity() {
    return $this->security;
  }

  public function setMessage(Message $message) {
    $this->message = $message;

    $this->addElement('Message', [
      'Version' => $this->message->getVersion(),
      'Mode' => $this->message->getMode(),
      'OP' => $this->message->getOperation(),
      'Service' => $this->message->getService(),
      'Locale' => $this->message->getLocale(),
    ]);

    return $this;
  }

  public function getMessage() {
    return $this->message;
  }

  public function setWsdl($file) {
    $this->wsdlFile = $file;

    return $this;
  }

  public function getWsdl() {
    return $this->wsdlFile;
  }

  public function setNamespace(array $namespace) {
    $this->namespace = $namespace;

    return $this;
  }

  public function getNamespace() {
    return $this->namespace;
  }

  public function setXmlService(Service $service) {
    $this->xmlService = $service;

    return $this;
  }

  public function getXmlService() {
    return $this->xmlService;
  }

  protected function addElement($key, $element)
  {
    $this->xmlElements[$key] = $element;
  }
}
