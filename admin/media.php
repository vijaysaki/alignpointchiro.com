<?php
require __DIR__ . '/db.php';
require __DIR__ . '/header.php';

$rows = db()->query("SELECT id, filename, url, mime_type, size, alt_text, created_at FROM media ORDER BY id DESC LIMIT 200")->fetchAll();
?>
<h1>Media</h1>

<form method="post" action="upload.php" enctype="multipart/form-data">
  <label>Select image: <input type="file" name="file" accept="image/*"></label>
  <label>Alt text: <input name="alt_text"></label>
  <button type="submit">Upload</button>
</form>

<table>
  <thead><tr><th>Preview</th><th>File</th><th>URL</th><th>Alt</th><th>Created</th></tr></thead>
  <tbody>
    <?php foreach ($rows as $r): ?>
      <tr>
        <td><img src="<?= e($r['url']) ?>" style="height:50px"></td>
        <td><?= e($r['filename']) ?></td>
        <td><code><?= e($r['url']) ?></code></td>
        <td><?= e((string)$r['alt_text']) ?></td>
        <td><?= e($r['created_at']) ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require __DIR__ . '/footer.php'; ?>
