{{-- filepath: resources/views/instructor/profile.blade.php --}}
<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Persoonsgegevens</h1>
    <form method="POST" action="{{ route('instructor.updateProfile') }}">
        @csrf
        <input name="name" value="{{ old('name', $user->name) }}" placeholder="Naam" required class="border rounded mb-2 w-full"/>
        <input name="address" value="{{ old('address', $user->address) }}" placeholder="Adres" class="border rounded mb-2 w-full"/>
        <input name="city" value="{{ old('city', $user->city) }}" placeholder="Woonplaats" class="border rounded mb-2 w-full"/>
        <input name="birthdate" type="date" value="{{ old('birthdate', $user->birthdate) }}" class="border rounded mb-2 w-full"/>
        <input name="bsn_number" value="{{ old('bsn_number', $user->bsn_number) }}" placeholder="BSN-nummer" class="border rounded mb-2 w-full"/>
        <input name="mobile" value="{{ old('mobile', $user->mobile) }}" placeholder="Mobiel" class="border rounded mb-2 w-full"/>
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Opslaan</button>
    </form>
</x-app-layout>