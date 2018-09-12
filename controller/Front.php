<?php

namespace Controller;

class Front {

  public function displayPost(int $rank, string $order) {
    $postManager = new \Model\PostManager();
    $commentManager = new \Model\CommentManager();

    $postCount = $postManager->getPostCount();
    $post = $postManager->getPostByRank($rank, $order);
    $comments = $commentManager->getComments($post->id());

    $view = new \View\View('view/front/postView.php', [
      'title' => $post->title(),
      'postRank' => $rank,
      'postCount' => $postCount,
      'post' => $post,
      'comments' => $comments
    ]);

    $view->output();
  }


  public function displayPostList() {
    $postManager = new \Model\PostManager();

    $posts = $postManager->getPosts();

    $view = new \View\View('view/front/postListView.php', [
      'title' => 'Liste des chapitres',
      'posts' => $posts
    ]);

    $view->output();
  }
}