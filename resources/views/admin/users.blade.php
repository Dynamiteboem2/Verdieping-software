{{-- filepath: resources/views/admin/users.blade.php --}}
<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Gebruikersbeheer</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">Rol</th>
                    <th class="py-3 px-6 text-left">Actie</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="@if($loop->even) bg-gray-100 @endif border-b">
                    <td class="py-3 px-6">{{ $user->email }}</td>
                    <td class="py-3 px-6">
                        {{ $user->role_id == 2 ? 'Instructeur' : ($user->role_id == 3 ? 'Klant' : 'Admin') }}
                    </td>
                    <td class="py-3 px-6">
                        <form method="POST" action="{{ route('admin.updateRole', $user->id) }}" class="flex items-center space-x-2">
                            @csrf
                            <select name="role_id" class="border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400">
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
</x-app-layout>