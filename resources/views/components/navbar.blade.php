<header class="bg-white shadow">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">WINDSURF</h1>
        <nav class="space-x-4">
            <x-nav-link href="#home" :active="request()->is('/')">Home</x-nav-link>
            <x-nav-link href="#about" :active="request()->is('about')">About</x-nav-link>
            <x-nav-link href="#contact" :active="request()->is('contact')">Contact</x-nav-link>
            <x-nav-link href="{{ route('book.lesson') }}" :active="request()->is('book-lesson')">Book a Lesson</x-nav-link>
            <x-nav-link href="{{ route('login') }}" :active="request()->is('login')">
                <span class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">Log in</span>
            </x-nav-link>
        </nav>
    </div>
</header>