{{-- filepath: resources/views/emails/activation.blade.php --}}
Klik op de volgende link om je account te activeren:<br>
<a href="{{ route('activate', ['token' => $user->activation_token]) }}">
    Account activeren
</a>