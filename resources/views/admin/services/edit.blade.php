<x-app-layout>
    <x-slot name="header">
        Perbarui Layanan
    </x-slot>

    <div class="p-4 sm:p-8 pb-28 lg:pb-12 relative min-h-screen overflow-x-hidden">

        <div class="absolute top-0 right-1/4 w-[30rem] h-[30rem] bg-indigo-400/10 rounded-full blur-[100px] -z-10 pointer-events-none"></div>
        <div class="absolute bottom-10 left-1/4 w-[25rem] h-[25rem] bg-purple-400/10 rounded-full blur-[100px] -z-10 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto">

            <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-indigo-600 font-bold mb-6 transition-colors group">
                <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm group-hover:border-indigo-300 group-hover:bg-indigo-50 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </div>
                Kembali ke Daftar Layanan
            </a>

            <div class="flex flex-col lg:flex-row gap-8">

                <div class="w-full lg:w-7/12 xl:w-8/12">
                    <div class="bg-white/90 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-white overflow-hidden relative">

                        <div class="p-8 sm:p-10 border-b border-slate-100/50 bg-slate-50/50">
                            <div class="flex items-center gap-5">
                                <div class="w-14 h-14 bg-gradient-to-br from-indigo-600 to-purple-600 text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg shadow-indigo-500/30 transform -rotate-3">✏️</div>
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Edit Master Data</h2>
                                        <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-lg text-xs font-black tracking-widest uppercase">ID: {{ $service->id }}</span>
                                    </div>
                                    <p class="text-slate-500 font-medium text-sm">Perbarui harga atau rincian layanan ini.</p>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" class="p-8 sm:p-10 space-y-7">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Nama Layanan</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-600 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    </div>
                                    <input type="text" name="nama_layanan" required value="{{ old('nama_layanan', $service->nama_layanan) }}"
                                        class="w-full pl-12 pr-5 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 font-bold text-slate-800 shadow-sm outline-none">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                                <div>
                                    <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Harga Layanan Terbaru</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-600 transition-colors duration-300">
                                            <span class="font-black">Rp</span>
                                        </div>
                                        <input type="number" name="harga" required min="0" value="{{ old('harga', $service->harga) }}"
                                            class="w-full pl-12 pr-5 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 font-bold text-slate-800 shadow-sm outline-none">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Satuan Hitung</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-600 transition-colors duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                                        </div>
                                        <select name="satuan" required class="w-full pl-12 pr-10 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 font-black text-indigo-700 appearance-none shadow-sm outline-none cursor-pointer">
                                            <option value="kg" {{ (old('satuan', $service->satuan) == 'kg') ? 'selected' : '' }}>Per Kilogram (Kg)</option>
                                            <option value="pcs" {{ (old('satuan', $service->satuan) == 'pcs') ? 'selected' : '' }}>Per Potong Pakaian (Pcs)</option>
                                            <option value="m2" {{ (old('satuan', $service->satuan) == 'm2') ? 'selected' : '' }}>Per Meter Persegi (M²)</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-8">
                                <button type="submit" class="group relative w-full bg-gradient-to-r from-indigo-600 via-indigo-500 to-purple-600 text-white font-black text-lg py-5 rounded-2xl shadow-[0_10px_40px_-10px_rgba(79,70,229,0.6)] hover:shadow-[0_20px_50px_-10px_rgba(79,70,229,0.8)] hover:-translate-y-1 transition-all duration-300 overflow-hidden flex items-center justify-center gap-3">
                                    <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/30 to-transparent group-hover:animate-[shimmer_1.5s_infinite]"></div>
                                    <span class="relative z-10 text-2xl group-hover:scale-125 transition-transform">💾</span>
                                    <span class="relative z-10 tracking-wide">SIMPAN PERUBAHAN</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="w-full lg:w-5/12 xl:w-4/12 space-y-8">
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 sm:p-10 shadow-2xl shadow-slate-900/20 relative overflow-hidden text-white border border-slate-800">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-amber-500/10 rounded-full blur-3xl -mr-20 -mt-20"></div>

                        <h3 class="text-xl font-black mb-6 flex items-center gap-4 relative z-10 text-amber-400">
                            <div class="w-12 h-12 bg-amber-500/10 backdrop-blur-md rounded-2xl flex items-center justify-center border border-amber-500/20 text-2xl">⚠️</div>
                            Perhatian Sistem
                        </h3>

                        <div class="space-y-6 relative z-10 text-sm font-medium text-slate-300 leading-relaxed">
                            <div class="flex gap-4 items-start">
                                <span class="text-amber-500 text-xl leading-none mt-0.5">•</span>
                                <p>Mengubah <span class="font-bold text-white">Harga Layanan</span> di sini <span class="font-bold text-white bg-slate-800 px-2 py-0.5 rounded">TIDAK AKAN</span> merubah total tagihan pada pesanan yang sudah dibuat sebelumnya (Pesanan Lama).</p>
                            </div>
                            <div class="flex gap-4 items-start">
                                <span class="text-amber-500 text-xl leading-none mt-0.5">•</span>
                                <p>Harga baru hanya akan berlaku dan dihitung pada <span class="font-bold text-white">Pesanan Baru</span> yang dibuat oleh pelanggan setelah perubahan ini disimpan.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
