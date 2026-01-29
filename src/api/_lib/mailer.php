<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

function send_smtp_mail(string $subject, string $body, string $replyToEmail, string $replyToName): bool {
  $autoload = __DIR__ . '/../../vendor/autoload.php';
  if (!file_exists($autoload)) {
    // PHPMailer pas installé
    return false;
  }
  require_once $autoload;

  $host = env('SMTP_HOST');
  $port = (int)env('SMTP_PORT', '587');
  $user = env('SMTP_USER');
  $pass = env('SMTP_PASS');
  $enc  = strtolower(env('SMTP_ENCRYPTION', 'tls')); // tls|ssl|none

  $to = env('MAIL_TO');
  $from = env('MAIL_FROM');
  $fromName = env('MAIL_FROM_NAME', 'Site');

  $mail = new PHPMailer\PHPMailer\PHPMailer(true);

  try {
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->Host = $host;
    $mail->Port = $port;
    $mail->SMTPAuth = true;
    $mail->Username = $user;
    $mail->Password = $pass;

    if ($enc === 'ssl') {
      $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
    } elseif ($enc === 'tls') {
      $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
    } else {
      $mail->SMTPSecure = false;
      $mail->SMTPAutoTLS = false;
    }

    // Optionnel: timeout raisonnable
    $mail->Timeout = 10;

    $mail->setFrom($from, $fromName);
    $mail->addAddress($to);
    $mail->addReplyTo($replyToEmail, $replyToName);

    $mail->Subject = $subject;
    $mail->Body = $body;

    return $mail->send();
  } catch (Throwable $e) {
    return false;
  }
}
