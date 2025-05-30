<header class="bg-white shadow">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">KiteSurfschool Windkracht-12</h1>
        <nav class="space-x-4">
            <x-nav-link href="{{ url('/') }}" :active="request()->is('/')">Home</x-nav-link>
            <x-nav-link href="{{ route('book.lesson') }}" :active="request()->is('book-lesson')">Boek een les</x-nav-link>
            @auth
                <div x-data="{ open: false }" class="relative inline-block">
                    <button @click="open = !open" class="px-4 py-2 border border-gray-300 rounded bg-gray-100 text-gray-700 focus:outline-none">
                        {{ Auth::user()->name }}
                        <svg class="inline h-4 w-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg z-50"
                        style="display: none;" x-cloak>
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Log out</button>
                        </form>
                    </div>
                </div>
            @else
                <x-nav-link href="{{ route('login') }}" :active="request()->is('login')">
                    <span class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">Log in</span>
                </x-nav-link>
            @endauth
        </nav>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </div>
</header>