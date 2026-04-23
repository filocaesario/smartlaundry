<div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden"
    @click="sidebarOpen = false" style="display: none;"></div>

<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed lg:static inset-y-0 left-0 z-50 w-72 bg-slate-900 min-h-screen flex flex-col border-r border-white/5 transition-transform duration-300 ease-in-out print:hidden shadow-2xl lg:shadow-none">

    <button @click="sidebarOpen = false"
        class="lg:hidden absolute top-6 right-6 w-10 h-10 bg-white/10 hover:bg-rose-500 hover:text-white text-slate-400 rounded-xl flex items-center justify-center transition-all backdrop-blur-md">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <div class="p-8">
        <div class="flex items-center gap-3 group cursor-pointer">
            <div
                class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center shadow-[0_0_20px_rgba(37,99,235,0.4)] group-hover:rotate-6 transition-all duration-300">
                <span class="text-white text-2xl font-black italic">S</span>
            </div>
            <div class="flex flex-col">
                <span class="text-xl font-black tracking-tight text-white leading-none">Smart<span
                        class="text-blue-500">Laundry</span></span>
                <span class="text-[10px] font-bold text-blue-400 tracking-[0.2em] mt-1">EXECUTIVE APP</span>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-4 space-y-2 mt-2 overflow-y-auto custom-scrollbar">

        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <span class="text-xl">🏠</span>
            <span class="font-bold text-sm tracking-wide">Dashboard Utama</span>
        </a>

        @if (Auth::user()->role === 'user')
            <div class="pt-4 pb-2 px-4">
                <p class="text-[10px] font-black tracking-widest text-slate-500 uppercase">Layanan Pelanggan</p>
            </div>
            <a href="{{ route('order.index') }}"
                class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('order.index') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <span class="text-xl">🧺</span>
                <span class="font-bold text-sm tracking-wide">Buat Pesanan</span>
            </a>

            <a href="{{ route('order.track') }}"
                class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('order.track') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <span class="text-xl">📍</span>
                <span class="font-bold text-sm tracking-wide">Lacak Pesanan</span>
            </a>

            <a href="{{ route('order.history') }}"
                class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('order.history') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <span class="text-xl">🧾</span>
                <span class="font-bold text-sm tracking-wide">Riwayat & Struk</span>
            </a>
        @endif

        @if (Auth::user()->role === 'admin')
            <div class="pt-4 pb-2 px-4">
                <p class="text-[10px] font-black tracking-widest text-slate-500 uppercase">Menu Administrator</p>
            </div>
            <a href="{{ route('admin.monitoring') }}"
                class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.monitoring') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <span class="text-xl">📊</span>
                <span class="font-bold text-sm tracking-wide">Monitoring Pesanan</span>
            </a>
            <a href="{{ route('admin.services.index') }}"
                class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.services.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <span class="text-xl">✨</span>
                <span class="font-bold text-sm tracking-wide">Manajemen Layanan</span>
            </a>
            <a href="{{ route('admin.expenses.index') }}"
                class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.expenses.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <span class="text-xl">💸</span>
                <span class="font-bold text-sm tracking-wide">Buku Kas (Keuangan)</span>
            </a>
            <a href="{{ route('admin.customers.index') }}"
                class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.customers.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <span class="text-xl">👥</span>
                <span class="font-bold text-sm tracking-wide">Pelanggan (CRM)</span>
            </a>
            <a href="{{ route('admin.promos.index') }}"
                class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('admin.promos.*') ? 'bg-amber-500 text-white shadow-lg shadow-amber-500/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <span class="text-xl">🎟️</span>
                <span class="font-bold text-sm tracking-wide">Kode Promo / Voucher</span>
            </a>
        @endif

        <div class="pt-6 pb-2 px-4">
            <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent w-full"></div>
        </div>

        <a href="{{ route('profile.edit') }}"
            class="flex items-center gap-4 px-4 py-4 rounded-2xl transition-all duration-300 {{ request()->routeIs('profile.edit') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <span class="text-xl">⚙️</span>
            <span class="font-bold text-sm tracking-wide">Pengaturan Akun</span>
        </a>

    </nav>

    <div class="p-6 border-t border-white/5">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center gap-3 px-4 py-4 rounded-2xl bg-gradient-to-r from-rose-500/10 to-rose-600/10 border border-rose-500/20 text-rose-500 hover:bg-rose-500 hover:text-white font-black text-sm transition-all duration-300 shadow-sm hover:shadow-rose-500/30 hover:-translate-y-1">
                <span>🚪</span> KELUAR APLIKASI
            </button>
        </form>
    </div>
</aside>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #334155;
        border-radius: 10px;
    }

    .custom-scrollbar:hover::-webkit-scrollbar-thumb {
        background: #475569;
    }
</style>
