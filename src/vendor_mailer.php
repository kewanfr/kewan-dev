<?php
declare(strict_types=1);

require_once __DIR__ . '/_config.php';

function send_smtp_mail(string $to, string $subject, string $body, string $from, string $replyTo): bool {
  // Si PHPMailer n’est pas installé
  if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    return false;
  }

  require_once __DIR__ . '/vendor/autoload.php';

  $mail = new PHPMailer\PHPMailer\PHPMailer(true);

  try {
    $mail->isSMTP();
    $mail->Host = env('SMTP_HOST', 'mailpit');
    $mail->Port = (int)env('SMTP_PORT', '1025');
    $mail->SMTPAuth = false; // Mailpit sans auth en dev

    $mail->setFrom($from, 'Site');
    $mail->addAddress($to);
    $mail->addReplyTo($replyTo);

    $mail->Subject = $subject;
    $mail->Body = $body;

    return $mail->send();
  } catch (Throwable $e) {
    return false;
  }
}
