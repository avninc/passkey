<?php

namespace Passkey;

use SoapClient;
use Passkey\Common\{Security, Message};
use Sabre\Xml\Service;
use Sabre\Xml\Reader;
use RecursiveIteratorIterator;
use RecursiveArrayIterator;

class Client extends SoapClient
{
  /**
   * Live API endpoint
   *
   * @var string
   */
  const LIVE = 'https://api.passkey.com/axis/services';
  /**
   * Development API endpoint
   *
   * @var string
   */
  const DEVELOPMENT = 'https://training-api.passkey.com/axis/services';

  public static $WSDL;
  /**
   * Service
   *
   * @var string
   */
  protected static $service = null;

  /**
   * In Debug
   *
   * @var bool
   */
  protected static $isDebug = false;

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
  protected static $wsdlFile = null;

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

  protected $encodeData = true;

  /**
   * Constructor.
   *
   * @param string               $wsdl    WSDL file
   * @param array(string=>mixed) $options Options array
   */
  public function __construct($wsdl=null, array $options = [], bool $isDebug=false)
  {
      // tracing enabled: store last request/response header and body
      if (isset($options['trace']) && $options['trace'] === true) {
          $this->tracingEnabled = true;
      }
      // store SOAP version
      if (isset($options['soap_version'])) {
          $this->soapVersion = $options['soap_version'];
      }

      static::setDebug($isDebug);

      if ($wsdl) {
          static::setWsdl($wsdl);
      } else {
          static::setWsdl(static::getService());
      }

      $this->setXmlService(new Service());
      $this->getXmlService()->namespaceMap = $this->namespace;

      parent::__construct(static::getWsdl(), $options + ['soap_version' => $this->soapVersion, 'trace' => $this->tracingEnabled]);
  }

  public function getXml()
  {
    if($this->encodeData) {
      $this->fixData();
    }

    $xml = $this->getXmlService()->write($this->root, $this->xmlElements);
    return $this->prepare($xml);
  }

  public function setSecurity(Security $security)
  {
    $this->security = $security;

    $this->addElement('Security', [
      'Login' => [
          'UserName' => $this->security->getUsername(),
          'Password' => $this->security->getPassword()
      ],
      'PartnerID' => $this->security->getPartnerId(),
      'Token' => $this->security->getToken(),
    ]);

    return $this;
  }

  public function getSecurity()
  {
    return $this->security;
  }

  public function setMessage(Message $message)
  {
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

  public function getMessage()
  {
    return $this->message;
  }

  public static function setWsdl($file)
  {
    self::$wsdlFile = $file;
    self::$WSDL = static::getService();
  }

  public static function getWsdl()
  {
    return self::$WSDL;
  }

  public function setNamespace(array $namespace)
  {
    $this->namespace = $namespace;

    return $this;
  }

  public function getNamespace()
  {
    return $this->namespace;
  }

  public function setXmlService(Service $service)
  {
    $this->xmlService = $service;

    return $this;
  }

  public function getXmlService()
  {
    return $this->xmlService;
  }

  public function addElement($key, $element)
  {
    $this->xmlElements[$key] = $element;
  }

  public function getElements()
  {
    return $this->xmlElements;
  }

  protected function prepare(&$xml) {
    // Fix keys
    $xml = $this->fixXMLkeys($xml);


    return $xml;
  }

  protected function setDataNamespace(array $input, $parent=null)
  {
    $return = [];
    foreach ($input as $key => $value) {
      $k = $key;

      if(!$this->skipNamespaceKeys($key) && $parent != 'attributes' && !is_int($key)) {
        $key = '{'.array_search(reset($this->namespace), $this->namespace).'}' . $key;
      }

      if (is_array($value)) {
        $value = $this->setDataNamespace($value, $k);
      }

      $return[$key] = $value;
    }

    return $return;
  }

  protected function skipNamespaceKeys($key) {
    return in_array($key, ['value', 'attributes']);
  }

  protected function fixData() {
    if(isset($this->xmlElements['Data'])) {
      $this->xmlElements['Data'] = $this->setDataNamespace($this->xmlElements['Data']);
    }
  }

  /**
   * Since an array can't hold the exact same key we need
   * to fix certain keys after we generate the XML
   * Simple find and replace
   *
   *
   *
   */
  protected function fixXMLkeys($xml)
  {
    $xml = str_ireplace(['FaxTelephone', 'FaxNumber', 'FaxTechType', '<OTA_ReadRQ', '</OTA_ReadRQ'], ['Telephone', 'PhoneNumber', 'PhoneTechType', '<ota:OTA_ReadRQ', '</ota:OTA_ReadRQ'], $xml);

    $xml = str_ireplace(['AddressLine2'], ['AddressLine'], $xml);

    return $xml;
  }

  public static function setDebug(bool $flag)
  {
    static::$isDebug = $flag;
    static::setWsdl(static::getService());
  }

  public static function isDebug()
  {
    return static::$isDebug;
  }

  protected static function getEndpoint()
  {
    return static::isDebug() ? static::DEVELOPMENT : static::LIVE;
  }

  public static function getService()
  {
    return static::getEndpoint() . '/' . static::$service . '?wsdl';
  }
}
