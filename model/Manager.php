<?php

namespace Model;

require_once('config.php');

abstract class Manager {

  /** Connection to database.
   * 
   * @return PDO
  */
  protected function dbConnect() {
    return new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASSWORD);
  }

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
