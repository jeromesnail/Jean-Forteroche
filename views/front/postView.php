<section id="post">
  <h1><?= $post->title() ?></h1>
  <p><?= $post->content() ?></p>
</section>

<section id="comments">
  <h2>Comments:</h2>
  <?php
  foreach ($comments as $comment) {
  ?>
  <div>
    <p><?= $comment->name() ?> says:</p>
    <p><?= $comment->message() ?></p>
  </div>
  <?
  }
  ?>
</section>