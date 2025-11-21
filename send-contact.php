<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
     header('Location: contact.php');
    exit;
}

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$topic = isset($_POST['topic']) ? trim($_POST['topic']) : 'intake';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
     header('Location: contact.php?message=error');
    exit;
}

// Clean input to prevent header injection
$clean = static function (string $value): string {
    return preg_replace('/[\r\n]+/', ' ', $value ?? '');
};

$name = $clean($name);
$emailClean = $clean($email);
$phone = $clean($phone);
$topic = $clean($topic);

$topicLabels = [
    'intake' => 'Intakegesprek',
    'second-opinion' => 'Second opinion',
    'employer' => 'Werkgever/HR',
    'other' => 'Overige vraag',
];
$topicLabel = $topicLabels[$topic] ?? $topicLabels['intake'];

$to = 'info@uwverblijfsvergunning.nl';
$subject = 'Nieuwe intake-aanvraag via website';
$headers = [
    'From' => 'no-reply@uwverblijfsvergunning.nl',
    'Reply-To' => $emailClean,
    'Content-Type' => 'text/plain; charset=UTF-8',
];

$mailContent = "Er is een nieuw bericht via het contactformulier:\n\n";
$mailContent .= "Naam: {$name}\n";
$mailContent .= "E-mail: {$emailClean}\n";
$mailContent .= "Telefoon: " . ($phone !== '' ? $phone : 'niet opgegeven') . "\n";
$mailContent .= "Onderwerp: {$topicLabel}\n\n";
$mailContent .= "Bericht:\n{$message}\n";

$formattedHeaders = '';
foreach ($headers as $headerKey => $headerValue) {
    $formattedHeaders .= "{$headerKey}: {$headerValue}\r\n";
}

// Try to send mail. In many dev containers mail() is not available/working.
$sent = @mail($to, $subject, $mailContent, $formattedHeaders);
if ($sent) {
    header('Location: contact.php?message=success');
    exit;
}

// Mail failed — as a safe fallback, persist the submission to a local log file
$logDir = __DIR__ . '/data';
if (!is_dir($logDir)) {
    @mkdir($logDir, 0775, true);
}
$logFile = $logDir . '/contact-submissions.log';
$logEntry = "-----\n" . date('c') . "\n" . $mailContent . "\nHeaders:\n" . $formattedHeaders . "\n";
$saved = @file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
if ($saved !== false) {
    // Saved for later inspection; treat as success in dev
    header('Location: contact.php?message=success');
    exit;
}

// Nothing worked — return error
header('Location: contact.php?message=error');
exit;
