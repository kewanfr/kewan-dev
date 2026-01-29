<?php
declare(strict_types=1);

require_once __DIR__ . '/../_lib/db.php';
require_once __DIR__ . '/../_lib/config.php';

$pass = env('ADMIN_PASSWORD', 'change-moi');
$provided = $_SERVER['HTTP_X_ADMIN_PASSWORD'] ?? ($_GET['p'] ?? '');

if (!hash_equals($pass, (string)$provided)) {
  http_response_code(401);
  header('Content-Type: text/plain; charset=utf-8');
  echo "Accès refusé.\n";
  echo "Ajoute ?p=TON_MDP (temporaire). En prod: vraie auth + session + restriction IP.\n";
  exit;
}

$contacts = db()->query("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 300")->fetchAll();
$devis = db()->query("SELECT * FROM devis_requests ORDER BY created_at DESC LIMIT 300")->fetchAll();

function h(string $s): string { return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }

?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Admin - messages</title>
  <style>
    body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; padding: 18px; }
    h2 { margin-top: 32px; }
    table { border-collapse: collapse; width: 100%; margin-top: 10px; }
    th, td { border: 1px solid #ddd; padding: 8px; vertical-align: top; }
    pre { white-space: pre-wrap; margin: 0; }
    .muted { color:#666; font-size: 12px; }
  </style>
</head>
<body>
  <h1>Admin</h1>
  <div class="muted">Contact: <?= count($contacts) ?> | Devis: <?= count($devis) ?></div>

  <h2>Contacts</h2>
  <table>
    <thead>
      <tr>
        <th>Date</th><th>Nom</th><th>Email</th><th>Tél</th><th>Message</th><th>IP</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($contacts as $c): ?>
      <tr>
        <td><?= h((string)$c['created_at']) ?></td>
        <td><?= h((string)$c['name']) ?></td>
        <td><?= h((string)$c['email']) ?></td>
        <td><?= h((string)($c['phone'] ?? '')) ?></td>
        <td><pre><?= h((string)$c['message']) ?></pre></td>
        <td><?= h((string)($c['ip'] ?? '')) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h2>Devis</h2>
  <table>
    <thead>
      <tr>
        <th>Date</th><th>Nom</th><th>Type</th><th>Email</th><th>Tél</th><th>Services</th><th>Forfait</th><th>Autre</th><th>Message</th><th>IP</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($devis as $d): ?>
      <tr>
        <td><?= h((string)$d['created_at']) ?></td>
        <td><?= h((string)$d['name']) ?></td>
        <td><?= h((string)($d['person_type'] ?? '')) ?></td>
        <td><?= h((string)$d['email']) ?></td>
        <td><?= h((string)($d['phone'] ?? '')) ?></td>
        <td><?= h((string)($d['services_json'] ?? '')) ?></td>
        <td><?= h((string)($d['forfait'] ?? '')) ?></td>
        <td><?= h((string)($d['autre'] ?? '')) ?></td>
        <td><pre><?= h((string)$d['message']) ?></pre></td>
        <td><?= h((string)($d['ip'] ?? '')) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
