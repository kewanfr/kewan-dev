<?php
declare(strict_types=1);

function csrf_start(): void {
  if (session_status() !== PHP_SESSION_ACTIVE) session_start();
  if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
  }
}

function csrf_token(): string {
  csrf_start();
  return $_SESSION['csrf'];
}

function csrf_check(): void {
  csrf_start();
  $ok = isset($_POST['csrf'], $_SESSION['csrf']) && hash_equals($_SESSION['csrf'], (string)$_POST['csrf']);
  if (!$ok) {
    http_response_code(403);
    exit('CSRF invalide.');
  }
}
