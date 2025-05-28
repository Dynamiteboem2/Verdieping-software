{{-- filepath: resources/views/admin/users.blade.php --}}
<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Gebruikersbeheer</h1>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th>Email</th>
                <th>Rol</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role_id == 2 ? 'Instructeur' : ($user->role_id == 3 ? 'Klant' : 'Admin') }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.updateRole', $user->id) }}">
                        @csrf
                        <select name="role_id" class="border rounded">
                            <option value="2" @selected($user->role_id == 2)>Instructeur</option>
                            <option value="3" @selected($user->role_id == 3)>Klant</option>
                            <option value="1" @selected($user->role_id == 1)>Admin</option>
                        </select>
                        <button type="submit" class="ml-2 px-2 py-1 bg-blue-500 text-white rounded">Opslaan</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>