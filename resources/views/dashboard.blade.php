<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Left Column -->
                <div class="md:col-span-2 flex flex-col space-y-6">
                    <!-- First Upcoming Lesson -->
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 mb-4">
                        <h3 class="text-lg font-bold mb-2 text-[#0077b6]">Eerstvolgende les</h3>
                        @if($firstUpcomingLesson)
                            <div>
                                <div class="font-semibold">{{ $firstUpcomingLesson->title ?? 'Les' }}</div>
                                <div>{{ $firstUpcomingLesson->date->format('d-m-Y H:i') }}</div>
                                <div>{{ $firstUpcomingLesson->location ?? '' }}</div>
                            </div>
                        @else
                            <div class="text-gray-500">Je hebt geen aankomende lessen.</div>
                        @endif
                    </div>
                    <!-- Upcoming Lessons -->
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 flex-1">
                        <h3 class="text-lg font-bold mb-2 text-[#0077b6]">Aankomende lessen</h3>
                        @if($upcomingLessons->count())
                            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($upcomingLessons as $lesson)
                                    <li class="py-2">
                                        <div class="font-semibold">{{ $lesson->title ?? 'Les' }}</div>
                                        <div>{{ $lesson->date->format('d-m-Y H:i') }}</div>
                                        <div>{{ $lesson->location ?? '' }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-gray-500">Geen aankomende lessen.</div>
                        @endif
                    </div>
                </div>
                <!-- Right Column -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-2 text-[#0077b6]">Vorige lessen</h3>
                    @if($previousLessons->count())
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($previousLessons as $lesson)
                                <li class="py-2">
                                    <div class="font-semibold">{{ $lesson->title ?? 'Les' }}</div>
                                    <div>{{ $lesson->date->format('d-m-Y H:i') }}</div>
                                    <div>{{ $lesson->location ?? '' }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-gray-500">Nog geen gevolgde lessen.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
