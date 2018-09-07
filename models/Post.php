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
    if (is_string($content)) {
      $this->_content = $content;
    }
  }

  public function setEditedAt(string $editedAt) {
    if (Manager::isDateFormatValid($editedAt)) {
      $this->_editedAt = $editedAt;
    }
  }
}

// echo 'Post loaded <br />';