<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Email Subject</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for email clients */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            padding: 10px 20px;
            text-decoration: none;
            color: white !important;
            display: inline-block;
            border-radius: 5px;
        }
        @media only screen and (max-width: 600px) {
            .mobile-responsive {
                width: 100% !important;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="header">
            <img src="{{ asset('front/img/logo.png') }}" alt="Company Logo" class="img-fluid mobile-responsive" style="max-width: 150px;">
            <h1 style="margin-top: 15px; color: #343a40;">E-train</h1>
        </div>

        <!-- Main Content -->
        <div class="content">
            <h2 style="color: #0d6efd;">Hello {{ $name }}</h2>

            <p>This is Welcome Email For You</p>


            <!-- Call to Action Button -->
            <div class="text-center my-4">
                <a href="[ACTION_URL]" class="btn-primary">We are happy to join with us</a>
            </div>

            <p>If you have any questions, please don't hesitate to <a href="eng.taha1608@gmail.com">contact us</a>.</p>

            <p>Best regards,<br>
            {{'Alfawakhry'}}<br>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>&copy; 2025 E-train. All rights reserved.</p>
            <p>
                <a href="[UNSUBSCRIBE_LINK]" style="color: #6c757d; text-decoration: none;">Unsubscribe</a> |
                <a href="[PRIVACY_POLICY]" style="color: #6c757d; text-decoration: none;">Privacy Policy</a>
            </p>
        </div>
    </div>
</body>
</html>
