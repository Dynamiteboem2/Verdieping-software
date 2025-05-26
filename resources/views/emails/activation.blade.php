<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Activeer je account - Windsurf</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f4f8fb; color: #222;">
    <div style="max-width: 480px; margin: 40px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 32px;">
        <h2 style="color: #0077b6;">Welkom bij Windsurf!</h2>
        <p>Bedankt voor je registratie op onze windsurf-website.</p>
        <p>
            Om je account te activeren en toegang te krijgen tot alle functies, klik op de onderstaande knop:
        </p>
        <p style="text-align: center; margin: 32px 0;">
            <a href="{{ route('activate', ['token' => $user->activation_token]) }}"
               style="background: #0077b6; color: #fff; text-decoration: none; padding: 12px 28px; border-radius: 4px; font-weight: bold;">
                Activeer mijn account
            </a>
        </p>
        <p>
            Of kopieer en plak deze link in je browser:<br>
            <span style="word-break: break-all;">
                <a href="{{ route('activate', ['token' => $user->activation_token]) }}">
                    {{ route('activate', ['token' => $user->activation_token]) }}
                </a>
            </span>
        </p>
        <hr style="margin: 32px 0;">
        <p style="font-size: 13px; color: #888;">
            Heb je je niet geregistreerd? Dan kun je deze e-mail negeren.
        </p>
        <p style="font-size: 13px; color: #888;">
            Sportieve groet,<br>
            Het Windsurf Team
        </p>
    </div>
</body>
</html>