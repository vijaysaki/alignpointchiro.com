<?php
require __DIR__ . '/db.php';
require __DIR__ . '/header.php';

$pdo = db();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$service = [
  'parent_id' => null,
  'title' => '',
  'slug' => '',
  'description' => '',
  'sort_order' => 0,
  'status' => 'published',
];

if ($id > 0) {
  $stmt = $pdo->prepare("SELECT * FROM services WHERE id=?");
  $stmt->execute([$id]);
  $found = $stmt->fetch();
  if (!$found) { echo "<p>Not found.</p>"; require __DIR__ . '/footer.php'; exit; }
  $service = $found;
}

$parents = $pdo->query("SELECT id, title FROM services ORDER BY title")->fetchAll();

$error = '';

if (is_post()) {
  if (isset($_POST['delete']) && $id > 0) {
    $pdo->prepare("DELETE FROM services WHERE id=?")->execute([$id]);
    header('Location: services.php'); exit;
  }

  $title = trim((string)($_POST['title'] ?? ''));
  $slug  = trim((string)($_POST['slug'] ?? ''));
  $description = (string)($_POST['description'] ?? '');
  $sort_order = (int)($_POST['sort_order'] ?? 0);
  $status = (string)($_POST['status'] ?? 'published');

  $parent_id_raw = $_POST['parent_id'] ?? '';
  $parent_id = ($parent_id_raw === '' ? null : (int)$parent_id_raw);

  if ($title === '' || $slug === '') $error = 'Title and slug are required.';
  if ($id > 0 && $parent_id !== null && $parent_id === $id) $error = 'A service cannot be its own parent.';

  if (!$error) {
    if ($id > 0) {
      $stmt = $pdo->prepare("UPDATE services SET parent_id=?, title=?, slug=?, description=?, sort_order=?, status=? WHERE id=?");
      $stmt->execute([$parent_id, $title, $slug, $description, $sort_order, $status, $id]);
    } else {
      $stmt = $pdo->prepare("INSERT INTO services (parent_id, title, slug, description, sort_order, status) VALUES (?,?,?,?,?,?)");
      $stmt->execute([$parent_id, $title, $slug, $description, $sort_order, $status]);
      $id = (int)$pdo->lastInsertId();
    }
    header("Location: service_edit.php?id=$id"); exit;
  }
}

?>
<h1><?= $id ? 'Edit Service' : 'New Service' ?></h1>
<?php if ($error): ?><p style="color:red;"><?= e($error) ?></p><?php endif; ?>

<form method="post">
  <label>Parent<br>
    <select name="parent_id">
      <option value="">(No parent)</option>
      <?php foreach ($parents as $p): 
        $pid = (int)$p['id'];
        if ($id > 0 && $pid === $id) continue;
        $sel = ($service['parent_id'] !== null && (int)$service['parent_id'] === $pid) ? 'selected' : '';
      ?>
        <option value="<?= $pid ?>" <?= $sel ?>><?= e($p['title']) ?></option>
      <?php endforeach; ?>
    </select>
  </label><br><br>

  <label>Title<br><input name="title" value="<?= e((string)$service['title']) ?>"></label><br><br>
  <label>Slug<br><input name="slug" value="<?= e((string)$service['slug']) ?>"></label><br><br>

  <label>Sort Order<br><input type="number" name="sort_order" value="<?= (int)$service['sort_order'] ?>"></label><br><br>

  <label>Status<br>
    <select name="status">
      <option value="draft" <?= ($service['status']==='draft'?'selected':'') ?>>draft</option>
      <option value="published" <?= ($service['status']==='published'?'selected':'') ?>>published</option>
    </select>
  </label><br><br>

  <label>Description (HTML)<br>
    <textarea name="description"><?= e((string)$service['description']) ?></textarea>
  </label><br><br>

  <button type="submit">Save</button>
  <?php if ($id): ?>
    <button type="submit" name="delete" value="1" onclick="return confirm('Delete this service (and children)?')">Delete</button>
  <?php endif; ?>
</form>

<?php require __DIR__ . '/footer.php'; ?>
