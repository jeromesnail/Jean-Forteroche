<?php

require_once('../config.php');


abstract class Manager {

  /** Connection to database.
   * 
   * @return PDO
  */
  protected function dbConnect() {
    return new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASSWORD);
  }
}