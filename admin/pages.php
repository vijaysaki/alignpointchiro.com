<?php
require __DIR__ . '/db.php';
require __DIR__ . '/header.php';

$rows = db()->query("SELECT id, title, slug, status, updated_at FROM pages ORDER BY updated_at DESC")->fetchAll();
?>
<h1>Pages</h1>
<p><a href="page_edit.php">+ New Page</a></p>

<table>
  <thead><tr><th>Title</th><th>Slug</th><th>Status</th><th>Updated</th><th></th></tr></thead>
  <tbody>
  <?php foreach ($rows as $r): ?>
    <tr>
      <td><?= e($r['title']) ?></td>
      <td><?= e($r['slug']) ?></td>
      <td><?= e($r['status']) ?></td>
      <td><?= e($r['updated_at']) ?></td>
      <td><a href="page_edit.php?id=<?= (int)$r['id'] ?>">Edit</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<?php require __DIR__ . '/footer.php'; ?>
