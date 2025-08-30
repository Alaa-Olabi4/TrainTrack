<!DOCTYPE html>
<html>

<head>
    <title>New Task Notification</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7f7;
            color: #333333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #ffcc00;
            padding: 30px 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .header h1 {
            font-size: 26px;
            font-weight: bold;
            margin: 0;
        }

        .content {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .btn {
            display: inline-block;
            background-color: #ffcc00;
            color: #333333 !important;
            text-decoration: none;
            padding: 12px 30px;
            margin-top: 20px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 16px;
            border: 1px solid #e6b800;
        }

        .btn:hover {
            background-color: #e6b800;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #999999;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>New Tasks Assigned</h1>
        </div>
        <div class="content">
            <p>You have a new tasks waiting for your attention.</p>
            <a href="{{ $taskUrl }}" class="btn">Open Task</a>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} MTN Syria. All rights reserved.</p>
        </div>
    </div>
</body>

</html>