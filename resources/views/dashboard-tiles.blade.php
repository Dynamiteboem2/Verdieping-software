{{-- filepath: resources/views/dashboard-tiles.blade.php --}}
<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @if(Auth::user()->role_id == 1)
                    <!-- Admin: Manage Users -->
                    <a href="{{ route('admin.users') }}" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-lg flex flex-col items-center justify-center p-8 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 010 7.75" />
                        </svg>
                        <span class="text-xl font-semibold">Gebruikers beheren</span>
                    </a>
                    <!-- Admin: View All bookings -->
                    <a href="{{ route('admin.bookings') }}" class="bg-purple-500 hover:bg-purple-600 text-white rounded-lg shadow-lg flex flex-col items-center justify-center p-8 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v3a2 2 0 002 2zm0 0v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6" />
                        </svg>
                        <span class="text-xl font-semibold">Alle lessen (overzicht)</span>
                    </a>
                @endif

                @if(Auth::user()->role_id == 2)
                    <!-- Instructor: Manage Customers/Lessons -->
                    <a href="{{ route('instructor.customers') }}" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-lg flex flex-col items-center justify-center p-8 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 00-3-3.87M15 17v-2a4 4 0 013-3.87M12 7a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                        <span class="text-xl font-semibold">Klanten/Lessen beheren</span>
                    </a>
                @endif

                <!-- External Applications (for all roles, or restrict as needed) -->
                <a href="https://voorbeeld-externe-app.nl" target="_blank" class="bg-green-500 hover:bg-green-600 text-white rounded-lg shadow-lg flex flex-col items-center justify-center p-8 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 14.93V21a8 8 0 01-8-8h2.07A6 6 0 0013 18.93z" />
                    </svg>
                    <span class="text-xl font-semibold">Externe applicaties</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>