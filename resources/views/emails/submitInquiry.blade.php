<!DOCTYPE html>
<html>
<head>
    <title>Inquiry Submitted</title>
    <style>
        body, table, td, div, p, a {
            margin: 0; padding: 0; border: 0; font-size: 100%; font: inherit; vertical-align: baseline;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7f7; color: #333333; line-height: 1.6;
        }
        .email-container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header {
            background-color: #ffcc00; padding: 30px 20px; text-align: center; border-radius: 8px 8px 0 0;
        }
        .header h1 { color: #333333; font-size: 28px; font-weight: 700; margin-bottom: 10px; }
        .content {
            background-color: #ffffff; padding: 30px; border-radius: 0 0 8px 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        .info-box {
            background-color: #fff8e0; border-radius: 6px; padding: 15px; margin: 20px 0;
            border-left: 3px solid #ffcc00;
        }
        .footer { text-align: center; padding: 20px 0; font-size: 12px; color: #999999; }
        .btn {
            display: inline-block; background-color: #ffcc00; color: #333333 !important; text-decoration: none;
            padding: 12px 30px; margin: 20px 0; border-radius: 4px; font-weight: 600; font-size: 16px;
            text-align: center; border: 1px solid #e6b800;
        }
        .btn:hover { background-color: #e6b800; }
        .logo { text-align: center; margin-bottom: 20px; }
        .logo-placeholder {
            display: inline-block; width: 60px; height: 60px; background-color: #ffcc00; border-radius: 50%;
            color: #333333; font-size: 30px; line-height: 60px; font-weight: bold;
        }
        @media only screen and (max-width: 600px) {
            .email-container { padding: 10px; }
            .content { padding: 20px; }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="logo">
            <div class="logo-placeholder">✓</div>
        </div>
        <div class="header">
            <h1>Inquiry Submitted Successfully</h1>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>Your inquiry has been <strong>successfully submitted</strong>. Our team will review it and get back to you shortly.</p>
            <div class="info-box">
                <p>We appreciate your patience. You can track the status of your inquiry anytime.</p>
            </div>
            <p style="text-align:center;">
                <a href="{{ $inquiryUrl }}" class="btn">Track My Inquiry</a>
            </p>
            <p>Best regards,<br>UAT & Training - Customer Care Support</p>
            <p><a href="mailto:CCTraining@mtn.com.sy">CCTraining@mtn.com.sy</a></p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} MTN Syria. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
