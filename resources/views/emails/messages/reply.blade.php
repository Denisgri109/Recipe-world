<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<style>
    body { margin: 0; padding: 0; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8f9fa; color: #333333; }
    .wrapper { width: 100%; table-layout: fixed; background-color: #f8f9fa; padding-bottom: 60px; }
    .main { background-color: #ffffff; margin: 0 auto; width: 100%; max-width: 600px; border-spacing: 0; font-family: sans-serif; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-top: 40px; }
    .header { background: linear-gradient(135deg, #E8573D 0%, #D14429 100%); padding: 35px 20px; text-align: center; color: white; }
    .header h1 { margin: 0; font-family: 'Georgia', serif; font-size: 28px; font-weight: normal; letter-spacing: 1px; }
    .content { padding: 40px 30px; line-height: 1.6; font-size: 16px; color: #4a4a4a; }
    .content p { margin: 0 0 20px 0; }
    .content h2 { font-family: 'Georgia', serif; color: #333; font-size: 22px; margin-top: 0; }
    .box { background-color: #fdf2f0; padding: 20px; border-left: 4px solid #E8573D; border-radius: 4px; margin-bottom: 25px; font-style: italic; color: #555; }
    .btn { display: inline-block; background-color: #E8573D; color: #ffffff !important; text-decoration: none; padding: 12px 25px; border-radius: 6px; font-weight: bold; margin-top: 10px; }
    .footer { background-color: #f1f1f1; padding: 25px 30px; text-align: center; font-size: 13px; color: #888; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; }
</style>
</head>
<body>
    <center class="wrapper">
        <table class="main" width="100%">
            <tr>
                <td class="header">
                    <h1>🍽️ Recipe World</h1>
                </td>
            </tr>
            <tr>
                <td class="content">
                    <h2>Hello {{ $msgRecord->name }},</h2>
                    <p>Thank you for getting in touch with us regarding: <strong>"{{ $msgRecord->subject }}"</strong>.</p>
                    
                    <p>Our team has reviewed your inquiry:</p>
                    <div class="box">
                        "{{ $msgRecord->message }}"
                    </div>
                    
                    <h3 style="color: #333; margin-top: 30px;">Our Response:</h3>
                    <p style="white-space: pre-line;">{{ $replyText }}</p>
                    
                    <p style="margin-top: 40px;">If you have any further questions, simply reply directly to this email.</p>
                    <p>Warm regards,<br><strong>The Recipe World Team</strong></p>
                </td>
            </tr>
            <tr>
                <td class="footer">
                    &copy; {{ date('Y') }} Recipe World. All rights reserved.<br>
                    Cook with passion, share with love.
                </td>
            </tr>
        </table>
    </center>
</body>
</html>
