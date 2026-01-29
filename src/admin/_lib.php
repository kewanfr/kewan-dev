<?php
declare(strict_types=1);

require_once __DIR__ . '/../api/_lib/config.php';
require_once __DIR__ . '/../api/_lib/db.php';

function admin_session_start(): void {
  if (session_status() !== PHP_SESSION_ACTIVE) {
    // Cookies de session un minimum propres
    session_set_cookie_params([
      'httponly' => true,
      'samesite' => 'Lax',
      'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
      'path' => '/',
    ]);
    session_start();
  }
}

function admin_is_logged_in(): bool {
  admin_session_start();
  return !empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function admin_require_login(): void {
  if (!admin_is_logged_in()) {
    header('Location: /admin/login.php');
    exit;
  }
}

function csrf_token(): string {
  admin_session_start();
  if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
  }
  return $_SESSION['csrf'];
}

function csrf_check(): void {
  admin_session_start();
  $ok = isset($_POST['csrf'], $_SESSION['csrf']) && hash_equals($_SESSION['csrf'], (string)$_POST['csrf']);
  if (!$ok) {
    http_response_code(403);
    exit('CSRF invalide.');
  }
}

function h(string $s): string {
  return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
