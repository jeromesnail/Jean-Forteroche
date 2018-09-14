<?php

namespace Controller;

class CommentController {
  
  public function submitComment($postId, $postRank, $order, $name, $email, $message) {
    $commentManager = new \Model\CommentManager();

    $comment = new \Model\Comment([
      'postId' => $postId,
      'name' => $name,
      'email' => $email,
      'message' => $message
    ]);

    $affectedLines = $commentManager->addComment($comment);
    if ($affectedLines) {
      header('Location: index.php?action=displayPost&rank=' . $postRank . '&order=' . $order);
    } else {
      throw new \Exception('Database error, could not add the comment');
    }
  }

  public function submitReport($commentId, $postRank, $order) {
    $commentManager = new \Model\CommentManager();

    $affectedLines = $commentManager->addReport($commentId);
    if ($affectedLines) {
      header('Location: index.php?action=displayPost&rank=' . $postRank . '&order=' . $order);
    } else {
      throw new \Exception('Database error, could not report the comment');
    }
  }
}