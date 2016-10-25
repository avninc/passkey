<?php

namespace Passkey\Common;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class Element
{
  protected $params = [];

  /**
   * Gets the value of params.
   *
   * @return mixed
   */
  public function getParams()
  {
      return $this->params;
  }

  /**
   * Sets the value of params.
   *
   * @param mixed $params the params
   *
   * @return self
   */
  protected function setParams($params)
  {
      $this->params = $params;

      return $this;
  }

  protected function set($needle, $value)
  {
    array_walk_recursive($this->params, function(&$item, &$key) use($needle, $value) {
      if($key == $needle) {
        $item = $value;
      }
    });
  }
}
