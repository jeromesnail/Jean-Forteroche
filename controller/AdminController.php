<?php

namespace Controller;

class AdminController {

  public function submitLogin($login, $password, $remember) {
    $adminManager = new \Model\AdminManager();

    $admin = $adminManager->getAdmin();

    if ($login == $admin->login() && password_verify($password, $admin->password())) {
      $_SESSION['displayName'] = $admin->displayName();
      if ($remember) {
        setcookie('login', password_hash($admin->login() . $admin->password(), PASSWORD_BCRYPT), time()+30*24*3600);
      }

      header('Location: index.php');
    } else {
      header('Location: index.php?action=login');
    }
  }

  public function checkCookie($cookieLogin) {
    $adminManager = new \Model\AdminManager();

    $admin = $adminManager->getAdmin();

    return (password_verify($admin->login() . $admin->password(), $cookieLogin)) ?
      $admin->displayName() : FALSE;
  }

  public function displayLogin() {
    $view = new \View\View('view/back/loginView.php', [
      'title' => 'Connection'
    ]);
    $view->output();
  }
}