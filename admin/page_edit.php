<?php
require __DIR__ . '/db.php';
require __DIR__ . '/header.php';

$pdo = db();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$page = [
  'title' => '',
  'slug' => '',
  'content' => '',
  'status' => 'draft',
];

if ($id > 0) {
  $stmt = $pdo->prepare("SELECT * FROM pages WHERE id=?");
  $stmt->execute([$id]);
  $found = $stmt->fetch();
  if (!$found) { echo "<p>Not found.</p>"; require __DIR__ . '/footer.php'; exit; }
  $page = $found;
}

$error = '';

if (is_post()) {
  if (isset($_POST['delete']) && $id > 0) {
    $pdo->prepare("DELETE FROM pages WHERE id=?")->execute([$id]);
    header('Location: pages.php'); exit;
  }

  $title = trim((string)($_POST['title'] ?? ''));
  $slug  = trim((string)($_POST['slug'] ?? ''));
  $content = (string)($_POST['content'] ?? '');
  $status = (string)($_POST['status'] ?? 'draft');

  if ($title === '' || $slug === '') $error = 'Title and slug are required.';

  if (!$error) {
    if ($id > 0) {
      $stmt = $pdo->prepare("UPDATE pages SET title=?, slug=?, content=?, status=? WHERE id=?");
      $stmt->execute([$title, $slug, $content, $status, $id]);
    } else {
      $stmt = $pdo->prepare("INSERT INTO pages (title, slug, content, status) VALUES (?,?,?,?)");
      $stmt->execute([$title, $slug, $content, $status]);
      $id = (int)$pdo->lastInsertId();
    }
    header("Location: page_edit.php?id=$id"); exit;
  }
}

?>
<h1><?= $id ? 'Edit Page' : 'New Page' ?></h1>
<?php if ($error): ?><p style="color:red;"><?= e($error) ?></p><?php endif; ?>

<form method="post">
  <div class="row">
    <div class="col">
      <label>Title<br><input name="title" value="<?= e((string)$page['title']) ?>"></label><br><br>
      <label>Slug (e.g. about-us)<br><input name="slug" value="<?= e((string)$page['slug']) ?>"></label><br><br>
      <label>Status<br>
        <select name="status">
          <option value="draft" <?= ($page['status']==='draft'?'selected':'') ?>>draft</option>
          <option value="published" <?= ($page['status']==='published'?'selected':'') ?>>published</option>
        </select>
      </label>
    </div>
  </div>

  <label>Content (HTML)<br>
    <textarea name="content"><?= e((string)$page['content']) ?></textarea>
  </label><br><br>

  <button type="submit">Save</button>
  <?php if ($id): ?>
    <button type="submit" name="delete" value="1" onclick="return confirm('Delete this page?')">Delete</button>
  <?php endif; ?>
</form>

<?php require __DIR__ . '/footer.php'; ?>
