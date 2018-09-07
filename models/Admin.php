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
    // login can only contain between 4 and 16 word characters 
    $regexp = '/^[\w]{4,16}$/';
    if (!preg_match($regexp, $login)) {
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
    if (strlen($password) <> 60) {
      throw new Exception('Invalid password'); 
    }
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