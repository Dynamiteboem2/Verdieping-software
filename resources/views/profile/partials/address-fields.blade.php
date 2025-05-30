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
    <div>
        <x-input-label for="birthdate" :value="'Geboortedatum'" />
        <x-text-input id="birthdate" name="birthdate" type="text" class="mt-1 block w-full" :value="old('birthdate', $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('d-m-Y') : '')" required autocomplete="bdate" placeholder="dd-mm-jjjj" />
        <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
    </div>
    <div>
        <x-input-label for="mobile" :value="'Mobiel'" />
        <x-text-input id="mobile" name="mobile" type="text" class="mt-1 block w-full" :value="old('mobile', $user->mobile)" required autocomplete="mobile" />
        <x-input-error class="mt-2" :messages="$errors->get('mobile')" />
    </div>
    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>
        @if (session('status') === 'address-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
            >{{ __('Saved.') }}</p>
        @endif
    </div>
</form>
