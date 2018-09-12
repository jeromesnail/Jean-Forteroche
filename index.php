<?php


// Autoload
function autoload($class) {
    $file_position = strrpos($class, '\\');
    if($file_position === false) {
        return;
    }
    $ds = DIRECTORY_SEPARATOR;
    $path = str_replace('\\', $ds, strtolower(substr($class, 0, $file_position + 1)));
    $file = $path . substr($class, $file_position + 1) . '.php';
    if(file_exists($file)) {
        require_once($file);
    }
}

spl_autoload_register('autoload');


// ROUTER
$front = new Controller\Front();
$back = new Controller\Back();

try {
  if (isset($_GET['action'])) {

  } else {
    $front->displayPost(1, 'DESC');
  }
} catch(Exception $e) {
  echo 'Erreur : ' . $e->getMessage();
}