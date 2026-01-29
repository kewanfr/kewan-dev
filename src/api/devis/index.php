<?php
declare(strict_types=1);

require_once __DIR__ . '/../_lib/db.php';
require_once __DIR__ . '/../_lib/utils.php';
require_once __DIR__ . '/../_lib/mailer.php';

require_post();
// check_honeypot('website'); // si tu ajoutes un champ caché côté HTML

$name = clean_one_line((string)($_POST['name'] ?? ''));
$personType = clean_one_line((string)($_POST['personType'] ?? ''));
$email = clean_one_line((string)($_POST['email'] ?? ''));
$phone = clean_one_line((string)($_POST['phone'] ?? ''));
$forfait = clean_one_line((string)($_POST['forfait'] ?? ''));
$autre = clean_one_line((string)($_POST['autre'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));

// services peut être "string" ou "array" selon le navigateur / sélection
$services = $_POST['services'] ?? [];
if (is_string($services)) $services = [$services];
if (!is_array($services)) $services = [];

$services = array_values(array_unique(array_map('clean_one_line', $services)));
$services = array_filter($services, fn($s) => $s !== '');

// Validation minimum
if ($name === '' || mb_strlen($name) > 120) json_response(['ok'=>false,'error'=>'Nom invalide'], 400);
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 190) json_response(['ok'=>false,'error'=>'Email invalide'], 400);
if ($message === '') json_response(['ok'=>false,'error'=>'Message requis'], 400);
if ($phone !== '' && mb_strlen($phone) > 40) json_response(['ok'=>false,'error'=>'Téléphone invalide'], 400);
if ($autre !== '' && mb_strlen($autre) > 255) json_response(['ok'=>false,'error'=>'Champ "Autre besoin" trop long'], 400);

// Listes autorisées (pour éviter qu’on t’injecte n’importe quoi)
$allowedPerson = ['', 'particulier', 'entreprise', 'association', 'autre'];
$allowedForfait = ['', 'essentiel', 'standard', 'avance'];
$allowedServices = ['cours','vitrine','wordpress','backend','conseil','intervention'];

if (!in_array($personType, $allowedPerson, true)) json_response(['ok'=>false,'error'=>'personType invalide'], 400);
if (!in_array($forfait, $allowedForfait, true)) json_response(['ok'=>false,'error'=>'forfait invalide'], 400);

foreach ($services as $s) {
  if (!in_array($s, $allowedServices, true)) {
    json_response(['ok'=>false,'error'=>"Service invalide: {$s}"], 400);
  }
}

$ip = client_ip();
$ua = user_agent();

$stmt = db()->prepare(
  "INSERT INTO devis_requests (name, person_type, email, phone, services_json, forfait, autre, message, ip, user_agent)
   VALUES (:name, :person_type, :email, :phone, :services_json, :forfait, :autre, :message, :ip, :ua)"
);

$servicesJson = empty($services) ? null : json_encode($services, JSON_UNESCAPED_UNICODE);

$stmt->execute([
  ':name' => $name,
  ':person_type' => ($personType !== '' ? $personType : null),
  ':email' => $email,
  ':phone' => ($phone !== '' ? $phone : null),
  ':services_json' => $servicesJson,
  ':forfait' => ($forfait !== '' ? $forfait : null),
  ':autre' => ($autre !== '' ? $autre : null),
  ':message' => $message,
  ':ip' => $ip,
  ':ua' => $ua,
]);

$servicesStr = empty($services) ? '(aucun)' : implode(', ', $services);
$subject = "[Devis] {$name}";
$body =
  "Nouvelle demande de devis\n\n"
  . "Nom: {$name}\n"
  . "Type: {$personType}\n"
  . "Email: {$email}\n"
  . "Téléphone: {$phone}\n"
  . "Services: {$servicesStr}\n"
  . "Forfait: {$forfait}\n"
  . "Autre: {$autre}\n"
  . "IP: " . ($ip ?? '-') . "\n"
  . "User-Agent: " . ($ua ?? '-') . "\n\n"
  . "Message:\n{$message}\n";

$sent = send_smtp_mail($subject, $body, $email, $name);

json_response([
  'ok' => true,
  'saved' => true,
  'mail_sent' => $sent,
]);
