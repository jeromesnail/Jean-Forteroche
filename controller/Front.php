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