<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Booking Received</title>
</head>
<body style="font-family: Arial, sans-serif; background: #F8FAFC; padding: 24px; color: #222222;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 8px; overflow: hidden; border: 1px solid #e5e7eb;">
        <div style="background: #1E4DB7; padding: 16px 24px;">
            <h2 style="color: #fff; margin: 0;">New Booking Received</h2>
        </div>
        <div style="padding: 24px;">
            <p>A new booking has been submitted on the MNU Travels website.</p>
            <table style="width: 100%; border-collapse: collapse;">
                <tr><td style="padding: 6px 0; font-weight: bold;">Booking No:</td><td>{{ $booking->booking_no }}</td></tr>
                <tr><td style="padding: 6px 0; font-weight: bold;">Trip Type:</td><td>{{ $booking->trip_type === 'one_way' ? 'One Way' : 'Round Trip' }}</td></tr>
                <tr><td style="padding: 6px 0; font-weight: bold;">Pickup:</td><td>{{ $booking->pickup_location }}</td></tr>
                <tr><td style="padding: 6px 0; font-weight: bold;">Drop:</td><td>{{ $booking->drop_location }}</td></tr>
                <tr><td style="padding: 6px 0; font-weight: bold;">Journey Date:</td><td>{{ $booking->journey_date->format('d M Y') }} at {{ \Illuminate\Support\Carbon::parse($booking->journey_time)->format('h:i A') }}</td></tr>
                @if ($booking->return_date)
                    <tr><td style="padding: 6px 0; font-weight: bold;">Return Date:</td><td>{{ $booking->return_date->format('d M Y') }}</td></tr>
                @endif
                @if ($booking->vehicle)
                    <tr><td style="padding: 6px 0; font-weight: bold;">Vehicle:</td><td>{{ $booking->vehicle->name }}</td></tr>
                @endif
                <tr><td style="padding: 6px 0; font-weight: bold;">Customer:</td><td>{{ $booking->customer_name }}</td></tr>
                <tr><td style="padding: 6px 0; font-weight: bold;">Phone:</td><td>{{ $booking->phone }}</td></tr>
                @if ($booking->email)
                    <tr><td style="padding: 6px 0; font-weight: bold;">Email:</td><td>{{ $booking->email }}</td></tr>
                @endif
                @if ($booking->message)
                    <tr><td style="padding: 6px 0; font-weight: bold;">Message:</td><td>{{ $booking->message }}</td></tr>
                @endif
            </table>
        </div>
        <div style="background: #F8FAFC; padding: 12px 24px; font-size: 12px; color: #6b7280;">
            MNU Travels Admin Notification
        </div>
    </div>
</body>
</html>
