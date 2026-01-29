<?php
declare(strict_types=1);

require_once __DIR__ . '/_lib.php';

admin_session_start();

if (admin_is_logged_in()) {
  header('Location: /admin/');
  exit;
}

$error = null;

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
  csrf_check();

  $password = (string)($_POST['password'] ?? '');
  $hash = env('ADMIN_PASSWORD_HASH', '');

  if ($hash === '') {
    $error = "ADMIN_PASSWORD_HASH manquant dans .env";
  } else if (password_verify($password, $hash)) {
    // Login OK
    session_regenerate_id(true);
    $_SESSION['admin_logged_in'] = true;
    header('Location: /admin/');
    exit;
  } else {
    $error = "Mot de passe incorrect.";
  }
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Admin - Connexion</title>
  <style>
    body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; padding: 24px; }
    .card { max-width: 420px; margin: 8vh auto; border: 1px solid #ddd; border-radius: 14px; padding: 18px; }
    label { display:block; margin: 10px 0 6px; }
    input { width: 100%; padding: 10px 12px; border-radius: 10px; border: 1px solid #ccc; }
    button { margin-top: 14px; padding: 10px 14px; border-radius: 10px; border: 0; cursor:pointer; }
    .err { color: #b91c1c; margin-top: 10px; }
  </style>
</head>
<body>
  <div class="card">
    <h1>Connexion admin</h1>
    <form method="post" action="/admin/login.php">
      <input type="hidden" name="csrf" value="<?= h(csrf_token()) ?>">
      <label for="password">Mot de passe</label>
      <input id="password" name="password" type="password" required autofocus>
      <button type="submit">Se connecter</button>
      <?php if ($error): ?>
        <div class="err"><?= h($error) ?></div>
      <?php endif; ?>
    </form>
  </div>
</body>
</html>
