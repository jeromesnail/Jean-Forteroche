<?php

namespace Controller;

class CommentController {

  public function displayComments(int $postId) {
    $commentManager = new \Model\CommentManager();

    return $commentManager->getComments($postId);
  }
  

}