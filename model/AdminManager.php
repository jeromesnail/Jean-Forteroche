<?php

namespace Model;

class AdminManager extends Manager {

  public function getAdmin() {

    $db = $this->dbConnect();
    $req = $db->query('SELECT * FROM admin ORDER BY createdAt DESC');

    $admin = new Admin($req->fetch(\PDO::FETCH_ASSOC));

    $req->closeCursor();

    return $admin;
  }

  public function updateAdmin(Admin $admin) {

    $db = $this->dbConnect();
    $req = $db->prepare('INSERT INTO admin(createdAt, login, email, password, displayName) VALUES(NOW(), :login, :email, :password, :displayName)');
    $affectedLines = $req->execute([
      ':login' => $admin->login(),
      ':email' => $admin->email(),
      ':password' => $admin->password(),
      ':displayName' => $admin->displayName()
    ]);

    $req->closeCursor();

    return $affectedLines;
  }
}
