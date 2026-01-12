<?php
// admin/auth.php
declare(strict_types=1);
session_start();

function require_login(): void {
  if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: index.php');
    exit;
  }
}

function is_post(): bool {
  return ($_SERVER['REQUEST_METHOD'] ?? '') === 'POST';
}

function e(string $s): string {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
