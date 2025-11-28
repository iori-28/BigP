<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/BigP/vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/BigP/config/db.php';
require $_SERVER['DOCUMENT_ROOT'] . '/BigP/config/env.php';

class NotificationService
{

    public static function sendEmail($email, $subject, $message, $user_id = null)
    {
        $mail = new PHPMailer(true);
        $status = 'sent';

        try {
            $mail->isSMTP();
            $mail->Host       = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['MAIL_USERNAME'];
            $mail->Password   = $_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = 'tls';
            $mail->Port       = $_ENV['MAIL_PORT'];

            $mail->setFrom($_ENV['MAIL_USERNAME'], $_ENV['MAIL_FROM_NAME']);
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
        } catch (Exception $e) {
            $status = 'failed';
        }

        // ✅ LOG KE DATABASE
        $conn = Database::connect();
        $stmt = $conn->prepare("
      INSERT INTO notifications (id_user, judul, pesan, channel, status)
      VALUES (?, ?, ?, 'email', ?)
    ");

        $stmt->execute([
            $user_id,
            $subject,
            $message,
            $status
        ]);

        return $status;
    }
}
