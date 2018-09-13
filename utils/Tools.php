<?php

namespace Utils;

class Tools {

  /** Checking DATETIME format.
   * 
   * @param string
   * @return boolean
  */
  static function isDateFormatValid($date) {
    $format = 'Y-m-d H:i:s';
    $d = \DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date || $date == NULL;
  }
}