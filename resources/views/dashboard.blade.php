<x-app-layout>
    <x-slot name="header">
        Pusat Kendali
    </x-slot>

    <div class="p-4 sm:p-8 space-y-8 pb-24 lg:pb-8">

        <div class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 rounded-[2.5rem] p-8 sm:p-12 overflow-hidden shadow-2xl">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-32 -mb-10 w-40 h-40 bg-blue-500 opacity-20 rounded-full blur-2xl"></div>

            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="text-left">
                    <span class="inline-block bg-blue-500/30 text-blue-100 backdrop-blur-sm border border-blue-400/30 px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase mb-4">
                        Status: Member Aktif ✨
                    </span>
                    <h1 class="text-3xl sm:text-5xl font-black text-white mb-2 leading-tight">
                        Halo, {{ Auth::user()->name }}! 👋
                    </h1>
                    <p class="text-blue-100 text-sm sm:text-lg max-w-xl font-medium leading-relaxed">
                        Hari yang cerah untuk bersantai. Serahkan urusan cucian kotor Anda pada kami, dan nikmati waktu luang bersama keluarga tanpa beban.
                    </p>
                </div>

                <div class="hidden md:block">
                    <div class="w-32 h-32 bg-white/10 backdrop-blur-md rounded-full border-[8px] border-white/20 flex items-center justify-center text-5xl shadow-[0_0_30px_rgba(59,130,246,0.5)] transform hover:rotate-12 transition duration-500">
                        🧺
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative z-20 -mt-16 px-4">
            <div class="bg-white rounded-2xl p-6 shadow-xl shadow-slate-200/50 border border-slate-100 flex items-center gap-4 transform transition duration-300 hover:-translate-y-2">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-2xl font-black">
                    ⏱️
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Status Cucian</p>
                    <h3 class="text-2xl font-black text-slate-800">Cepat & Tepat</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xl shadow-slate-200/50 border border-slate-100 flex items-center gap-4 transform transition duration-300 hover:-translate-y-2">
                <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-2xl font-black">
                    ✨
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Kualitas Layanan</p>
                    <h3 class="text-2xl font-black text-slate-800">Premium 100%</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xl shadow-slate-200/50 border border-slate-100 "flex items-center gap-4 transform transition duration-300 hover:-translate-y-2 md:flex hidden">
                <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-2xl font-black">
                    🚚
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Antar Jemput</p>
                    <h3 class="text-2xl font-black text-slate-800">Gratis Biaya</h3>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-4">

            <div class="bg-white rounded-[2rem] p-8 shadow-lg border border-slate-100 relative overflow-hidden group hover:border-indigo-200 transition-colors">
                <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-full blur-3xl -mr-10 -mt-10 transition duration-500 group-hover:bg-blue-100"></div>
                <h3 class="text-xl font-black text-slate-800 mb-2 relative z-10 flex items-center gap-2">
                    <span class="text-blue-600">📍</span> Lacak Pesanan Cepat
                </h3>
                <p class="text-slate-500 font-medium text-sm mb-6 relative z-10">Masukkan nomor resi Anda untuk melihat status cucian secara real-time langsung dari sini.</p>

                <form action="{{ route('order.track') }}" method="GET" class="relative z-10 flex flex-col sm:flex-row gap-3">
                    <input type="text" name="resi" placeholder="Contoh: LND-1234" required
                        class="flex-1 bg-slate-50 border border-slate-200 rounded-xl px-5 py-3.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-black text-slate-800 uppercase placeholder:font-normal placeholder:normal-case placeholder:text-slate-400 transition">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3.5 rounded-xl font-bold shadow-md transition transform hover:-translate-y-1">
                        Cari
                    </button>
                </form>
            </div>

            <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-[2rem] p-8 shadow-lg relative overflow-hidden flex flex-col justify-center transform transition duration-500 hover:scale-[1.02]">
                <div class="absolute bottom-0 right-0 w-48 h-48 bg-white opacity-10 rounded-full blur-2xl -mb-10 -mr-10"></div>
                <h3 class="text-2xl font-black text-white mb-2 relative z-10">Pakaian Kotor Menumpuk?</h3>
                <p class="text-blue-100 font-medium text-sm mb-6 relative z-10 max-w-sm">Jangan biarkan pakaian kotor merusak mood Anda. Kurir kami siap menjemput sekarang juga!</p>

                <div class="relative z-10">
                    <a href="{{ route('order.index') }}" class="inline-flex items-center gap-2 bg-white text-blue-700 hover:bg-blue-50 px-8 py-3.5 rounded-xl font-black shadow-[0_10px_20px_-10px_rgba(255,255,255,0.5)] transition transform hover:-translate-y-1">
                        <span>🚀</span> Buat Pesanan Baru
                    </a>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
