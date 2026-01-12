<?php
// admin/config.php
declare(strict_types=1);

return [
  'db' => [
    'host' => 'db-mysql-nyc3-41243-do-user-16114214-0.k.db.ondigitalocean.com',
    'name' => 'alignpoint',
    'user' => 'doadmin',
    'pass' => 'AVNS_sa2vO1ti8ImB60BbBSK',
    'port' => 25060, // optional
    'charset' => 'utf8mb4',
  ],

  // Simple admin auth (replace with env var in production)
  'admin' => [
    'username' => 'admin',
    // Generate with: php -r "echo password_hash('YOURPASS', PASSWORD_DEFAULT), PHP_EOL;"
    'password_hash' => 'abcd@1234',
  ],

  'uploads' => [
    'dir' => __DIR__ . '/uploads',
    'public_path' => '/admin/uploads', // adjust if needed
    'max_bytes' => 10 * 1024 * 1024,   // 10MB
    'allowed_mime' => ['image/jpeg', 'image/png', 'image/webp', 'image/gif'],
  ]
];
