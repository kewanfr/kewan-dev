<?php
declare(strict_types=1);

function env(string $key, ?string $default = null): string {
  $v = getenv($key);
  if ($v === false || $v === '') {
    if ($default !== null) return $default;
    throw new RuntimeException("Variable d'environnement manquante: {$key}");
  }
  return $v;
}
