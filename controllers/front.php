<?php

class Front {

  public function displayPost(int $rank, string $order) {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPostByRank($rank, $order);
    $comments = $commentManager->getComments($post->id());

    $view = new View('views/front/postView.php', [
      'title' => $post->title(),
      'post' => $post,
      'comments' => $comments
    ]);

    $view->output();
  }
}