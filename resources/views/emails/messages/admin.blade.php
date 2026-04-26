<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<style>
    body { margin: 0; padding: 0; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8f9fa; color: #333333; }
    .wrapper { width: 100%; table-layout: fixed; background-color: #f8f9fa; padding-bottom: 60px; }
    .main { background-color: #ffffff; margin: 0 auto; width: 100%; max-width: 600px; border-spacing: 0; font-family: sans-serif; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-top: 40px; }
    .header { background: linear-gradient(135deg, #343a40 0%, #212529 100%); padding: 35px 20px; text-align: center; color: white; }
    .header h1 { margin: 0; font-family: 'Georgia', serif; font-size: 24px; font-weight: normal; letter-spacing: 1px; color: #f8f9fa; }
    .content { padding: 40px 30px; line-height: 1.6; font-size: 16px; color: #4a4a4a; }
    .content p { margin: 0 0 20px 0; }
    .content h2 { font-family: 'Georgia', serif; color: #333; font-size: 22px; margin-top: 0; }
    .details-table { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
    .details-table td { padding: 12px; border-bottom: 1px solid #eee; }
    .details-table td:first-child { font-weight: bold; color: #555; width: 120px; }
    .box { background-color: #f4f6f8; padding: 20px; border-left: 4px solid #343a40; border-radius: 4px; margin-bottom: 25px; color: #333; }
    .footer { background-color: #f1f1f1; padding: 25px 30px; text-align: center; font-size: 13px; color: #888; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; }
    .btn { display: inline-block; background-color: #343a40; color: #ffffff !important; text-decoration: none; padding: 12px 25px; border-radius: 6px; font-weight: bold; margin-top: 10px; }
</style>
</head>
<body>
    <center class="wrapper">
        <table class="main" width="100%">
            <tr>
                <td class="header">
                    <h1>🛡️ New Admin Notification</h1>
                </td>
            </tr>
            <tr>
                <td class="content">
                    <h2>Contact Form Submission</h2>
                    <p>You have received a new message from the contact form.</p>
                    
                    <table class="details-table">
                        <tr>
                            <td>Name:</td>
                            <td>{{ $data['name'] }}</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>{{ $data['email'] }}</td>
                        </tr>
                        <tr>
                            <td>Subject:</td>
                            <td><strong>{{ $data['subject'] }}</strong></td>
                        </tr>
                    </table>
                    
                    <p><strong>Message:</strong></p>
                    <div class="box" style="white-space: pre-line;">
                        {{ $data['message'] }}
                    </div>
                    
                    <div style="text-align: center;">
                        <a href="{{ route('admin.messages') }}" class="btn">View in Admin Panel</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="footer">
                    Automated notification from Recipe World.
                </td>
            </tr>
        </table>
    </center>
</body>
</html>
