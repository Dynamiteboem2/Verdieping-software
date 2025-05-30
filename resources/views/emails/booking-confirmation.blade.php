<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bevestiging & Betaling Kitesurfles</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f4f8fb; color: #222;">
    <div style="max-width: 480px; margin: 40px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 32px;">
        <h2 style="color: #0077b6;">Bedankt voor je reservering bij KiteSurfschool Windkracht-12!</h2>
        <p>Beste {{ $booking->name }},</p>
        <p>
            Je hebt succesvol een les geboekt: <strong>{{ $booking->lesson->type }}</strong><br>
            Datum: <strong>{{ \Carbon\Carbon::parse($booking->date)->format('d-m-Y') }}</strong><br>
            Tijd: <strong>{{ $booking->time }}</strong>
        </p>
        <p>
            Om je reservering definitief te maken, vragen we je het lesgeld te voldoen.<br>
            Klik op de onderstaande knop om direct via iDEAL te betalen:
        </p>
        <p style="text-align: center; margin: 32px 0;">
            <a href="{{ $paymentUrl }}"
               style="background: #0077b6; color: #fff; text-decoration: none; padding: 12px 28px; border-radius: 4px; font-weight: bold;">
                Betaal nu via iDEAL
            </a>
        </p>
        <p>
            Of kopieer en plak deze link in je browser:<br>
            <span style="word-break: break-all;">
                <a href="{{ $paymentUrl }}">{{ $paymentUrl }}</a>
            </span>
        </p>
        <hr style="margin: 32px 0;">
        <p style="font-size: 13px; color: #888;">
            Heb je deze reservering niet gemaakt? Dan kun je deze e-mail negeren.
        </p>
        <p style="font-size: 13px; color: #888;">
            Sportieve groet,<br>
            Het KiteSurfschool Windkracht-12 Team
        </p>
    </div>
</body>
</html>
