<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartLaundry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    <nav class="bg-indigo-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <div class="flex items-center space-x-4">
                    <a href="{{ route('order.index') }}" class="text-2xl font-extrabold tracking-wider flex items-center gap-2">
                        👕 <span class="hidden sm:inline">SmartLaundry</span>
                    </a>
                    <div class="hidden md:flex space-x-2 ml-6 border-l border-indigo-400 pl-6">
                        <a href="{{ route('order.index') }}" class="{{ request()->routeIs('order.index') ? 'bg-indigo-800' : 'hover:bg-indigo-500' }} px-4 py-2 rounded-md font-medium transition">Pesan Baru</a>
                        <a href="{{ route('order.track') }}" class="{{ request()->routeIs('order.track') ? 'bg-indigo-800' : 'hover:bg-indigo-500' }} px-4 py-2 rounded-md font-medium transition">Lacak Cucian</a>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="bg-white text-indigo-600 hover:bg-gray-200 px-4 py-2 rounded-md font-bold transition shadow-sm">Admin Panel</a>
                            @else
                                <a href="{{ route('dashboard') }}" class="bg-white text-indigo-600 hover:bg-gray-200 px-4 py-2 rounded-md font-bold transition shadow-sm">Dashboard</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="text-white hover:text-indigo-200 font-semibold transition">Log in</a>
                        @endauth
                    @endif
                </div>
            </div>

            <div class="md:hidden flex space-x-2 pb-3 pt-1 border-t border-indigo-500 mt-2">
                <a href="{{ route('order.index') }}" class="block {{ request()->routeIs('order.index') ? 'bg-indigo-800' : 'hover:bg-indigo-500' }} px-3 py-2 rounded-md font-medium text-sm">Pesan</a>
                <a href="{{ route('order.track') }}" class="block {{ request()->routeIs('order.track') ? 'bg-indigo-800' : 'hover:bg-indigo-500' }} px-3 py-2 rounded-md font-medium text-sm">Lacak</a>
            </div>
        </div>
    </nav>
    <main class="flex-grow flex flex-col items-center justify-start pt-10 pb-10 px-4">
        {{ $slot }}
    </main>

    <footer class="bg-gray-800 text-gray-300 text-center py-4 text-sm mt-auto">
        &copy; {{ date('Y') }} SmartLaundry. Dibuat dengan ❤️ untuk PKL.
    </footer>

</body>
</html>
