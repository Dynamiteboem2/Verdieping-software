{{-- filepath: resources/views/emails/lesson_cancelled.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Les geannuleerd - KiteSurfschool Windkracht-12</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f4f8fb; color: #222;">
    <div style="max-width: 480px; margin: 40px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 32px;">
        <h2 style="color: #0077b6;">Les geannuleerd</h2>
        <p>Beste {{ $booking->user->name ?? 'klant' }},</p>

        <p>
            Helaas is je les <strong>"{{ $booking->lesson->type }}"</strong> op 
            <strong>{{ \Carbon\Carbon::parse($booking->date)->format('d-m-Y') }}</strong> 
            om <strong>{{ $booking->time }}</strong> geannuleerd.
        </p>

        @if($reason === 'ziekte')
            <p style="color: #e67e22;"><strong>Reden:</strong> De instructeur is ziek.</p>
        @elseif($reason === 'wind')
            <p style="color: #0077b6;"><strong>Reden:</strong> Slechte weersomstandigheden (windkracht &gt; 10).</p>
        @endif

        <p><strong>Instructeur:</strong> {{ $booking->instructor->name ?? '-' }}</p>

        <div style="margin: 32px 0; text-align: center;">
            <a href="mailto:{{ $booking->instructor->email ?? '' }}" 
               style="background: #0077b6; color: #fff; text-decoration: none; padding: 12px 28px; border-radius: 4px; font-weight: bold;">
                Neem contact op voor het plannen van een nieuwe les
            </a>
        </div>

        <hr style="margin: 32px 0;">
        <p style="font-size: 13px; color: #888;">
            Heb je vragen? Neem gerust contact met ons op.<br>
            Sportieve groet,<br>
            Het KiteSurfschool Windkracht-12 Team
        </p>
    </div>
</body>
</html>