<?php
// admin/db.php
declare(strict_types=1);

$config = require __DIR__ . '/config.php';

function db(): PDO {
  static $pdo = null;
  if ($pdo) return $pdo;

  $config = require __DIR__ . '/config.php';
  $db = $config['db'];
  $port = $db['port'] ?? 25060;
  $dsn = "mysql:host={$db['host']};dbname={$db['name']};charset={$db['charset']}";

  $pdo = new PDO($dsn, $db['user'], $db['pass'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);

  return $pdo;
}
