<?php

namespace Model;

abstract class Entry {

  // Private attributes
  private $_id,
          $_createdAt;

  // Getters
  public function id() {
    return $this->_id;
  }

  public function createdAt() {
    return $this->_createdAt;
  }

  // Setters
  public function setId(string $id) {
    $id = (int) $id;
    if ($id <= 0) {
      throw new \Exception('Invalid id');
    }
    $this->_id = $id;
  }

  public function setCreatedAt (string $createdAt) {
    if (!\Utils\Tools::isDateFormatValid($createdAt)) {
      throw new \Exception('Invalid date format');
    }
    $this->_createdAt = $createdAt;
  }

  // Hydrate
  public function hydrate(array $data) {
    foreach ($data as $key => $value) {
      $method = 'set' . ucfirst($key);
      if (method_exists($this, $method)) {
        $this->$method($value);
      }
    }
  }

  // Constructor
  public function __construct($data) {
    if (is_array($data)) {
      $this->hydrate($data);
    }
  }
}
