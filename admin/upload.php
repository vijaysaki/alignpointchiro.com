<?php
// admin/upload.php
require __DIR__ . '/db.php';
require __DIR__ . '/auth.php';
require_login();

$config = require __DIR__ . '/config.php';
$pdo = db();

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
  header('Location: media.php'); exit;
}

$f = $_FILES['file'];
if ($f['size'] > $config['uploads']['max_bytes']) die('File too large.');

$mime = mime_content_type($f['tmp_name']);
if (!in_array($mime, $config['uploads']['allowed_mime'], true)) die('Invalid file type.');

$ext = match ($mime) {
  'image/jpeg' => 'jpg',
  'image/png' => 'png',
  'image/webp' => 'webp',
  'image/gif' => 'gif',
  default => 'bin'
};

$base = bin2hex(random_bytes(16));
$filename = $base . '.' . $ext;

if (!is_dir($config['uploads']['dir'])) mkdir($config['uploads']['dir'], 0775, true);

$dest = $config['uploads']['dir'] . '/' . $filename;
if (!move_uploaded_file($f['tmp_name'], $dest)) die('Upload failed.');

$url = rtrim($config['uploads']['public_path'], '/') . '/' . $filename;
$alt = trim((string)($_POST['alt_text'] ?? ''));

$stmt = $pdo->prepare("INSERT INTO media (filename, url, mime_type, size, alt_text) VALUES (?,?,?,?,?)");
$stmt->execute([$filename, $url, $mime, (int)$f['size'], $alt]);

header('Location: media.php');
exit;
