<?php

/**
 * contact-handler.php
 *
 * Handles contact form submissions.
 * Validates input, sends an email via PHPMailer, and returns a JSON response.
 * Called via fetch() in script.js — not visited directly.
 */

require_once 'includes/config.php';

// Load PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/phpmailer/phpmailer/src/Exception.php';
require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';

// Only accept POST requests — reject anything else
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

// Tell the browser we are returning JSON
header('Content-Type: application/json');

/* ===========================
   Sanitise & Validate Input
=========================== */

// Trim whitespace and strip any HTML/PHP tags from each field
$name    = trim(strip_tags($_POST['name']    ?? ''));
$email   = trim(strip_tags($_POST['email']   ?? ''));
$message = trim(strip_tags($_POST['message'] ?? ''));

$errors = [];

// Name — required, reasonable length
if (empty($name)) {
    $errors[] = 'Name is required.';
} elseif (strlen($name) > 100) {
    $errors[] = 'Name must be 100 characters or fewer.';
}

// Email — required and must be a valid format
if (empty($email)) {
    $errors[] = 'Email address is required.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
}

// Message — required, reasonable length
if (empty($message)) {
    $errors[] = 'Message is required.';
} elseif (strlen($message) > 5000) {
    $errors[] = 'Message must be 5000 characters or fewer.';
}

// If there are any validation errors, return them now
if (!empty($errors)) {
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

/* ===========================
   Send Email via PHPMailer
=========================== */

$mail = new PHPMailer(true);

try {
    // Use SMTP to send the email
    $mail->isSMTP();
    $mail->Host       = MAIL_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = MAIL_USERNAME;
    $mail->Password   = MAIL_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = MAIL_PORT;

    // Who the email is from — use the site address as the sender
    // and set the submitter's email as the reply-to so you can reply directly
    $mail->setFrom(MAIL_USERNAME, MAIL_FROM_NAME);
    $mail->addReplyTo($email, $name);

    // Who the email is going to
    $mail->addAddress(MAIL_TO, MAIL_TO_NAME);

    // Email content
    $mail->Subject = 'New Contact Form Submission — ' . SITE_NAME;
    $mail->Body    =
        "Name:    $name\n" .
        "Email:   $email\n\n" .
        "Message:\n$message";

    $mail->send();

    echo json_encode(['success' => true, 'message' => 'Message sent! I\'ll get back to you within 24 hours.']);

} catch (Exception $e) {
    // Log the actual error server-side but return a safe generic message to the user
    error_log('PHPMailer error: ' . $mail->ErrorInfo);
    echo json_encode(['success' => false, 'message' => 'Something went wrong. Please try again or reach out via social media.']);
}
