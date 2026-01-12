<?php
// admin/index.php
declare(strict_types=1);
require __DIR__ . '/auth.php';

$config = require __DIR__ . '/config.php';

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
  header('Location: pages.php');
  exit;
}

$error = '';
if (is_post()) {
  $u = trim((string)($_POST['username'] ?? ''));
  $p = (string)($_POST['password'] ?? '');

  if ($u === $config['admin']['username'] && password_verify($p, $config['admin']['password_hash'])) {
    $_SESSION['admin_logged_in'] = true;
    header('Location: pages.php');
    exit;
  }
  $error = 'Invalid login.';
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Admin Login</title></head>
<body>
  <h1>Admin Login</h1>
  <?php if ($error): ?><p style="color:red;"><?= e($error) ?></p><?php endif; ?>
  <form method="post">
    <label>Username <input name="username" /></label><br><br>
    <label>Password <input type="password" name="password" /></label><br><br>
    <button type="submit">Login</button>
  </form>
</body>
</html>
