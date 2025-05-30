<form method="post" action="{{ route('profile.update.address') }}" class="space-y-6 mt-6">
    @csrf
    @method('patch')
    <div>
        <x-input-label for="address" :value="'Adres'" />
        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" required autocomplete="address" />
        <x-input-error class="mt-2" :messages="$errors->get('address')" />
    </div>
    <div>
        <x-input-label for="city" :value="'Woonplaats'" />
        <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->city)" required autocomplete="city" />
        <x-input-error class="mt-2" :messages="$errors->get('city')" />
    </div>
    @if(isset($showLandline) && $showLandline)
    <div>
        <x-input-label for="landline" :value="'Vast telefoonnummer (optioneel)'" />
        <x-text-input id="landline" name="landline" type="text" class="mt-1 block w-full" :value="old('landline', $user->landline ?? '')" autocomplete="tel" />
        <x-input-error class="mt-2" :messages="$errors->get('landline')" />
    </div>
    @endif
    <div class="flex items-center gap-4">
        <x-primary-button>Opslaan</x-primary-button>
        @if (session('status') === 'address-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
            >Opgeslagen.</p>
        @endif
    </div>
</form>
