<?php

class Post extends Entry {

  // Private attributes
  private $_content,
          $_editedAt;

  // Getters
  public function content() {
    return $this->_content;
  }

  public function editedAt() {
  return $this->_editedAt;
  }

  // Setters
  public function setContent(string $content) {
    if (empty($content)) {
      throw new Exception('Content cannot be empty');
    }
    $this->_content = $content;
  }

  public function setEditedAt(string $editedAt) {
    if (!Manager::isDateFormatValid($editedAt)) {
      throw new Exception('Invalid date format');      
    }
    $this->_editedAt = $editedAt;
  }
}
