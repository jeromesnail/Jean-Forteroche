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
    // password must contain at least one lowercase letter
    $lowercase = preg_match('/[a-z]/', $password);
    // it must contain at least on uppercase letter
    $uppercase = preg_match('/[A-Z]/', $password);
    // it must contain at least one number
    $number = preg_match('/[0-9]/', $password);
    // it must contain at least one special character
    $special = preg_match('/[\W_]/', $password);
    // Finally it must contain between 8 and 20 characters
    $count = preg_match('/^.{8,20}$/', $password);
    if ($lowercase AND $uppercase AND $number AND $special AND $count) {
      $this->_password = $password;
    }
    else {
      throw new Exception('Invalid password');      
    }
  }

  public function setDisplayName(string $displayName) {
    if (strlen($displayName) > 32) {
      throw new Exception('Invalid display name');      
    }
    $this->_displayName = $displayName;
  }
}

// echo 'Admin loaded<br />';