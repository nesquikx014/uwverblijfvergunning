<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$topic = isset($_POST['topic']) ? trim($_POST['topic']) : 'intake';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: index.php?message=error');
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

if (mail($to, $subject, $mailContent, $formattedHeaders)) {
    header('Location: index.php?message=success');
    exit;
}

header('Location: index.php?message=error');
exit;
