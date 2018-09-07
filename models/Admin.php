<?php

class Admin extends Entry {

  // Private attributes
  private $_login,
          $_email,
          $_password,
          $_displayName;

  // Getters
  public function login() {
    return $this->_login;
  }

  public function email() {
    return $this->_email;
  }

  public function password() {
    return $this->_password;
  }

  public function displayName() {
    return $this->_displayName;
  }

  // Setters
  public function setLogin(string $login) {
    // name can only contain letters or numbers
    $options = ['regexp' => '/^[A-Za-z\d]{4,16}$/u'];
    if (!filter_var($login, FILTER_VALIDATE_REGEXP, ['options' => $options])) {
      throw new Exception('Invalid login format');
    }
    $this->_login = $login;
  }

  public function setEmail(string $email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new Exception('Invalid email');
    }
    $this->_email = $email;
  }

  public function setPassword(string $password) {
    $this->_password = $password;
  }

  public function setDisplayName(string $displayName) {
    if (strlen($displayName) > 32) {
      throw new Exception('Invalid display name');      
    }
    $this->_displayName = $displayName;
  }
}

// echo 'Admin loaded<br />';