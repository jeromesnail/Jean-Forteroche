<?php
$previousAttribute = $postRank > 1 ?
  'href="index.php?action=displayPost&rank=' . ($postRank - 1) . '&order=' . $order . '" class="col-1 btn btn-outline-primary"' :
  'href="#" class="col-1 btn btn-outline-primary disabled"';

$nextAttribute = $postRank < $postCount ?
  'href="index.php?action=displayPost&rank=' . ($postRank + 1) . '&order=' . $order . '" class="col-1 btn btn-outline-primary"' :
  'href="#" class="col-1 btn btn-outline-primary disabled"';

if ($order == 'ASC') {
  $newOrder = 'DESC';
  $filterText = 'Les plus anciens en premier';
} else {
  $newOrder = 'ASC';
  $filterText = 'Les plus récents en premier';
}
?>

<section id="post">
  <div class="row text-center">
    <a href="index.php?action=displayPost&rank=<?= $postRank ?>&order=<?= $newOrder ?>" class="col-5 btn btn-outline-success">
      <?= $filterText ?>
    </a>
    <div class="col-3"></div>
    <a <?= $previousAttribute ?>>
      <i class="fas fa-angle-double-left"></i>
    </a>
    <div class="col-2">
      Page <?= $postRank ?>/<?= $postCount ?>
    </div>
    <a <?= $nextAttribute ?>>
      <i class="fas fa-angle-double-right"></i>
    </a>
  </div>
  
  <div class="jumbotron">
    <h1><?= htmlspecialchars($post->title()) ?></h1>
    <p><?= htmlspecialchars($post->content()) ?></p>
  </div>
</section>

<section id="comments">
  <h2>Commentaires:</h2>
  <?php
  foreach ($comments as $comment) {
    $dateTime = new DateTime($comment->createdAt());
  ?>
  <div>
    <p>
      Message de <strong><?= htmlspecialchars($comment->name()) ?></strong>
      <em>le <?= $dateTime->format('d/m/Y à H\hi\ms\s') ?></em>
      <a href="index.php?action=report&commentId=<?= $comment->id() ?>&postRank=<?= $postRank ?>&order=<?= $order ?>" class="btn btn-sm btn-danger">
        <i class="far fa-flag"></i>
      </a></p>
    <p><?= htmlspecialchars($comment->message()) ?></p>
  </div>
  <?
  }
  ?>
</section>

<section id="comment-form">
  <h2>Réagissez à ce chapitre :</h2>
  <form action="index.php?action=addComment" method="post">
    <input type="hidden" name="postId" value="<?= $post->id() ?>" >
    <input type="hidden" name="postRank" value="<?= $postRank ?>" >
    <input type="hidden" name="order" value="<?= $order ?>" >
    <div class="form-group">
      <label for="name">Votre nom :</label>
      <input class="form-control" id="name" name="name" placeholder="Lettre et chiffres uniquement" type="text" />
    </div>
    <div class="form-group">
      <label for="email">Votre adresse email :</label>
      <input class="form-control" id="email" name="email" placeholder="adresse@example.com" type="email" />
    </div>
    <div class="form-group">
      <label for="message">Votre message :</label>
      <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button> 
  </form>
</section>