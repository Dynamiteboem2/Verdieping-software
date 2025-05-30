<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Boeking aangepast</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f4f8fb; color: #222;">
    <div style="max-width: 480px; margin: 40px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 32px;">
        <h2 style="color: #0077b6;">Je boeking is aangepast</h2>
        <p>Beste {{ $booking->user->name }},</p>
        <p>
            Je boeking is aangepast door de instructeur.<br>
            <strong>Nieuwe gegevens:</strong>
        </p>
        <ul>
            <li>Les: {{ $booking->lesson->type ?? '-' }}</li>
            <li>Datum: {{ \Carbon\Carbon::parse($booking->date)->format('d-m-Y') }}</li>
            <li>Tijd: {{ $booking->time }}</li>
            <li>Locatie: {{ $booking->lesson->location->name ?? '-' }}</li>
        </ul>
        <p>Bekijk je dashboard voor meer details.</p>
        <hr style="margin: 32px 0;">
        <p style="font-size: 13px; color: #888;">
            Sportieve groet,<br>
            Het KiteSurfschool Windkracht-12 Team
        </p>
    </div>
</body>
</html>
