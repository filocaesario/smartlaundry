<x-app-layout>
    <x-slot name="header">
        Perbarui Pesanan
    </x-slot>

    <div class="p-4 sm:p-8 pb-24 lg:pb-12 relative min-h-screen">

        <div class="absolute top-0 right-1/4 w-[30rem] h-[30rem] bg-amber-400/5 rounded-full blur-[100px] -z-10 pointer-events-none"></div>
        <div class="absolute bottom-10 left-1/4 w-[25rem] h-[25rem] bg-blue-400/10 rounded-full blur-[100px] -z-10 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto">

            <a href="{{ route('order.history') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-blue-600 font-bold mb-6 transition-colors group">
                <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm group-hover:border-blue-300 group-hover:bg-blue-50 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                </div>
                Kembali ke Riwayat
            </a>

            @if(session('error'))
                <div class="mb-8 bg-rose-50 border border-rose-200 rounded-2xl p-5 flex items-center gap-4 shadow-sm animate-[fadeInDown_0.5s_ease-out]">
                    <div class="w-10 h-10 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center text-xl flex-shrink-0">⚠️</div>
                    <p class="text-rose-700 font-bold">{{ session('error') }}</p>
                </div>
            @endif

            <div class="flex flex-col lg:flex-row gap-8">

                <div class="w-full lg:w-7/12 xl:w-8/12">
                    <div class="bg-white/90 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-white overflow-hidden relative">

                        <div class="p-8 sm:p-10 border-b border-slate-100/50 bg-slate-50/50">
                            <div class="flex items-center gap-5 mb-2">
                                <div class="w-14 h-14 bg-gradient-to-br from-amber-50 to-orange-50 border border-amber-100 text-amber-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm transform -rotate-3">✏️</div>
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Edit Pesanan</h2>
                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-xs font-black tracking-widest">{{ $order->nomor_resi }}</span>
                                    </div>
                                    <p class="text-slate-500 font-medium text-sm">Ubah detail pesanan Anda sebelum cucian diproses.</p>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('order.update', $order->id) }}" method="POST" class="p-8 sm:p-10 space-y-7">
                            @csrf
                            @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                                <div>
                                    <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Nama Pemesan</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        </div>
                                        <input type="text" name="nama_pelanggan" required value="{{ old('nama_pelanggan', $order->nama_pelanggan) }}"
                                            class="w-full pl-12 pr-5 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 font-bold text-slate-800 shadow-sm outline-none">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Nomor WhatsApp</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        </div>
                                        <input type="text" name="no_wa" required value="{{ old('no_wa', $order->no_wa) }}"
                                            class="w-full pl-12 pr-5 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 font-bold text-slate-800 shadow-sm outline-none">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-extrabold text-slate-700 mb-2 ml-1">Alamat Penjemputan</label>
                                <div class="relative group">
                                    <div class="absolute top-5 left-0 pl-5 flex items-start pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                    <textarea name="alamat" required rows="3"
                                        class="w-full pl-12 pr-5 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 font-bold text-slate-800 shadow-sm outline-none resize-none">{{ old('alamat', $order->alamat) }}</textarea>
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
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}" {{ $order->service_id == $service->id ? 'selected' : '' }}>
                                                    {{ $service->nama_layanan }} (Rp {{ number_format($service->harga, 0, ',', '.') }} / {{ $service->satuan }})
                                                </option>
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
                                        <input type="number" name="jumlah_berat" required min="1" value="{{ old('jumlah_berat', $order->jumlah_berat) }}"
                                            class="w-full pl-12 pr-5 py-4 bg-slate-50/50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 font-bold text-slate-800 shadow-sm outline-none">
                                    </div>
                                </div>
                            </div>

                            <div class="pt-8">
                                <button type="submit" class="group relative w-full bg-gradient-to-r from-blue-600 via-blue-500 to-indigo-600 text-white font-black text-lg py-5 rounded-2xl shadow-[0_10px_40px_-10px_rgba(37,99,235,0.6)] hover:shadow-[0_20px_50px_-10px_rgba(37,99,235,0.8)] hover:-translate-y-1 transition-all duration-300 overflow-hidden flex items-center justify-center gap-3">
                                    <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/30 to-transparent group-hover:animate-[shimmer_1.5s_infinite]"></div>
                                    <span class="relative z-10 text-2xl">💾</span>
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
                            Catatan Penting
                        </h3>

                        <div class="space-y-6 relative z-10 text-sm font-medium text-slate-300 leading-relaxed">
                            <div class="flex gap-4 items-start">
                                <span class="text-amber-500 text-xl leading-none mt-0.5">•</span>
                                <p>Pesanan hanya dapat diperbarui selama statusnya masih <span class="font-bold text-white bg-slate-800 px-2 py-0.5 rounded">Antre</span>.</p>
                            </div>
                            <div class="flex gap-4 items-start">
                                <span class="text-amber-500 text-xl leading-none mt-0.5">•</span>
                                <p>Jika kurir sudah berangkat atau cucian sudah masuk mesin cuci, sistem akan mengunci data ini secara otomatis.</p>
                            </div>
                            <div class="flex gap-4 items-start">
                                <span class="text-amber-500 text-xl leading-none mt-0.5">•</span>
                                <p>Perubahan jenis layanan atau berat cucian akan <span class="font-bold text-white">mempengaruhi total tagihan akhir</span> Anda.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-xl border border-white rounded-[2.5rem] p-8 sm:p-10 shadow-xl shadow-slate-200/50 text-center relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full blur-3xl -mr-10 -mt-10"></div>
                        <h4 class="text-slate-400 font-bold uppercase tracking-widest text-xs mb-2">Mengedit Pesanan</h4>
                        <h3 class="text-4xl font-black text-blue-600 mb-6 font-mono tracking-wider">{{ $order->nomor_resi }}</h3>

                        <p class="text-sm text-slate-500 font-medium leading-relaxed mb-6">Pastikan data yang Anda perbarui sudah benar sebelum menyimpannya kembali ke dalam sistem.</p>

                        <a href="{{ route('order.history') }}" class="inline-flex items-center justify-center w-full bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold py-3.5 rounded-xl transition-all">
                            Batalkan Perubahan
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
