<?php
$previousAttribute = $postRank > 1 ?
  'href="index.php?action=displayPost&rank=' . ($postRank - 1) . '"' :
  'class="disabled"';

$nextAttribute = $postRank < $postCount ?
  'href="index.php?action=displayPost&rank=' . ($postRank + 1) . '"' :
  'class="disabled"';
  ?>

<section id="post">
  <div id="paging">
    <a id="previous" <?= $previousAttribute ?>>
      <i class="fas fa-angle-double-left"></i>
    </a>
    <div>Page <?= $postRank ?>/<?= $postCount ?></div>
    <a id="next" <?= $nextAttribute ?>>
      <i class="fas fa-angle-double-right"></i>
    </a>
  </div>
  
  <h1><?= $post->title() ?></h1>
  <p><?= $post->content() ?></p>
</section>

<section id="comments">
  <h2>Commentaires:</h2>
  <?php
  foreach ($comments as $comment) {
  ?>
  <div>
    <p><?= $comment->name() ?> a dit :</p>
    <p><?= $comment->message() ?></p>
  </div>
  <?
  }
  ?>
</section>