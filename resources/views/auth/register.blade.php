{{-- filepath: resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren | KiteSurfschool Windkracht-12</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#eaf6fb] min-h-screen flex items-center justify-center">
    <div class="flex w-full min-h-screen">
        <!-- Left: Register Form -->
        <div class="flex flex-col justify-center w-full max-w-md px-8 py-12 bg-white bg-opacity-95 rounded-none md:rounded-l-2xl shadow-xl z-10">
            <h2 class="text-2xl font-bold text-[#0077b6] mb-2 tracking-wide">KiteSurfschool Windkracht-12</h2>
            <h1 class="text-3xl font-extrabold mb-8">Registreren</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-1">E-mailadres</label>
                    <input id="email" class="block w-full rounded border-gray-300 focus:border-[#0077b6] focus:ring-[#0077b6]" type="email" name="email" required autofocus placeholder="E-mailadres" autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <button type="submit" class="w-full py-2 px-4 bg-[#0077b6] text-white font-bold rounded hover:bg-[#009ee3] transition">
                    Registreren
                </button>
            </form>
            <div class="mt-6 flex flex-col items-center space-y-2">
                <a class="text-sm text-[#0077b6] hover:underline" href="{{ route('login') }}">
                    Al een account? Inloggen
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