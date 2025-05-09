<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome Email</title>
</head>

<body style="margin:0; padding:0; font-family:'Segoe UI', 'Helvetica Neue', Arial, sans-serif; background-color:#F2F4F7; color:#020205; line-height:1.6;">
    <!-- Main Container -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F2F4F7">
        <tr>
            <td align="center" valign="top">
                <!-- Email Container -->
                <table width="600" border="0" cellspacing="0" cellpadding="0" style="background-color:#FFFFFF; border-radius:12px; overflow:hidden; box-shadow:0 10px 30px rgba(1, 31, 77, 0.15);">
                    <!-- Header -->
                    <tr>
                        <td style="background:linear-gradient(135deg, #111F4D, #0A142F); padding:40px 20px; text-align:center; position:relative; overflow:hidden;">
                            <!-- Gradient Border -->
                            <div style="position:absolute; top:0; left:0; width:100%; height:8px; background:linear-gradient(90deg, #FFD700, #E43A19, #FFD700);"></div>
                            <!-- Decoration Circles -->
                            <div style="position:absolute; width:200px; height:200px; border-radius:50%; background:radial-gradient(circle, rgba(255,215,0,0.1) 0%, rgba(255,215,0,0) 70%); top:-50px; left:-50px;"></div>
                            <div style="position:absolute; width:200px; height:200px; border-radius:50%; background:radial-gradient(circle, rgba(255,215,0,0.1) 0%, rgba(255,215,0,0) 70%); bottom:-50px; right:-50px;"></div>
                            <!-- Title -->
                            <h1 style="color:#FFFFFF; font-size:2.5rem; margin:0; position:relative; z-index:1; text-shadow:0 2px 4px rgba(0, 0, 0, 0.2);">
                                Welcome To Our Company
                                <div style="position:absolute; bottom:-15px; left:50%; transform:translateX(-50%); width:80px; height:4px; background:#FFD700; border-radius:2px;"></div>
                            </h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:40px; text-align:center;">
                            <!-- Welcome Message -->
                            <p style="font-size:1.5rem; color:#111F4D; margin-bottom:30px; line-height:1.4; position:relative; padding-bottom:20px;">
                                We're thrilled to have you on board
                                <span style="position:absolute; bottom:0; left:50%; transform:translateX(-50%); width:60px; height:3px; background:#E43A19; border-radius:2px;"></span>
                            </p>

                            <!-- Custom Message -->
                            <div style="background-color:#E6F0FF; border-left:4px solid #E43A19; padding:20px; margin:30px 0; border-radius:0 8px 8px 0; text-align:left; font-size:1.1rem; line-height:1.6; color:#0A142F;">
                                {{$msg}}
                            </div>

                            <!-- CTA Button -->
                            <a href="#" style="display:inline-block; background:linear-gradient(to right, #111F4D, #0A142F); color:#FFFFFF !important; text-decoration:none; padding:15px 30px; border-radius:50px; font-weight:600; margin:20px 0; transition:all 0.3s ease; box-shadow:0 4px 15px rgba(17, 31, 77, 0.2);">Get Started</a>

                            <!-- Social Icons -->
                            <div style="margin:20px 0;">
                                <a href="#" style="display:inline-block; width:40px; height:40px; background-color:#FFFFFF; border-radius:50%; margin:0 8px; text-align:center; line-height:40px; color:#111F4D; transition:all 0.3s ease; text-decoration:none;">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" style="display:inline-block; width:40px; height:40px; background-color:#FFFFFF; border-radius:50%; margin:0 8px; text-align:center; line-height:40px; color:#111F4D; transition:all 0.3s ease; text-decoration:none;">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" style="display:inline-block; width:40px; height:40px; background-color:#FFFFFF; border-radius:50%; margin:0 8px; text-align:center; line-height:40px; color:#111F4D; transition:all 0.3s ease; text-decoration:none;">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" style="display:inline-block; width:40px; height:40px; background-color:#FFFFFF; border-radius:50%; margin:0 8px; text-align:center; line-height:40px; color:#111F4D; transition:all 0.3s ease; text-decoration:none;">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#111F4D; color:#E5E4E2; padding:20px; text-align:center; font-size:0.9rem;">
                            &copy; 2023 Our Company. All rights reserved.<br />
                            <small>123 Business Ave, Suite 100, City, Country</small>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>