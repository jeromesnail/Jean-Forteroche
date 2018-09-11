<?php

class PostManager extends Manager {

  public function getPostCount() {

    $db = $this->dbConnect();
    $req = $db->query('SELECT COUNT(*) as postCount from posts');
    $posts = $req->fetch(PDO::FETCH_ASSOC);

    $req->closeCursor();

    return $posts['postCount'];
  }


  public function getPostById(int $id) {

    $db = $this->dbConnect();
    $req = $db->prepare('SELECT * FROM posts WHERE id = :id');
    $req->execute([
      ':id' => $id
    ]);

    $resp = $req->fetch(PDO::FETCH_ASSOC);

    $req->closeCursor();

    if ($resp) {
      return new Post($resp);
    } else {
      throw new Exception('Could not find the post by its id');      
    }
  }


  public function getPostByRank($rank, $order) {

    $db = $this->dbConnect();
    $req = $db->query('SELECT * from posts ORDER BY createdAt ' . $order . ' LIMIT ' . ($rank - 1) . ', 1');
    
    $resp = $req->fetch(PDO::FETCH_ASSOC);

    $req->closeCursor();

    if ($resp) {
      return new Post($resp);
    } else {
      throw new Exception('Could not find the post by its rank');      
    }
  }


  public function addPost(Post $post) {

    $db = $this->dbConnect();
    $req = $db->prepare('INSERT INTO posts(createdAt, content) VALUES(NOW(), :content)');
    $affectedLines = $req->execute([
      ':content' => $post->content()
    ]);

    $req->closeCursor();

    return $affectedLines;
  }
  

  public function updatePost(Post $post) {

    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE posts SET content = :content, editedAt = NOW() WHERE id = :id');
    $affectedLines = $req->execute([
      ':id' => $post->id(),
      ':content' => $post->content()
    ]);
    
    $req->closeCursor();

    return $affectedLines;
  }
}