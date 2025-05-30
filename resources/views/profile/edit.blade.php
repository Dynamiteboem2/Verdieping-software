<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#0077b6] leading-tight text-center">
            Profiel bewerken
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto space-y-10">
            {{-- Success message --}}
            @if(session('success'))
                <div 
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 5000)"
                    class="mb-4 p-3 bg-green-100 text-green-800 rounded"
                >
                    {{ session('success') }}
                </div>
            @endif
            {{-- Error messages --}}
            @if($errors->any())
                <div 
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 5000)"
                    class="mb-4 p-3 bg-red-100 text-red-800 rounded"
                >
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>
                                @if(str_contains($error, 'email'))
                                    Ongeldig e-mailadres: {{ $error }}
                                @elseif(str_contains($error, 'name'))
                                    Ongeldige naam: {{ $error }}
                                @elseif(str_contains($error, 'mobile'))
                                    Ongeldig mobiel nummer: {{ $error }}
                                @elseif(str_contains($error, 'birthdate'))
                                    Ongeldige geboortedatum: {{ $error }}
                                @elseif(str_contains($error, 'address'))
                                    Ongeldig adres: {{ $error }}
                                @elseif(str_contains($error, 'city'))
                                    Ongeldige woonplaats: {{ $error }}
                                @elseif(str_contains($error, 'bsn_number'))
                                    Ongeldig BSN-nummer: {{ $error }}
                                @elseif(str_contains($error, 'landline'))
                                    Ongeldig vast telefoonnummer: {{ $error }}
                                @else
                                    {{ $error }}
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Persoonlijke gegevens & adres -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8 flex flex-col md:flex-row gap-10">
                <div class="flex-1">
                    <h3 class="text-xl font-bold mb-4 text-[#0077b6]">Persoonlijke gegevens</h3>
                    @include('profile.partials.update-profile-information-form', ['showMobile' => true, 'showBirthdate' => true])
                </div>
                <div class="flex-1 border-t md:border-t-0 md:border-l border-gray-200 dark:border-gray-700 pt-8 md:pt-0 md:pl-8">
                    <h3 class="text-xl font-bold mb-4 text-[#0077b6]">Adresgegevens</h3>
                    @include('profile.partials.address-fields', ['user' => $user, 'showMobile' => false, 'showBirthdate' => false, 'showLandline' => true])
                </div>
            </div>

            <!-- Wachtwoord wijzigen -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="h-6 w-6 text-[#0077b6]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3-1.343 3-3V7a3 3 0 10-6 0v1c0 1.657 1.343 3 3 3zm6 2v7a2 2 0 01-2 2H8a2 2 0 01-2-2v-7"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-[#0077b6]">Wachtwoord wijzigen</h3>
                </div>
                @include('profile.partials.update-password-form')
            </div>

            <!-- Account verwijderen -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="h-6 w-6 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M10 11V5a2 2 0 114 0v6"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-red-500">Account verwijderen</h3>
                </div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
