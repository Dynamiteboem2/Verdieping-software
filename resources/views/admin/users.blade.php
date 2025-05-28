{{-- filepath: resources/views/admin/users.blade.php --}}
<x-app-layout>
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-white">Gebruikersbeheer</h1>
        <div class="overflow-x-auto">
            <table class="w-auto min-w-full rounded-lg shadow bg-gray-900">
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
                        <td class="py-3 px-4 text-gray-100">{{ $user->email }}</td>
                        <td class="py-3 px-4 text-gray-100">
                            {{ $user->role_id == 2 ? 'Instructeur' : ($user->role_id == 3 ? 'Klant' : 'Admin') }}
                        </td>
                        <td class="py-3 px-4">
                            <form method="POST" action="{{ route('admin.updateRole', $user->id) }}" class="flex items-center space-x-2">
                                @csrf
                                <select name="role_id" class="border border-gray-600 bg-gray-800 text-gray-100 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    <option value="2" @selected($user->role_id == 2)>Instructeur</option>
                                    <option value="3" @selected($user->role_id == 3)>Klant</option>
                                    <option value="1" @selected($user->role_id == 1)>Admin</option>
                                </select>
                                <button type="submit" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded transition">Opslaan</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>