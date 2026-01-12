<?php
require __DIR__ . '/db.php';

echo "DB=" . db()->query("SELECT DATABASE()")->fetchColumn() . "<br>";
echo "Pages=" . db()->query("SELECT COUNT(*) FROM pages")->fetchColumn() . "<br>";

echo "<pre>";
foreach (db()->query("SELECT id,title,slug,status,updated_at FROM pages ORDER BY id DESC LIMIT 10") as $r) {
  print_r($r);
}
echo "</pre>";
?>