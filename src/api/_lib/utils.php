<?php
declare(strict_types=1);

function json_response(array $data, int $status = 200): void {
  http_response_code($status);
  header('Content-Type: application/json; charset=utf-8');
  header('X-Content-Type-Options: nosniff');
  echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  exit;
}

function require_post(): void {
  if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    json_response(['ok' => false, 'error' => 'Méthode non autorisée'], 405);
  }
}

function clean_one_line(string $s): string {
  $s = trim($s);
  $s = preg_replace('/\s+/', ' ', $s) ?? $s;
  return trim($s);
}

function client_ip(): ?string {
  // Ne pas “faire confiance” aveuglément à X-Forwarded-For si tu es en public.
  // Ici, on garde REMOTE_ADDR (fiable), et on ignore le reste par défaut.
  return $_SERVER['REMOTE_ADDR'] ?? null;
}

function user_agent(): ?string {
  $ua = $_SERVER['HTTP_USER_AGENT'] ?? null;
  if ($ua === null) return null;
  return mb_substr($ua, 0, 255);
}

// Basique anti-spam : champ honeypot optionnel (si tu l’ajoutes côté HTML)
function check_honeypot(string $fieldName = 'website'): void {
  if (!empty($_POST[$fieldName])) {
    json_response(['ok' => false, 'error' => 'Spam détecté'], 400);
  }
}
