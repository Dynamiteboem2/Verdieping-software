{{-- filepath: resources/views/emails/lesson_cancelled.blade.php --}}
<p>Beste {{ $booking->user->name ?? 'klant' }},</p>

<p>Helaas is je les "{{ $booking->lesson->type }}" op {{ \Carbon\Carbon::parse($booking->date)->format('d-m-Y') }} om {{ $booking->time }} geannuleerd.</p>

@if($reason === 'ziekte')
    <p>Reden: De instructeur is ziek.</p>
@elseif($reason === 'wind')
    <p>Reden: Slechte weersomstandigheden (windkracht > 10).</p>
@endif

<p>Instructeur: {{ $booking->instructor->name ?? '-' }}</p>

<p>Neem contact op voor het plannen van een nieuwe les.</p>