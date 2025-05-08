<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <style>
        :root {
            --navy-blue: #111F4D;
            --light-gray: #F2F4F7;
            --vibrant-red: #E43A19;
            --deep-black: #020205;
            --gold-accent: #FFD700;
            --soft-white: #FFFFFF;
            --platinum: #E5E4E2;
            --silver: #C0C0C0;
            --dark-navy: #0A142F;
            --light-blue: #E6F0FF;
            --success-green: #28a745;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
            background-color: var(--light-gray);
            color: var(--deep-black);
            line-height: 1.6;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: var(--soft-white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(1, 31, 77, 0.15);
        }

        .header {
            background: linear-gradient(135deg, var(--navy-blue), var(--dark-navy));
            padding: 40px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, var(--gold-accent), var(--vibrant-red), var(--gold-accent));
        }

        .header h1 {
            color: var(--soft-white);
            font-size: 2.5rem;
            margin: 0;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .header h1::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--gold-accent);
            border-radius: 2px;
        }

        .content {
            padding: 40px;
            text-align: center;
        }

        .welcome-message {
            font-size: 1.5rem;
            color: var(--navy-blue);
            margin-bottom: 30px;
            line-height: 1.4;
            position: relative;
            padding-bottom: 20px;
        }

        .welcome-message::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--vibrant-red);
            border-radius: 2px;
        }

        .custom-message {
            background-color: var(--light-blue);
            border-left: 4px solid var(--vibrant-red);
            padding: 20px;
            margin: 30px 0;
            border-radius: 0 8px 8px 0;
            text-align: left;
            font-size: 1.1rem;
            line-height: 1.6;
            color: var(--dark-navy);
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(to right, var(--navy-blue), var(--dark-navy));
            color: var(--soft-white) !important;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            margin: 20px 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(17, 31, 77, 0.2);
        }

        .cta-button:hover {
            background: linear-gradient(to right, var(--vibrant-red), #c0392b);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(228, 58, 25, 0.3);
        }

        .footer {
            background-color: var(--navy-blue);
            color: var(--platinum);
            padding: 20px;
            text-align: center;
            font-size: 0.9rem;
        }

        .social-icons {
            margin: 20px 0;
        }

        .social-icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: var(--soft-white);
            border-radius: 50%;
            margin: 0 8px;
            text-align: center;
            line-height: 40px;
            color: var(--navy-blue);
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background-color: var(--gold-accent);
            transform: translateY(-3px);
        }

        .decoration {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, rgba(255, 215, 0, 0) 70%);
        }

        .decoration-1 {
            top: -50px;
            left: -50px;
        }

        .decoration-2 {
            bottom: -50px;
            right: -50px;
        }

        @media (max-width: 640px) {
            .email-container {
                border-radius: 0;
            }

            .header {
                padding: 30px 15px;
            }

            .header h1 {
                font-size: 2rem;
            }

            .content {
                padding: 30px 20px;
            }

            .welcome-message {
                font-size: 1.3rem;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .content {
            animation: fadeIn 0.6s ease-out forwards;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <div class="decoration decoration-1"></div>
            <div class="decoration decoration-2"></div>
            <h1>Welcome To Our Company</h1>
        </div>

        <div class="content">
            <p class="welcome-message">We're thrilled to have you on board</p>

            <div class="custom-message">
                {{$msg}}
            </div>

            <a href="#" class="cta-button">Get Started</a>

            <div class="social-icons">
                <a href="#" class="social-icon">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-icon">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="social-icon">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="#" class="social-icon">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>

        <div class="footer">
            &copy; 2025 Our Company. All rights reserved.<br>
            <small>123 Business Ave, Suite 100, City, Country</small>
        </div>
    </div>

    <!-- Font Awesome for icons (would be loaded externally in real email) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>

</html>