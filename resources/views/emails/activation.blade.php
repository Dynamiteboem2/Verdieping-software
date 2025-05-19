{{-- filepath: resources/views/emails/activation.blade.php --}}
<p>Welkom bij onze site!</p>
<p>Klik op de onderstaande link om je account te activeren:</p>
<p>
    <a href="{{ route('activate', $user->activation_token) }}">
        Activeer mijn account
    </a>
</p>