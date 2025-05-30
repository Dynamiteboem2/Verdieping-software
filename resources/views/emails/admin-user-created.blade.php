<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Je account is aangemaakt</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f4f8fb; color: #222;">
    <div style="max-width: 480px; margin: 40px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 32px;">
        <h2 style="color: #0077b6;">Welkom bij KiteSurfschool Windkracht-12!</h2>
        <p>Beste gebruiker,</p>
        <p>
            Je account is succesvol aangemaakt door de beheerder.<br>
            Hieronder vind je je inloggegevens:
        </p>
        <p style="margin: 20px 0;">
            <strong style="color:#0077b6;">E-mail:</strong> {{ $email }}<br>
            <strong style="color:#0077b6;">Standaard wachtwoord:</strong>
            <span style="background:#e0f2fe;padding:2px 8px;border-radius:4px;">{{ $password }}</span>
        </p>
        <p>
            Log in met deze gegevens en wijzig je wachtwoord zo snel mogelijk via je profielpagina.<br>
        </p>
        <p style="text-align: center; margin: 32px 0;">
            <a href="{{ url('/login') }}"
               style="background: #0077b6; color: #fff; text-decoration: none; padding: 12px 28px; border-radius: 4px; font-weight: bold;">
                Naar de loginpagina
            </a>
        </p>
        <hr style="margin: 32px 0;">
        <p style="font-size: 13px; color: #888;">
            Met vriendelijke groet,<br>
            Het KiteSurfschool Windkracht-12 Team
        </p>
    </div>
</body>
</html>
