<x-app-layout>
    <x-slot name="header">
        Catat Pengeluaran Baru
    </x-slot>

    <div class="p-4 sm:p-8 pb-28 lg:pb-12 relative min-h-screen overflow-x-hidden">

        <div class="absolute top-0 right-1/4 w-[30rem] h-[30rem] bg-rose-400/10 rounded-full blur-[100px] -z-10 pointer-events-none"></div>
        <div class="absolute bottom-10 left-1/4 w-[25rem] h-[25rem] bg-orange-400/10 rounded-full blur-[100px] -z-10 pointer-events-none"></div>

        <div class="max-w-5xl mx-auto">

            <a href="{{ route('admin.expenses.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-rose-600 font-bold mb-6 transition-colors group">
                <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm group-hover:border-rose-300 group-hover:bg-rose-50 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </div>
                Kembali ke Buku Kas
            </a>

            <div class="bg-white/90 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-white overflow-hidden relative">

                <div class="p-8 sm:p-10 border-b border-slate-100/50 bg-slate-50/50">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 bg-gradient-to-br from-rose-500 to-orange-500 text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg shadow-rose-500/30 transform -rotate-3">💸</div>
                        <div>
                            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Catat Pengeluaran</h2>
                            <p class="text-slate-500 font-medium text-sm mt-1">Masukkan rincian biaya operasional yang dikeluarkan hari ini.</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.expenses.store') }}" method="POST" class="p-8 sm:p-10 space-y-7">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                        <div>
                            <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Tanggal</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-rose-500 transition-colors duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}"
                                    class="w-full pl-12 pr-5 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 transition-all duration-300 font-bold text-slate-800 shadow-sm outline-none cursor-pointer">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Kategori Biaya</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-rose-500 transition-colors duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                </div>
                                <select name="kategori" required class="w-full pl-12 pr-10 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 transition-all duration-300 font-black text-rose-700 appearance-none shadow-sm outline-none cursor-pointer">
                                    <option value="Deterjen & Pewangi">🫧 Deterjen & Pewangi</option>
                                    <option value="Listrik & Air">⚡ Listrik & Air</option>
                                    <option value="Gaji Karyawan">👥 Gaji Karyawan</option>
                                    <option value="Bensin Kurir">🛵 Bensin Kurir</option>
                                    <option value="Perawatan Mesin">🔧 Perawatan Mesin</option>
                                    <option value="Lainnya">📦 Lainnya</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-rose-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Keterangan Detail</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-rose-500 transition-colors duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                            </div>
                            <input type="text" name="keterangan" required placeholder="Contoh: Beli Rinso Matic 5 Kg dan Molto" value="{{ old('keterangan') }}"
                                class="w-full pl-12 pr-5 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 transition-all duration-300 font-bold text-slate-800 shadow-sm outline-none placeholder:font-normal placeholder:text-slate-400">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Nominal (Rp)</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-rose-500 transition-colors duration-300">
                                <span class="font-black text-lg">- Rp</span>
                            </div>
                            <input type="number" name="jumlah" required placeholder="150000" min="1" value="{{ old('jumlah') }}"
                                class="w-full pl-16 pr-5 py-4 bg-rose-50/30 border-2 border-rose-100 rounded-2xl focus:bg-white focus:border-rose-500 focus:ring-4 focus:ring-rose-500/20 transition-all duration-300 font-black text-xl text-rose-600 shadow-sm outline-none placeholder:font-normal placeholder:text-rose-300">
                        </div>
                    </div>

                    <div class="pt-8">
                        <button type="submit" class="group relative w-full bg-gradient-to-r from-rose-600 via-rose-500 to-orange-500 text-white font-black text-lg py-5 rounded-2xl shadow-[0_10px_40px_-10px_rgba(225,29,72,0.6)] hover:shadow-[0_20px_50px_-10px_rgba(225,29,72,0.8)] hover:-translate-y-1 transition-all duration-300 overflow-hidden flex items-center justify-center gap-3">
                            <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/30 to-transparent group-hover:animate-[shimmer_1.5s_infinite]"></div>
                            <span class="relative z-10 text-2xl group-hover:scale-125 transition-transform">📉</span>
                            <span class="relative z-10 tracking-wide">SIMPAN CATATAN PENGELUARAN</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
