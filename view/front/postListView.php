<section id="post-list">
  <table>
    <thead>
      <tr>
        <th>Titre</th>
        <th>Extrait</th>
        <th>Date de parution</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach ($posts as $post) {
    ?>
      <tr>
        <td><?= $post->title() ?></td>
        <td><?= substr($post->content(), 0, 30) ?></td>
        <td><?= $post->createdAt() ?></td>
      </tr>
    <?php
    }
    ?>
    </tbody>
  </table>
</section>