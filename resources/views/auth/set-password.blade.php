{{-- filepath: resources/views/auth/set-password.blade.php --}}
<x-guest-layout>
    <form method="POST" action="{{ route('activate.setpassword', $token) }}">
        @csrf
        <div>
            <x-input-label for="password" :value="__('Kies een wachtwoord')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autofocus />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Herhaal wachtwoord')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                Wachtwoord instellen
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>