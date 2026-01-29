<?php
declare(strict_types=1);

require_once __DIR__ . '/../_lib/db.php';
require_once __DIR__ . '/../_lib/utils.php';
require_once __DIR__ . '/../_lib/mailer.php';

require_post();
// check_honeypot('website'); // si tu ajoutes un champ caché côté HTML

$name = clean_one_line((string)($_POST['name-contact'] ?? ''));
$email = clean_one_line((string)($_POST['email-contact'] ?? ''));
$phone = clean_one_line((string)($_POST['phone-contact'] ?? ''));
$message = trim((string)($_POST['message-contact'] ?? ''));

if ($name === '' || mb_strlen($name) > 120) json_response(['ok'=>false,'error'=>'Nom invalide'], 400);
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 190) json_response(['ok'=>false,'error'=>'Email invalide'], 400);
if ($message === '') json_response(['ok'=>false,'error'=>'Message requis'], 400);
if ($phone !== '' && mb_strlen($phone) > 40) json_response(['ok'=>false,'error'=>'Téléphone invalide'], 400);

$ip = client_ip();
$ua = user_agent();

$stmt = db()->prepare(
  "INSERT INTO contact_messages (name, email, phone, message, ip, user_agent)
   VALUES (:name, :email, :phone, :message, :ip, :ua)"
);
$stmt->execute([
  ':name' => $name,
  ':email' => $email,
  ':phone' => ($phone !== '' ? $phone : null),
  ':message' => $message,
  ':ip' => $ip,
  ':ua' => $ua,
]);

$subject = "[Contact] {$name}";
$body =
  "Nouveau message de contact\n\n"
  . "Nom: {$name}\n"
  . "Email: {$email}\n"
  . "Téléphone: {$phone}\n"
  . "IP: " . ($ip ?? '-') . "\n"
  . "User-Agent: " . ($ua ?? '-') . "\n\n"
  . "Message:\n{$message}\n";

$sent = send_smtp_mail($subject, $body, $email, $name);

// Réponse JSON (tu peux aussi rediriger vers une page merci)
json_response([
  'ok' => true,
  'saved' => true,
  'mail_sent' => $sent,
]);
