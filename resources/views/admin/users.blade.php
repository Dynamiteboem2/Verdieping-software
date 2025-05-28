{{-- filepath: resources/views/admin/users.blade.php --}}
<x-app-layout>
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-white">Gebruikersbeheer</h1>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[700px] rounded-lg shadow bg-gray-900">
                <thead>
                    <tr class="bg-gray-800 text-gray-100">
                        <th class="py-3 px-4 text-left font-semibold w-1/3">Email</th>
                        <th class="py-3 px-4 text-left font-semibold w-1/4">Rol</th>
                        <th class="py-3 px-4 text-left font-semibold w-1/4">Actie</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="@if($loop->even) bg-gray-800 @else bg-gray-900 @endif border-b border-gray-700">
                        <td class="py-3 px-4 text-gray-100">
                            {{ $user->email }}
                        </td>
                        <td class="py-3 px-4 text-gray-100">
                            @if($user->role_id == 2) Instructeur
                            @elseif($user->role_id == 3) Klant
                            @elseif($user->role_id == 1) Admin
                            @endif
                        </td>
                        <td class="py-3 px-4 text-gray-100">
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
                                    <select name="role_id" x-model="role_id" class="border border-gray-600 bg-gray-800 text-gray-100 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                        <option value="2">Instructeur</option>
                                        <option value="3">Klant</option>
                                        <option value="1">Admin</option>
                                    </select>
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
        </div>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>