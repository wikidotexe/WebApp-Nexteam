<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #0d6efd;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background: #0d6efd;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
        }
        .email-body p {
            margin: 10px 0;
        }
        .email-footer {
            text-align: center;
            background: #f4f4f4;
            padding: 10px;
            font-size: 14px;
            color: #777;
        }
        .email-footer a {
            color: #0d6efd;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>You Have a New Message</h1>
        </div>
        <div class="email-body">
            <p><strong>Name:</strong> {{ $mailData['name'] }}</p>
            <p><strong>Email:</strong> {{ $mailData['email'] }}</p>
            <p><strong>Message:</strong></p>
            <p style="white-space: pre-line;">{{ $mailData['message'] }}</p>
        </div>
        <div class="email-footer">
            <p>Thank you for reaching out!</p>
            <p><a href="https://nofileexistshere.com">Visit Our Website</a></p>
        </div>
    </div>
</body>
</html>
