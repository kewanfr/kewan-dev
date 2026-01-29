<?php
declare(strict_types=1);

require_once __DIR__ . '/_lib.php';

admin_require_login();

$contacts = db()->query("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 500")->fetchAll();
$devis = db()->query("SELECT * FROM devis_requests ORDER BY created_at DESC LIMIT 500")->fetchAll();
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Admin</title>
  <style>
    body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; padding: 18px; }
    header { display:flex; align-items:center; justify-content:space-between; gap: 12px; }
    a.btn { display:inline-block; padding: 8px 12px; border-radius: 10px; border: 1px solid #ddd; text-decoration:none; }
    h2 { margin-top: 28px; }
    table { border-collapse: collapse; width: 100%; margin-top: 10px; }
    th, td { border: 1px solid #ddd; padding: 8px; vertical-align: top; }
    pre { white-space: pre-wrap; margin: 0; }
    .muted { color:#666; font-size: 12px; }
  </style>
</head>
<body>
  <header>
    <div>
      <h1>Admin</h1>
      <div class="muted">Contacts: <?= count($contacts) ?> | Devis: <?= count($devis) ?></div>
    </div>
    <div>
      <a class="btn" href="/admin/logout.php">Se déconnecter</a>
    </div>
  </header>

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
