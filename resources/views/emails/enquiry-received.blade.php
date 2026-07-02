<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Enquiry Received</title>
</head>
<body style="font-family: Arial, sans-serif; background: #F8FAFC; padding: 24px; color: #222222;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 8px; overflow: hidden; border: 1px solid #e5e7eb;">
        <div style="background: #D72638; padding: 16px 24px;">
            <h2 style="color: #fff; margin: 0;">New Enquiry Received</h2>
        </div>
        <div style="padding: 24px;">
            <p>A new enquiry has been submitted on the MNU Travels website.</p>
            <table style="width: 100%; border-collapse: collapse;">
                <tr><td style="padding: 6px 0; font-weight: bold;">Name:</td><td>{{ $enquiry->name }}</td></tr>
                <tr><td style="padding: 6px 0; font-weight: bold;">Phone:</td><td>{{ $enquiry->phone }}</td></tr>
                @if ($enquiry->email)
                    <tr><td style="padding: 6px 0; font-weight: bold;">Email:</td><td>{{ $enquiry->email }}</td></tr>
                @endif
                @if ($enquiry->message)
                    <tr><td style="padding: 6px 0; font-weight: bold;">Message:</td><td>{{ $enquiry->message }}</td></tr>
                @endif
            </table>
        </div>
        <div style="background: #F8FAFC; padding: 12px 24px; font-size: 12px; color: #6b7280;">
            MNU Travels Admin Notification
        </div>
    </div>
</body>
</html>
