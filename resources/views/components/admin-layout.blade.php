<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SmartLaundry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <nav class="bg-blue-800 p-4 text-white shadow-md">
            <div class="container mx-auto flex justify-between items-center">
                <div class="font-bold text-xl">
                    SmartLaundry Admin Panel
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm bg-red-500 hover:bg-red-600 px-3 py-1 rounded transition">
                        Logout
                    </button>
                </form>
            </div>
        </nav>

        <main class="flex-grow container mx-auto p-4">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
