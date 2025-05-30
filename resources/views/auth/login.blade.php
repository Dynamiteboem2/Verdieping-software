<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inloggen | KiteSurfschool Windkracht-12</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#eaf6fb] min-h-screen flex items-center justify-center">
    <div class="flex w-full min-h-screen">
        <!-- Left: Login Form -->
        <div class="flex flex-col justify-center w-full max-w-md px-8 py-12 bg-white bg-opacity-95 rounded-none md:rounded-l-2xl shadow-xl z-10">
            <h2 class="text-2xl font-bold text-[#0077b6] mb-2 tracking-wide">KiteSurfschool Windkracht-12</h2>
            <h1 class="text-3xl font-extrabold mb-8">Inloggen</h1>

            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-1">E-mailadres</label>
                    <input id="email" class="block w-full rounded border-gray-300 focus:border-[#0077b6] focus:ring-[#0077b6]" type="email" name="email" required autofocus placeholder="E-mailadres" autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-semibold mb-1">Wachtwoord</label>
                    <input id="password" class="block w-full rounded border-gray-300 focus:border-[#0077b6] focus:ring-[#0077b6]" type="password" name="password" required placeholder="Wachtwoord" autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <button type="submit" class="w-full py-2 px-4 bg-[#0077b6] text-white font-bold rounded hover:bg-[#009ee3] transition">
                    Inloggen
                </button>
            </form>
            <div class="mt-6 flex flex-col items-center space-y-2">
                <a class="text-sm text-gray-600 hover:underline" href="{{ route('register') }}">
                    Nieuw hier? Account aanmaken
                </a>
            </div>
        </div>
        <!-- Right: Full Height Image -->
        <div class="hidden md:block flex-1 bg-cover bg-center rounded-r-2xl" style="background-image: url('/images/kitesurf-login.png');">
            <!-- The image will cover the entire right side -->
        </div>
    </div>
</body>
</html>
