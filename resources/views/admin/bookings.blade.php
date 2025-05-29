<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <x-app-layout>
            <div class="py-12">
                <div class="max-w-6xl mx-auto px-4">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <h2 class="text-2xl font-bold mb-8 text-gray-800 dark:text-gray-200">Alle boekingen (overzicht)</h2>
                        @if(session('success'))
                            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="GET" class="mb-6 flex flex-wrap gap-4 items-end">
                            <div>
                                <label for="instructor" class="block text-xs font-semibold mb-1">Instructeur</label>
                                <select name="instructor" id="instructor" class="border rounded px-2 py-1">
                                    <option value="">Alle</option>
                                    @foreach(\App\Models\User::where('role_id', 2)->orderBy('name')->get() as $instructor)
                                        <option value="{{ $instructor->id }}" @if(request('instructor') == $instructor->id) selected @endif>
                                            {{ $instructor->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="period" class="block text-xs font-semibold mb-1">Periode</label>
                                <select name="period" id="period" class="border rounded px-2 py-1">
                                    <option value="">Alles</option>
                                    <option value="week" @if(request('period')=='week') selected @endif>Deze week</option>
                                    <option value="month" @if(request('period')=='month') selected @endif>Deze maand</option>
                                    <option value="year" @if(request('period')=='year') selected @endif>Dit jaar</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-xs font-semibold">
                                    Filter
                                </button>
                            </div>
                        </form>
                        <table class="min-w-full bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Instructeur</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Boeker</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Type</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Datum</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Tijd</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Acties</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @if($bookings->total() === 0)
                                    <tr>
                                        <td colspan="6" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">Geen boekingen gevonden.</td>
                                    </tr>
                                    @for($i = 0; $i < ($bookings->perPage() - 1); $i++)
                                        <tr>
                                            <td colspan="6" class="px-4 py-2 text-transparent">-</td>
                                        </tr>
                                    @endfor
                                @else
                                    @foreach($bookings as $booking)
                                        <tr>
                                            <td class="px-4 py-2 text-gray-700 dark:text-gray-200">{{ $booking->instructor->name ?? 'Onbekend' }}</td>
                                            <td class="px-4 py-2 text-gray-700 dark:text-gray-200">{{ $booking->user->name ?? 'Onbekend' }}</td>
                                            <td class="px-4 py-2 text-gray-700 dark:text-gray-200">{{ $booking->lesson->type ?? 'Onbekend' }}</td>
                                            <td class="px-4 py-2 text-gray-700 dark:text-gray-200">{{ $booking->date ?? '-' }}</td>
                                            <td class="px-4 py-2 text-gray-700 dark:text-gray-200">{{ $booking->time ?? '-' }}</td>
                                            <td class="px-4 py-2 flex gap-2">
                                                <form method="POST" action="{{ route('admin.bookings.notify', [$booking->id]) }}">
                                                    @csrf
                                                    <input type="hidden" name="type" value="sick_instructor">
                                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-semibold shadow">
                                                        Ziekmelding instructeur
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.bookings.notify', [$booking->id]) }}">
                                                    @csrf
                                                    <input type="hidden" name="type" value="windkracht">
                                                    <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-3 py-1 rounded text-xs font-semibold shadow">
                                                        Windkracht &gt;10
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @for($i = 0; $i < ($bookings->perPage() - $bookings->count()); $i++)
                                        <tr>
                                            <td colspan="6" class="px-4 py-2 text-transparent">-</td>
                                        </tr>
                                    @endfor
                                @endif
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $bookings->withQueryString()->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </x-app-layout>
    </div>
</body>