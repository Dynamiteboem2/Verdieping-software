{{-- filepath: resources/views/admin/users.blade.php --}}
<x-app-layout>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-12">
        <div class="max-w-6xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold mb-8 text-gray-800 dark:text-gray-200">Gebruikersbeheer</h2>
                {{-- Succesbericht --}}
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
                {{-- Foutmeldingen --}}
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
                                    @elseif(str_contains($error, 'role_id'))
                                        Ongeldige rol: {{ $error }}
                                    @else
                                        {{ $error }}
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Admin: Nieuwe gebruiker toevoegen --}}
                <div class="mb-8">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-100">Nieuwe gebruiker toevoegen</h3>
                    <form method="POST" action="{{ route('admin.createUser') }}" class="flex flex-col md:flex-row gap-4 items-end">
                        @csrf
                        <div>
                            <label for="new_email" class="block text-xs font-semibold mb-1">E-mailadres</label>
                            <input type="email" name="email" id="new_email" class="border border-gray-300 rounded px-2 py-1 w-56" required>
                        </div>
                        <div>
                            <label for="new_role_id" class="block text-xs font-semibold mb-1">Rol</label>
                            <select name="role_id" id="new_role_id" class="border border-gray-300 rounded px-2 py-1 w-40" required>
                                <option value="2">Instructeur</option>
                                <option value="3">Klant</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                        <div>
                            <label for="new_password" class="block text-xs font-semibold mb-1">Standaard wachtwoord</label>
                            <input type="text" name="password" id="new_password" class="border border-gray-300 rounded px-2 py-1 w-40" required>
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-xs font-semibold">Aanmaken</button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700 rounded shadow">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-100">
                                <th class="py-3 px-4 text-left text-xs font-medium uppercase">E-mailadres</th>
                                <th class="py-3 px-4 text-left text-xs font-medium uppercase">Rol</th>
                                <th class="py-3 px-4 text-left text-xs font-medium uppercase">Actie</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-900">
                                <td class="py-3 px-4 text-gray-800 dark:text-gray-100">
                                    {{ $user->email }}
                                </td>
                                <td class="py-3 px-4 text-gray-800 dark:text-gray-100">
                                    @if($user->role_id == 2) Instructeur
                                    @elseif($user->role_id == 3) Klant
                                    @elseif($user->role_id == 1) Admin
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-gray-800 dark:text-gray-100">
                                    <div x-data="{ edit: false, email: '{{ $user->email }}', role_id: '{{ $user->role_id }}' }">
                                        <button x-show="!edit" @click="edit = true" class="px-2 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded transition text-sm">Bewerken</button>
                                        <form x-show="edit" method="POST" action="{{ route('admin.updateUser', $user->id) }}" class="flex flex-col gap-2 mt-2">
                                            @csrf
                                            <input 
                                                type="email"
                                                name="email"
                                                x-model="email"
                                                class="border border-gray-600 bg-gray-800 text-gray-100 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                                required
                                            />
                                            @error('email')
                                                <span class="text-red-500 text-xs">
                                                    Ongeldig e-mailadres: {{ $message }}
                                                </span>
                                            @enderror
                                            <select name="role_id" x-model="role_id" class="border border-gray-600 bg-gray-800 text-gray-100 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                                <option value="2">Instructeur</option>
                                                <option value="3">Klant</option>
                                                <option value="1">Admin</option>
                                            </select>
                                            @error('role_id')
                                                <span class="text-red-500 text-xs">
                                                    Ongeldige rol: {{ $message }}
                                                </span>
                                            @enderror
                                            <div class="flex gap-2">
                                                <button type="submit" class="px-2 py-1 bg-green-600 hover:bg-green-700 text-white rounded transition text-sm">Opslaan</button>
                                                <button type="button" @click="edit = false" class="px-2 py-1 bg-gray-600 hover:bg-gray-700 text-white rounded transition text-sm">Annuleer</button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 flex justify-center">
                        {{-- Alleen paginering tonen als $users een paginator is --}}
                        @if(method_exists($users, 'links'))
                            {{ $users->links('pagination::tailwind') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>