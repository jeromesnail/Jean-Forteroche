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


// Sessions
session_start();
if (isset($_COOKIE['login']) && !isset($_SESSION['displayName'])) {
  $adminController = new \Controller\AdminController;
  $isAdmin = $adminController->checkCookie($_COOKIE['login']);
  if ($isAdmin) {
    $_SESSION['displayName'] = $isAdmin;
  }
}


// Router

try {
  if (isset($_GET['action'])) {
    
    // Display post list
    if ($_GET['action'] == 'postList') {
      $postController = new \Controller\PostController();
      $postController->displayPostList();
    }

    // Display post by rank order
    if ($_GET['action'] == 'displayPost') {
      if (isset($_GET['rank']) && $_GET['rank'] > 0) {
        $postController = new \Controller\PostController();
        $order = (isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'ASC' : 'DESC';
        $postController->displayPost($_GET['rank'], $order);
      } else {
        throw new \Exception('Post rank invalid');
      }
    }

    // Add a comment
    if ($_GET['action'] == 'addComment') {
      if (isset($_POST['postId'], $_POST['postRank'], $_POST['order'], $_POST['name'], $_POST['email'], $_POST['message'])) {
        $commentController = new \Controller\CommentController();
        $commentController->submitComment($_POST['postId'], $_POST['postRank'], $_POST['order'], $_POST['name'], $_POST['email'], $_POST['message']);
      } else {
        throw new \Exception('Missing data to add comment');
      }
    }

    // Report a comment
    if ($_GET['action'] == 'report') {
      if (isset($_GET['commentId'], $_GET['postRank'], $_GET['order'])) {
        $commentController = new \Controller\CommentController();
        $commentController->submitReport($_GET['commentId'], $_GET['postRank'], $_GET['order']);
      } else throw new Exception('Missing data to report comment'); 
    }

    // Authentification
    if ($_GET['action'] == 'login') {
      $adminController = new \Controller\AdminController();
      if (isset($_SESSION['displayName'])) {
        session_unset();
        session_destroy();
        setcookie('login', '', 1);
      }
      $adminController->displayLogin();
    }

    if ($_GET['action'] == 'loginPost') {
      if (isset($_POST['login'], $_POST['password'])) {
        $adminController = new \Controller\AdminController();
        $adminController->checkLogin($_POST['login'], $_POST['password'], isset($_POST['remember']));
      }
    }

  } else {
    // Displaying last post by default
    $postController = new \Controller\PostController();
    $postController->displayPost(1, 'DESC');
  }
} catch(Exception $e) {
  echo 'Erreur : ' . $e->getMessage();
}