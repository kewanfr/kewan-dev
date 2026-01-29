<?php
declare(strict_types=1);

require_once __DIR__ . '/api/_lib/db.php';

$sql = file_get_contents(__DIR__ . '/sql/init.sql');
if ($sql === false) {
  http_response_code(500);
  exit("Impossible de lire src/sql/init.sql");
}

db()->exec($sql);
echo "OK: tables créées.\n";
