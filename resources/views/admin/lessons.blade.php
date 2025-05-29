<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-2xl font-bold mb-8">Alle lessen (overzicht)</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse($lessons as $lesson)
                    <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center">
                        <div class="bg-purple-500 rounded-full p-3 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v3a2 2 0 002 2zm0 0v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6" />
                            </svg>
                        </div>
                        <div class="text-lg font-semibold mb-2">{{ $lesson->title ?? 'Les #' . $lesson->id }}</div>
                        <div class="text-gray-600 mb-1">Instructeur: {{ $lesson->instructor->name ?? 'Onbekend' }}</div>
                        <div class="text-gray-500 text-sm">ID: {{ $lesson->id }}</div>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-500">Geen lessen gevonden.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>