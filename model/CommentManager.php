<?php

namespace Model;

class CommentManager extends Manager {

  public function addComment(Comment $comment) {

    $db = $this->dbConnect();
    $req = $db->prepare('INSERT INTO comments(createdAt, postId, name, email, message) VALUES(NOW(), :postId, :name, :email, :message)');
    $affectedLines = $req->execute([
      ':postId' => $comment->postId(),
      ':name' => $comment->name(),
      ':email' => $comment->email(),
      ':message' => $comment->message()
    ]);

    $req->closeCursor();

    return $affectedLines;
  }


  public function getComments(int $postId) {

    $comments = [];

    $db = $this->dbConnect();
    $req = $db->prepare('SELECT * FROM comments WHERE postId = :postId');
    $req->execute([
      ':postId' => $postId
    ]);
    
    while($comment = $req->fetch(\PDO::FETCH_ASSOC)) {
      $comments[] = new Comment($comment);
    }

    $req->closeCursor();

    return $comments;
  }


  public function getComment(int $id) {

    $db = $this->dbConnect();
    $req = $db->prepare('SELECT * FROM comments WHERE id = :id');
    $req->execute([
      ':id' => $id
    ]);

    $comment = new Comment($req->fetch(\PDO::FETCH_ASSOC));

    $req->closeCursor();

    return $comment;
  }


  public function getReports() {

    $reports = [];

    $db = $this->dbConnect();
    $req = $db->query('SELECT * FROM comments WHERE report = 1');

    while($report = $req->fetch(\PDO::FETCH_ASSOC)) {
      $reports[] = new Comment($report);
    }

    $req->closeCursor();

    return $reports;
  }


  public function updateComment(Comment $comment) {

    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE comments SET message = :message, moderatedAt = NOW() WHERE id = :id');
    $affectedLines = $req->execute([
      ':id' => $comment->id(),
      ':message' => $comment->message()
    ]);

    $req->closeCursor();

    return $affectedLines;
  }
}