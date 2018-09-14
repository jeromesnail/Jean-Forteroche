<?php

namespace Controller;

class PostController {

  public function displayPost(int $rank, string $order) {
    $postManager = new \Model\PostManager();

    $postCount = $postManager->getPostCount();
    $post = $postManager->getPostByRank($rank, $order);

    $commentManager = new \Model\CommentManager();
    $comments = $commentManager->getComments($post->id());

    $view = new \View\View('view/front/postView.php', [
      'title' => $post->title(),
      'postRank' => $rank,
      'order' => $order,
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

  public function newPost() {
    $view = new \View\View('view/back/newPostView.php', [
      'title' => 'Nouveau chapitre'
    ]);

    $view->output();
  }

  public function submitPost($title, $content) {
    $postManager = new \Model\PostManager();
    $post = new \Model\Post([
      'title' => $title,
      'content' => $content
    ]);

    $affectedLines = $postManager->addPost($post);
    if ($affectedLines) {
      header('Location: index.php?action=displayPost&rank=1');
    } else {
      throw new \Exception('Database error, could not add the post');
    }
  }
}