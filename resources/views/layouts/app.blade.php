<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SmartLaundry') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="antialiased bg-slate-50 text-slate-900">

    <div x-data="{ sidebarOpen: false }" class="min-h-screen flex overflow-hidden">

        @include('layouts.navigation')

        <div class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300 relative">

            <header class="h-20 bg-white/90 backdrop-blur-md border-b border-slate-100 sticky top-0 z-30 flex items-center justify-between px-4 sm:px-8 print:hidden shadow-sm">

                <div class="flex items-center gap-3 sm:gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2.5 bg-slate-50 text-slate-600 hover:text-blue-600 hover:bg-blue-100 border border-slate-200 rounded-xl transition-all shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>

                    <h2 class="text-lg sm:text-xl font-extrabold text-slate-800 tracking-tight uppercase truncate">
                        {{ $header ?? 'Dashboard' }}
                    </h2>
                </div>

                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest">{{ Auth::user()->role }}</p>
                        <p class="text-sm font-bold text-slate-700">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold shadow-lg shadow-blue-200">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <main class="flex-1">
                {{ $slot }}
            </main>

            <footer class="py-6 px-8 text-center text-[10px] sm:text-xs text-slate-400 font-bold tracking-widest border-t border-slate-100 bg-white print:hidden uppercase">
                &copy; {{ date('Y') }} SmartLaundry System. All Rights Reserved.
            </footer>
        </div>
    </div>
</body>
</html>
