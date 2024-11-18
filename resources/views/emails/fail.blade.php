<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thông báo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }
        .danger-container {
            text-align: center;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 90%;
        }
        .danger-icon {
            color: #ac0000;
            font-size: 48px;
            margin-bottom: 20px;
        }
        .danger-message {
            color: #333;
            font-size: 20px;
            margin-bottom: 15px;
        }
        .thank-you {
            color: #666;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="danger-container">
        <div class="danger-icon">✓</div>
        <div class="danger-message">{{ $message }}</div>
        <div class="thank-you">Cảm ơn bạn đã phản hồi!</div>
    </div>
</body>
</html>
