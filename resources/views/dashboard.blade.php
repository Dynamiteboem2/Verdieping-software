<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Tegels voor Admin en Instructeur --}}
            @if($user->role_id == 1 || $user->role_id == 2)
                <div class="max-w-6xl mx-auto px-4 mb-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                        @if($user->role_id == 1)
                            <!-- Admin: Gebruikers beheren -->
                            <a href="{{ route('admin.users') }}" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-lg flex flex-col items-center justify-center p-8 transition">
                                <span class="mb-4 rounded-full bg-white shadow flex items-center justify-center h-12 w-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                </span>
                                <span class="text-xl font-semibold">Gebruikers beheren</span>
                            </a>
                            <!-- Admin: Alle lessen -->
                            <a href="{{ route('admin.bookings') }}" class="bg-purple-500 hover:bg-purple-600 text-white rounded-lg shadow-lg flex flex-col items-center justify-center p-8 transition">
                                <span class="mb-4 rounded-full bg-white shadow flex items-center justify-center h-12 w-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-purple-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                    </svg>
                                </span>
                                <span class="text-xl font-semibold">Alle lessen (overzicht)</span>
                            </a>
                            <!-- Admin: Facturen & betalingen -->
                            <a href="{{ route('admin.payments') }}" class="bg-green-500 hover:bg-green-600 text-white rounded-lg shadow-lg flex flex-col items-center justify-center p-8 transition">
                                <span class="mb-4 rounded-full bg-white shadow flex items-center justify-center h-12 w-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-green-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                    </svg>
                                </span>
                                <span class="text-xl font-semibold">Facturen &amp; betalingen</span>
                            </a>
                        @endif

                        @if($user->role_id == 2)
                            <!-- Instructeur: Klanten/Lessen beheren -->
                            <a href="{{ route('instructor.customers') }}" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-lg flex flex-col items-center justify-center p-8 transition">
                                <span class="mb-4 rounded-full bg-white shadow flex items-center justify-center h-12 w-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                                    </svg>
                                </span>
                                <span class="text-xl font-semibold">Klanten/Lessen beheren</span>
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Profiel aanvullen modal --}}
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
                        {{-- Foutmeldingen voor profiel modal --}}
                        @if($errors->any())
                            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>
                                            @if(str_contains($error, 'name'))
                                                Naam is verplicht en mag niet leeg zijn.
                                            @elseif(str_contains($error, 'address'))
                                                Adres is verplicht en mag niet leeg zijn.
                                            @elseif(str_contains($error, 'city'))
                                                Woonplaats is verplicht en mag niet leeg zijn.
                                            @elseif(str_contains($error, 'birthdate'))
                                                Vul een geldige geboortedatum in (dd-mm-jjjj).
                                            @elseif(str_contains($error, 'mobile'))
                                                Mobiel nummer is verplicht en mag alleen cijfers bevatten.
                                            @elseif(str_contains($error, 'bsn_number'))
                                                BSN-nummer is verplicht voor instructeurs/admins.
                                            @else
                                                {{ $error }}
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('user.completeProfile') }}">
                            @csrf
                            <input type="hidden" name="email" value="{{ $user->email }}">
                            <div class="mb-2">
                                <label class="block mb-1 font-semibold">Naam</label>
                                <input name="name" value="{{ old('name', $user->name) }}" required class="border rounded w-full"/>
                                @error('name')
                                    <span class="text-red-500 text-xs">Naam is verplicht en mag niet leeg zijn.</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label class="block mb-1 font-semibold">Adres</label>
                                <input name="address" value="{{ old('address', $user->address) }}" required class="border rounded w-full"/>
                                @error('address')
                                    <span class="text-red-500 text-xs">Adres is verplicht en mag niet leeg zijn.</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label class="block mb-1 font-semibold">Woonplaats</label>
                                <input name="city" value="{{ old('city', $user->city) }}" required class="border rounded w-full"/>
                                @error('city')
                                    <span class="text-red-500 text-xs">Woonplaats is verplicht en mag niet leeg zijn.</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label class="block mb-1 font-semibold">Geboortedatum</label>
                                <input id="birthdate" name="birthdate" type="text"
                                    value="{{ old('birthdate', $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('d-m-Y') : '') }}"
                                    required class="border rounded w-full" placeholder="dd-mm-jjjj"/>
                                @error('birthdate')
                                    <span class="text-red-500 text-xs">Vul een geldige geboortedatum in (dd-mm-jjjj).</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label class="block mb-1 font-semibold">Mobiel</label>
                                <input 
                                    name="mobile" 
                                    value="{{ old('mobile', $user->mobile) }}" 
                                    required 
                                    class="border rounded w-full"
                                    pattern="[0-9]+"
                                    inputmode="numeric"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                />
                                @error('mobile')
                                    <span class="text-red-500 text-xs">Mobiel nummer is verplicht en mag alleen cijfers bevatten.</span>
                                @enderror
                            </div>
                            @if($user->role_id == 1 || $user->role_id == 2)
                                <div class="mb-2">
                                    <label class="block mb-1 font-semibold">BSN-nummer</label>
                                    <input name="bsn_number" value="{{ old('bsn_number', $user->bsn_number) }}" required placeholder="BSN-nummer" class="border rounded w-full"/>
                                    @error('bsn_number')
                                        <span class="text-red-500 text-xs">BSN-nummer is verplicht voor instructeurs/admins.</span>
                                    @enderror
                                </div>
                            @endif
                            <button class="bg-blue-500 text-white px-4 py-2 rounded w-full">Opslaan</button>
                        </form>
                    </div>
                </div>
                <script>
                    // Voorkom interactie met de rest van de pagina zolang de modal open is
                    document.body.classList.add('overflow-hidden');
                </script>
            @endif

            @if($isInstructor)
                {{-- Instructeur dashboard --}}
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
            @elseif($user->role_id != 1 && $user->role_id != 2)
                {{-- Gebruiker dashboard --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-2 flex flex-col space-y-6">
                        <!-- Knop naar alle boekingen -->
                        <div class="mb-2">
                            <a href="{{ route('klant.allBookings') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                Toon alle boekingen
                            </a>
                        </div>
                        <!-- Eerstvolgende les -->
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
                        <!-- Aankomende lessen -->
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
                                            <div class="flex gap-2 mt-2">
                                                @if($booking->status !== 'geannuleerd')
                                                    <!-- Annuleer knop -->
                                                    <button onclick="showCancelModal({{ $booking->id }})" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs">Annuleer</button>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mt-4">
                                    {{ $upcomingLessons->links() }}
                                </div>
                            @else
                                <div class="text-gray-500">Geen aankomende lessen.</div>
                            @endif
                        </div>
                        <!-- Annuleer modal -->
                        <div id="cancelModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
                            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                                <h3 class="text-lg font-bold mb-4 text-[#0077b6]">Les annuleren</h3>
                                <form id="cancelForm" method="POST">
                                    @csrf
                                    <label class="block mb-2 font-semibold">Reden van annulering</label>
                                    <textarea name="cancellation_reason" class="border rounded w-full mb-4" required placeholder="Geef een reden op"></textarea>
                                    <div class="flex justify-end gap-2">
                                        <button type="button" onclick="hideCancelModal()" class="bg-gray-300 px-4 py-2 rounded">Annuleren</button>
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Verstuur</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <script>
                            let cancelModal = document.getElementById('cancelModal');
                            let cancelForm = document.getElementById('cancelForm');
                            function showCancelModal(bookingId) {
                                cancelForm.action = '/booking/' + bookingId + '/cancel';
                                cancelModal.classList.remove('hidden');
                                document.body.classList.add('overflow-hidden');
                            }
                            function hideCancelModal() {
                                cancelModal.classList.add('hidden');
                                document.body.classList.remove('overflow-hidden');
                            }
                        </script>
                    </div>
                    <!-- Rechterkolom -->
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
            // Optioneel: eenvoudige datum mask voor betere UX
            document.querySelector('form[action="{{ route('user.completeProfile') }}"]').addEventListener('submit', function(e) {
                var input = document.getElementById('birthdate');
                if (input && input.value) {
                    // Valideer en normaliseer naar d-m-Y (optioneel, backend valideert ook)
                    var parts = input.value.split('-');
                    if (parts.length === 3) {
                        parts[0] = parts[0].padStart(2, '0');
                        parts[1] = parts[1].padStart(2, '0');
                        input.value = parts[0] + '-' + parts[1] + '-' + parts[2];
                    }
                }
            });
        </script>
    @endif
</x-app-layout>
