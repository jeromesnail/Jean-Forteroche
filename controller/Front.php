<?php

namespace Controller;

class Front {

  public function displayPost(int $rank, string $order) {
    $postManager = new \Model\PostManager();
    $commentManager = new \Model\CommentManager();

    $post = $postManager->getPostByRank($rank, $order);
    $comments = $commentManager->getComments($post->id());

    $view = new \View\View('view/front/postView.php', [
      'title' => $post->title(),
      'post' => $post,
      'comments' => $comments
    ]);

    $view->output();
  }
}