<?php

namespace View;

class View {

  // Private attributes
  private $_file,
          $_data;

  
  // Setters
  private function setFile($file) {
    if (file_exists($file)) {
      $this->_file = $file;
    }
  }

  private function setData($data) {
    if (is_array($data)) {
      $this->_data = $data;
    }
  }

  // Constructor
  public function __construct($file, $data) {
    $this->setFile($file);
    $this->setData($data);
  }


  public function output() {
    extract($this->_data);

    ob_start();
    require($this->_file);
    $content = ob_get_clean();
    require('view/template.php');
  }
}