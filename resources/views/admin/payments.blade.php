{{-- filepath: c:\Users\danie\Herd\verdieping-software\resources\views\admin\invoices.blade.php --}}
<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Facturen & Betalingen</h1>
        <div class="flex flex-wrap gap-6 mb-8">
            <div class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg px-6 py-4 shadow">
                <div class="text-lg font-semibold">Totaal ontvangen</div>
                <div class="text-2xl font-bold">€{{ number_format($totalPaid, 2, ',', '.') }}</div>
            </div>
            <div class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-lg px-6 py-4 shadow">
                <div class="text-lg font-semibold">Aantal betaald</div>
                <div class="text-2xl font-bold">{{ $countPaid }}</div>
            </div>
            <div class="bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-lg px-6 py-4 shadow">
                <div class="text-lg font-semibold">Aantal niet betaald</div>
                <div class="text-2xl font-bold">{{ $countUnpaid }}</div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-200">Overzicht boekingen</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700 rounded shadow">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Datum</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Tijd</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Les</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Boeker</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Email</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Prijs</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Betaald</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($bookings as $booking)
                            <tr>
                                <td class="px-4 py-2 text-gray-700 dark:text-gray-200">{{ \Carbon\Carbon::parse($booking->date)->format('d-m-Y') }}</td>
                                <td class="px-4 py-2 text-gray-700 dark:text-gray-200">{{ $booking->time }}</td>
                                <td class="px-4 py-2 text-gray-700 dark:text-gray-200">{{ $booking->lesson->type ?? '-' }}</td>
                                <td class="px-4 py-2 text-gray-700 dark:text-gray-200">{{ $booking->user->name ?? '-' }}</td>
                                <td class="px-4 py-2 text-gray-700 dark:text-gray-200">{{ $booking->user->email ?? '-' }}</td>
                                <td class="px-4 py-2 text-gray-700 dark:text-gray-200">
                                    €{{ $booking->lesson ? number_format($booking->lesson->price, 2, ',', '.') : '-' }}
                                </td>
                                <td class="px-4 py-2 text-gray-700 dark:text-gray-200">
                                    @if($booking->is_paid)
                                        <span class="inline-block px-2 py-1 bg-green-200 text-green-800 rounded text-xs">Ja</span>
                                    @else
                                        <span class="inline-block px-2 py-1 bg-red-200 text-red-800 rounded text-xs">Nee</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $bookings->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>