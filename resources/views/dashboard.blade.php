<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Profile completion modal --}}
            @php
                $needsProfile = isset($user) && (
                    !$user->name ||
                    !$user->address ||
                    !$user->city ||
                    !$user->birthdate ||
                    !$user->mobile ||
                    ($user->role_id == 2 && !$user->bsn_number)
                );
            @endphp
            @if($needsProfile)
                <div id="profileModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-full max-w-md relative">
                        <h2 class="text-lg font-bold mb-4 text-[#0077b6]">Vul je gegevens in</h2>
                        <form method="POST" action="{{ route('user.completeProfile') }}">
                            @csrf
                            <input type="hidden" name="email" value="{{ $user->email }}">
                            <div class="mb-2">
                                <label class="block mb-1 font-semibold">Naam</label>
                                <input name="name" value="{{ old('name', $user->name) }}" required class="border rounded w-full"/>
                            </div>
                            <div class="mb-2">
                                <label class="block mb-1 font-semibold">Adres</label>
                                <input name="address" value="{{ old('address', $user->address) }}" required class="border rounded w-full"/>
                            </div>
                            <div class="mb-2">
                                <label class="block mb-1 font-semibold">Woonplaats</label>
                                <input name="city" value="{{ old('city', $user->city) }}" required class="border rounded w-full"/>
                            </div>
                            <div class="mb-2">
                                <label class="block mb-1 font-semibold">Geboortedatum</label>
                                <input id="birthdate" name="birthdate" type="text"
                                    value="{{ old('birthdate', $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('d-m-Y') : '') }}"
                                    required class="border rounded w-full" placeholder="dd-mm-jjjj"/>
                            </div>
                            <div class="mb-2">
                                <label class="block mb-1 font-semibold">Mobiel</label>
                                <input name="mobile" value="{{ old('mobile', $user->mobile) }}" required class="border rounded w-full"/>
                            </div>
                            @if($user->role_id == 2)
                                <div class="mb-2">
                                    <label class="block mb-1 font-semibold">BSN-nummer</label>
                                    <input name="bsn_number" value="{{ old('bsn_number', $user->bsn_number) }}" required placeholder="BSN-nummer" class="border rounded w-full"/>
                                </div>
                            @endif
                            <button class="bg-blue-500 text-white px-4 py-2 rounded w-full">Opslaan</button>
                        </form>
                    </div>
                </div>
                <script>
                    // Prevent interaction with the rest of the page while modal is open
                    document.body.classList.add('overflow-hidden');
                </script>
            @endif

            @if($isInstructor)
                {{-- Instructor dashboard --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 mb-4">
                    <h3 class="text-lg font-bold mb-4 text-[#0077b6]">Lessen die je moet geven</h3>
                    @if(isset($instructorLessons) && $instructorLessons->count())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($instructorLessons as $lesson)
                                <li class="py-3">
                                    <div><span class="font-semibold">Type:</span> {{ $lesson->type }}</div>
                                    <div>
                                        <span class="font-semibold">Datum & tijd:</span>
                                        {{ \Carbon\Carbon::parse($lesson->date . ' ' . $lesson->time)->format('d-m-Y H:i') }}
                                    </div>
                                    <div><span class="font-semibold">Locatie:</span> {{ $lesson->location->name ?? '-' }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-gray-500">Je hebt geen lessen om te geven.</div>
                    @endif
                </div>
            @else
                {{-- User dashboard --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-2 flex flex-col space-y-6">
                        <!-- First Upcoming Lesson -->
                        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 mb-4">
                            <h3 class="text-lg font-bold mb-4 text-[#0077b6]">Eerstvolgende les</h3>
                            @if($firstUpcomingLesson)
                                <div class="space-y-2">
                                    <div><span class="font-semibold">Type:</span> {{ $firstUpcomingLesson->lesson->type ?? 'Les' }}</div>
                                    <div>
                                        <span class="font-semibold">Datum & tijd:</span>
                                        {{ \Carbon\Carbon::parse($firstUpcomingLesson->date . ' ' . $firstUpcomingLesson->time)->format('d-m-Y H:i') }}
                                    </div>
                                    <div><span class="font-semibold">Locatie:</span> {{ $firstUpcomingLesson->lesson->location->name ?? '-' }}</div>
                                </div>
                            @else
                                <div class="text-gray-500">Je hebt geen aankomende lessen.</div>
                            @endif
                        </div>
                        <!-- Upcoming Lessons -->
                        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 flex-1">
                            <h3 class="text-lg font-bold mb-4 text-[#0077b6]">Aankomende lessen</h3>
                            @if($upcomingLessons->count())
                                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($upcomingLessons as $booking)
                                        <li class="py-3">
                                            <div><span class="font-semibold">Type:</span> {{ $booking->lesson->type ?? 'Les' }}</div>
                                            <div>
                                                <span class="font-semibold">Datum & tijd:</span>
                                                {{ \Carbon\Carbon::parse($booking->date . ' ' . $booking->time)->format('d-m-Y H:i') }}
                                            </div>
                                            <div><span class="font-semibold">Locatie:</span> {{ $booking->lesson->location->name ?? '-' }}</div>
                                            <div><span class="font-semibold">Status:</span> {{ $booking->status }}</div>
                                            <div><span class="font-semibold">Betaald:</span> {{ $booking->is_paid ? 'Ja' : 'Nee' }}</div>
                                            @if(!$booking->is_paid)
                                                <form method="POST" action="{{ route('booking.markPaid', $booking->id) }}">
                                                    @csrf
                                                    <button class="bg-green-500 text-white px-2 py-1 rounded text-xs">Markeer als betaald</button>
                                                </form>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-gray-500">Geen aankomende lessen.</div>
                            @endif
                        </div>
                    </div>
                    <!-- Right Column -->
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-4 text-[#0077b6]">Vorige lessen</h3>
                        @if($previousLessons->count())
                            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($previousLessons as $lesson)
                                    <li class="py-3">
                                        <div><span class="font-semibold">Type:</span> {{ $lesson->lesson->type ?? 'Les' }}</div>
                                        <div>
                                            <span class="font-semibold">Datum & tijd:</span>
                                            {{ \Carbon\Carbon::parse($lesson->date . ' ' . $lesson->time)->format('d-m-Y H:i') }}
                                        </div>
                                        <div><span class="font-semibold">Locatie:</span> {{ $lesson->lesson->location->name ?? '-' }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-gray-500">Nog geen gevolgde lessen.</div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if($needsProfile)
        <script>
            // Optionally, you can add a simple date mask here for better UX
            document.querySelector('form[action="{{ route('user.completeProfile') }}"]').addEventListener('submit', function(e) {
                var input = document.getElementById('birthdate');
                if (input && input.value) {
                    // Validate and normalize to d-m-Y (optional, since backend validates)
                    var parts = input.value.split('-');
                    if (parts.length === 3) {
                        // Pad day and month if needed
                        parts[0] = parts[0].padStart(2, '0');
                        parts[1] = parts[1].padStart(2, '0');
                        input.value = parts[0] + '-' + parts[1] + '-' + parts[2];
                    }
                }
            });
        </script>
    @endif
</x-app-layout>
