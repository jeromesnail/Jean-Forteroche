<?php

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
  public function setId(int $id) {
    $id = (int) $id;
    if ($id > 0) {
      $this->_id = $id;
    }
  }

  public function setCreatedAt (string $createdAt) {
    if (Manager::isDateFormatValid($createdAt)) {
      $this->_createdAt = $createdAt;
    }
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
  public function __construct(array $data) {
    $this->hydrate($data);
  }
}

// echo 'Entry loaded<br />';