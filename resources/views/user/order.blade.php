<x-app-layout>
    <x-slot name="header">
        Buat Pesanan Baru
    </x-slot>

    <div class="p-4 sm:p-8 pb-24 lg:pb-8 relative">

        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-indigo-400/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        @if(session('success'))
            <div class="mb-8 bg-emerald-50 border border-emerald-200 rounded-2xl p-6 shadow-xl shadow-emerald-100 flex items-start gap-4 animate-[bounce_1s_ease-in-out]">
                <div class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-emerald-600 text-white rounded-full flex items-center justify-center text-2xl flex-shrink-0 shadow-lg shadow-emerald-500/30">✓</div>
                <div>
                    <h3 class="text-emerald-800 font-extrabold text-lg mb-1">Pesanan Berhasil Dibuat!</h3>
                    <p class="text-emerald-700 font-medium text-sm">{{ session('success') }}</p>
                    <a href="{{ route('order.history') }}" class="mt-4 inline-flex items-center gap-2 bg-emerald-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-emerald-600/30 hover:bg-emerald-700 hover:-translate-y-1 transition-all duration-300">
                        <span>🧾</span> Lihat Struk Pesanan
                    </a>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 bg-rose-50 border border-rose-200 rounded-2xl p-5 flex items-center gap-4 shadow-sm">
                <div class="w-10 h-10 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center text-xl flex-shrink-0">⚠️</div>
                <p class="text-rose-700 font-bold">{{ session('error') }}</p>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">

            <div class="w-full lg:w-7/12 xl:w-8/12">
                <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-white overflow-hidden relative">

                    <div class="p-8 sm:p-10 border-b border-slate-100/50 bg-white/50">
                        <div class="flex items-center gap-5 mb-2">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm transform -rotate-3">📝</div>
                            <div>
                                <h2 class="text-3xl font-black text-slate-800 tracking-tight">Detail Cucian</h2>
                                <p class="text-slate-500 font-medium text-sm mt-1">Lengkapi data penjemputan dengan akurat.</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('order.store') }}" method="POST" class="p-8 sm:p-10 space-y-7">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                            <div>
                                <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Nama Pemesan</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                    <input type="text" name="nama_pelanggan" required value="{{ Auth::user()->name }}"
                                        class="w-full pl-12 pr-5 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 font-bold text-slate-800 shadow-sm outline-none">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Nomor WhatsApp Aktif</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <input type="text" name="no_wa" required placeholder="Contoh: 08123456789"
                                        class="w-full pl-12 pr-5 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 font-bold text-slate-800 placeholder:font-normal placeholder:text-slate-400 shadow-sm outline-none">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Alamat Lengkap Penjemputan</label>
                            <div class="relative group">
                                <div class="absolute top-5 left-0 pl-5 flex items-start pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <textarea name="alamat" required rows="3" placeholder="Nama Jalan, Blok/Nomor Rumah, Patokan..."
                                    class="w-full pl-12 pr-5 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 font-bold text-slate-800 placeholder:font-normal placeholder:text-slate-400 shadow-sm outline-none resize-none"></textarea>
                            </div>
                        </div>

                        <div class="h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent my-8"></div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                            <div>
                                <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Pilih Layanan</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors duration-300">
                                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                    </div>
                                    <select name="service_id" required class="w-full pl-12 pr-10 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 font-black text-blue-700 appearance-none shadow-sm outline-none cursor-pointer">
                                        <option value="" class="text-slate-500 font-normal">-- Pilih Jenis Cucian --</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->nama_layanan }} (Rp {{ number_format($service->harga, 0, ',', '.') }} / {{ $service->satuan }})</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Estimasi Jumlah/Berat</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                                    </div>
                                    <input type="number" name="jumlah_berat" required min="1" placeholder="Berapa Kg / Pcs?"
                                        class="w-full pl-12 pr-5 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 font-bold text-slate-800 placeholder:font-normal placeholder:text-slate-400 shadow-sm outline-none">
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 relative group">
                            <div class="absolute -left-3 top-1/2 -translate-y-1/2 w-6 h-6 bg-white rounded-full border-r-2 border-blue-200 z-10 group-hover:border-blue-400 transition-colors"></div>
                            <div class="absolute -right-3 top-1/2 -translate-y-1/2 w-6 h-6 bg-white rounded-full border-l-2 border-blue-200 z-10 group-hover:border-blue-400 transition-colors"></div>

                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50/50 border-2 border-dashed border-blue-200 p-6 sm:p-8 rounded-3xl relative overflow-hidden group-hover:border-blue-400 transition-colors duration-300">
                                <div class="absolute top-0 right-0 w-40 h-40 bg-blue-400/10 rounded-full blur-3xl -mr-10 -mt-10"></div>

                                <label for="kode_promo" class= block font-black text-sm sm:text-base text-blue-900 mb-4 flex flex-wrap items-center gap-3 relative z-10">
                                    <span class="bg-blue-600 text-white w-10 h-10 rounded-xl flex items-center justify-center text-xl shadow-lg shadow-blue-500/30 transform -rotate-6">🎟️</span>
                                    Punya Kode Voucher Diskon?
                                    <span class="text-[10px] font-black bg-white/80 border border-blue-100 text-blue-600 px-3 py-1 rounded-full shadow-sm sm:ml-auto uppercase tracking-widest">Opsional</span>
                                </label>

                                <input type="text" name="kode_promo" id="kode_promo" placeholder="Ketik kode di sini..." value="{{ old('kode_promo') }}"
                                    class="w-full border-2 border-white focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 rounded-2xl py-4.5 px-6 uppercase text-blue-700 font-black text-lg tracking-[0.2em] placeholder:font-medium placeholder:text-blue-300 placeholder:tracking-normal relative z-10 bg-white/60 backdrop-blur-md shadow-inner outline-none transition-all text-center sm:text-left">
                            </div>
                        </div>

                        <div class="pt-8">
                            <button type="submit" class="group relative w-full bg-gradient-to-r from-blue-600 via-blue-500 to-indigo-600 text-white font-black text-lg py-5 rounded-2xl shadow-[0_10px_40px_-10px_rgba(37,99,235,0.6)] hover:shadow-[0_20px_50px_-10px_rgba(37,99,235,0.8)] hover:-translate-y-1 transition-all duration-300 overflow-hidden flex items-center justify-center gap-3">
                                <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/30 to-transparent group-hover:animate-[shimmer_1.5s_infinite]"></div>

                                <span class="relative z-10 text-2xl group-hover:scale-125 transition-transform duration-300">🚀</span>
                                <span class="relative z-10 tracking-wide">KONFIRMASI PESANAN SEKARANG</span>
                            </button>
                            <p class="text-center text-xs text-slate-400 mt-5 font-bold flex items-center justify-center gap-1.5 uppercase tracking-widest">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Enkripsi SSL 256-bit Terjamin Aman
                            </p>
                        </div>

                    </form>
                </div>
            </div>

            <div class="w-full lg:w-5/12 xl:w-4/12 space-y-8">

                <div class="bg-slate-900 rounded-[2.5rem] p-8 sm:p-10 shadow-2xl shadow-slate-900/20 relative overflow-hidden text-white border border-slate-800">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600/20 rounded-full blur-3xl -mr-20 -mt-20"></div>
                    <div class="absolute bottom-0 left-0 w-40 h-40 bg-indigo-600/20 rounded-full blur-3xl -ml-10 -mb-10"></div>

                    <h3 class="text-2xl font-black mb-8 flex items-center gap-4 relative z-10">
                        <div class="w-12 h-12 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/10">💡</div>
                        Cara Kerja
                    </h3>

                    <div class="space-y-8 relative z-10">
                        <div class="flex gap-5 group">
                            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center font-black text-white flex-shrink-0 shadow-lg shadow-blue-500/40 group-hover:scale-110 transition-transform">1</div>
                            <div>
                                <h4 class="font-bold text-white text-lg">Buat Pesanan</h4>
                                <p class="text-sm text-slate-400 mt-1.5 leading-relaxed">Isi formulir di samping dengan detail cucian dan lokasi penjemputan Anda.</p>
                            </div>
                        </div>
                        <div class="flex gap-5 group">
                            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center font-black text-white flex-shrink-0 shadow-lg shadow-blue-500/40 group-hover:scale-110 transition-transform">2</div>
                            <div>
                                <h4 class="font-bold text-white text-lg">Kurir Menjemput</h4>
                                <p class="text-sm text-slate-400 mt-1.5 leading-relaxed">Driver kami akan mengambil pakaian kotor langsung ke depan pintu Anda.</p>
                            </div>
                        </div>
                        <div class="flex gap-5 group">
                            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center font-black text-white flex-shrink-0 shadow-lg shadow-blue-500/40 group-hover:scale-110 transition-transform">3</div>
                            <div>
                                <h4 class="font-bold text-white text-lg">Cuci & Lacak Live</h4>
                                <p class="text-sm text-slate-400 mt-1.5 leading-relaxed">Pantau status pengerjaan secara real-time dari Dashboard Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/80 backdrop-blur-xl border border-white rounded-[2.5rem] p-8 sm:p-10 shadow-xl shadow-slate-200/50 text-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-emerald-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative z-10">
                        <div class="w-20 h-20 bg-gradient-to-br from-emerald-100 to-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-4xl mx-auto mb-5 shadow-inner border border-emerald-100 group-hover:scale-110 transition-transform duration-300">
                            👩🏻‍💻
                        </div>
                        <h3 class="text-xl font-black text-slate-800 mb-2">Butuh Bantuan?</h3>
                        <p class="text-sm text-slate-500 font-medium mb-8 leading-relaxed">CS Executive kami siap membantu Anda memilih layanan yang paling tepat untuk pakaian kesayangan Anda.</p>

                        <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center justify-center gap-3 w-full bg-emerald-500 hover:bg-emerald-600 text-white font-black py-4 px-6 rounded-2xl transition-all duration-300 shadow-[0_10px_20px_-10px_rgba(16,185,129,0.5)] hover:shadow-[0_15px_30px_-10px_rgba(16,185,129,0.6)] hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.096-1.952-.432-1.531-.634-2.52-2.189-2.597-2.292-.077-.103-.618-.823-.618-1.569 0-.746.388-1.115.529-1.259.141-.144.306-.18.411-.18.105 0 .211.002.302.006.108.005.253-.042.396.298.144.341.491 1.203.534 1.292.043.089.072.193.001.336-.072.143-.108.232-.215.352-.108.121-.228.261-.323.364-.105.114-.216.237-.095.447.12.21.534.886 1.144 1.433.788.708 1.442.925 1.652 1.031.21.106.333.089.458-.052.125-.141.542-.631.688-.847.146-.216.292-.18.484-.108.192.072 1.226.578 1.437.684.21.106.351.159.402.247.051.088.051.511-.093.916z"></path></svg>
                            Hubungi via WhatsApp
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
