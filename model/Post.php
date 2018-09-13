<?php

namespace Model;

class Post extends Entry {

  // Private attributes
  private $_title,
          $_content,
          $_editedAt;

  // Getters
  public function title() {
    return $this->_title;
  }

  public function content() {
    return $this->_content;
  }

  public function editedAt() {
  return $this->_editedAt;
  }

  // Setters
  public function setTitle(string $title) {
    if (empty($title) || strlen($title > 255)) {
      throw new \Exception('Invalid title');
    }
    $this->_title = $title;
  }

  public function setContent(string $content) {
    if (empty($content)) {
      throw new \Exception('Content cannot be empty');
    }
    $this->_content = $content;
  }

  public function setEditedAt($editedAt) {
    if (!\Utils\Tools::isDateFormatValid($editedAt)) {
      throw new \Exception('Invalid date format');      
    }
    $this->_editedAt = $editedAt;
  }
}
