<?php
// admin/header.php
require __DIR__ . '/auth.php';
require_login();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin</title>
  <style>
    body{font-family:system-ui,Arial;margin:20px;}
    nav a{margin-right:12px;}
    table{border-collapse:collapse;width:100%;}
    th,td{border:1px solid #ddd;padding:8px;}
    th{background:#f6f6f6;text-align:left;}
    input,select,textarea{width:100%;max-width:900px;padding:8px;}
    textarea{height:220px;}
    .row{display:flex;gap:12px;flex-wrap:wrap;}
    .col{flex:1;min-width:280px;}
  </style>
</head>
<body>
<nav>
  <a href="pages.php">Pages</a>
  <a href="services.php">Services</a>
  <a href="media.php">Media</a>
  <a href="logout.php">Logout</a>
</nav>
<hr>
