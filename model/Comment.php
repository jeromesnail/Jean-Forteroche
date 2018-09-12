<?php

namespace Model;

class Comment extends Entry {

  // Private attributes
  private $_postId,
          $_name,
          $_email,
          $_message,
          $_report,
          $moderatedAt;

  // Getters
  public function postId() {
    return $this->_postId;
  }

  public function name() {
    return $this->_name;
  }

  public function email() {
    return $this->_email;
  }

  public function message() {
    return $this->_message;
  }

  public function report() {
    return $this->_report;
  }

  public function moderatedAt() {
    return $this->_moderatedAt;
  }

  // Setters
  public function setPostId(string $postId) {
    $postId = (int) $postId;
    if ($postId <= 0) {
      throw new Exception('Invalid id');
    }
    $this->_postId = $postId;
  }

  public function setName(string $name) {
    // name can only contain between 4 and 16 word characters, including "@" and "-"
    $regexp = '/^[\w@-]{4,16}$/';
    if (!preg_match($regexp, $name)) {
      throw new Exception('Invalid name format');
    }
    $this->_name = $name;
  }

  public function setEmail(string $email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new Exception('Invalid email');
    }
    $this->_email = $email;
  }

  public function setMessage (string $message) {
    if (empty($message)) {
      throw new Exception('Message cannot be empty');      
    }
    if (strlen($message) > 1000) {
      throw new Exception('Message cannot exceed 1000 characters');      
    }
    $this->_message = $message;
  }

  public function setReport (string $report) {
    $this->_report = filter_var($report, FILTER_VALIDATE_BOOLEAN);
  }

  public function setModeratedAt($moderatedAt) {
    $this->_moderatedAt = Manager::isDateFormatValid($moderatedAt) ? $moderatedAt : NULL;
  }
}
