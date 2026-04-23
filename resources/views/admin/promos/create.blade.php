<x-app-layout>
    <x-slot name="header">
        Buat Kode Promo Baru
    </x-slot>

    <div class="p-4 sm:p-8 pb-28 lg:pb-12 relative min-h-screen overflow-x-hidden">

        <div class="absolute top-0 right-1/4 w-[30rem] h-[30rem] bg-amber-400/10 rounded-full blur-[100px] -z-10 pointer-events-none"></div>
        <div class="absolute bottom-10 left-1/4 w-[25rem] h-[25rem] bg-orange-400/10 rounded-full blur-[100px] -z-10 pointer-events-none"></div>

        <div class="max-w-4xl mx-auto">

            <a href="{{ route('admin.promos.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-amber-600 font-bold mb-6 transition-colors group">
                <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm group-hover:border-amber-300 group-hover:bg-amber-50 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </div>
                Kembali ke Daftar Voucher
            </a>

            <div class="bg-white/90 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-white overflow-hidden relative">

                <div class="p-8 sm:p-10 border-b border-slate-100/50 bg-slate-50/50">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-gradient-to-br from-amber-400 to-orange-500 text-white rounded-2xl flex items-center justify-center text-3xl shadow-lg shadow-amber-500/30 transform -rotate-3">🎟️</div>
                        <div>
                            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Rilis Voucher Baru</h2>
                            <p class="text-slate-500 font-medium text-sm mt-1">Buat kode unik untuk memberikan diskon kepada pelanggan Anda.</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.promos.store') }}" method="POST" class="p-8 sm:p-10 space-y-7">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                        <div>
                            <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Kode Unik Voucher</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                </div>
                                <input type="text" name="kode" required placeholder="Contoh: JUMATBERKAH" value="{{ old('kode') }}"
                                    class="w-full pl-12 pr-5 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 font-black text-slate-800 uppercase tracking-widest shadow-sm outline-none placeholder:font-normal placeholder:tracking-normal placeholder:text-slate-400">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Potongan Harga (%)</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors duration-300">
                                    <span class="font-black text-lg">%</span>
                                </div>
                                <input type="number" name="diskon_persen" required placeholder="10" min="1" max="100" value="{{ old('diskon_persen') }}"
                                    class="w-full pl-12 pr-5 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 font-black text-xl text-amber-600 shadow-sm outline-none placeholder:font-normal placeholder:text-slate-400">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                        <div>
                            <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Batas Kuota Pemakaian</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-amber-500 transition-colors duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <input type="number" name="kuota" required placeholder="50" min="1" value="{{ old('kuota') }}"
                                    class="w-full pl-12 pr-5 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 font-bold text-slate-800 shadow-sm outline-none">
                            </div>
                            <p class="text-[10px] font-bold text-slate-400 mt-2 ml-2">Berapa kali voucher ini bisa diklaim oleh pelanggan?</p>
                        </div>

                        <div>
                            <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Deskripsi Singkat (Opsional)</label>
                            <input type="text" name="deskripsi" placeholder="Promo pelanggan baru..." value="{{ old('deskripsi') }}"
                                class="w-full px-5 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 font-bold text-slate-800 shadow-sm outline-none">
                        </div>
                    </div>

                    <div class="pt-8">
                        <button type="submit" class="group relative w-full bg-gradient-to-r from-amber-500 to-orange-500 text-white font-black text-lg py-5 rounded-2xl shadow-[0_10px_40px_-10px_rgba(245,158,11,0.6)] hover:shadow-[0_20px_50px_-10px_rgba(245,158,11,0.8)] hover:-translate-y-1 transition-all duration-300 overflow-hidden flex items-center justify-center gap-3">
                            <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/30 to-transparent group-hover:animate-[shimmer_1.5s_infinite]"></div>
                            <span class="relative z-10 text-2xl group-hover:scale-125 transition-transform">✨</span>
                            <span class="relative z-10 tracking-wide uppercase">Terbitkan Voucher Sekarang</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
