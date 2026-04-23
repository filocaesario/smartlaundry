<x-app-layout>
    <x-slot name="header">
        Riwayat & Struk
    </x-slot>

    <div class="p-4 sm:p-8 pb-28 lg:pb-12 relative min-h-screen overflow-x-hidden">

        <div class="absolute top-0 right-0 w-[20rem] sm:w-[40rem] h-[20rem] sm:h-[40rem] bg-blue-100/40 rounded-full blur-[80px] sm:blur-[120px] -z-10 pointer-events-none"></div>
        <div class="absolute bottom-20 left-0 w-[15rem] sm:w-[30rem] h-[15rem] sm:h-[30rem] bg-indigo-100/40 rounded-full blur-[60px] sm:blur-[100px] -z-10 pointer-events-none"></div>

        <div class="max-w-6xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4 sm:gap-6">
                <div>
                    <h2 class="text-2xl sm:text-4xl font-black text-slate-800 tracking-tight mb-2">Riwayat Pesanan</h2>
                    <p class="text-sm sm:text-base text-slate-500 font-medium">Pantau status, unduh struk digital, dan kelola pesanan Anda.</p>
                </div>
                <a href="{{ route('order.index') }}" class="w-full md:w-auto group relative inline-flex items-center justify-center gap-2 sm:gap-3 bg-slate-900 text-white font-black px-6 py-3.5 rounded-2xl shadow-xl shadow-slate-900/20 hover:shadow-2xl hover:shadow-slate-900/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
                    <span class="text-blue-400 text-xl leading-none">+</span> Buat Pesanan Baru
                </a>
            </div>

            @if(session('success'))
                <div class="mb-8 bg-emerald-50/80 backdrop-blur-md border border-emerald-200 text-emerald-800 px-5 sm:px-6 py-4 rounded-2xl font-bold flex items-center gap-3 sm:gap-4 shadow-lg shadow-emerald-100/50 animate-[fadeInDown_0.5s_ease-out] text-sm sm:text-base">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center text-lg sm:text-xl flex-shrink-0 shadow-inner">✓</div>
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-6 sm:space-y-8">
                @forelse($orders as $order)
                    <div class="bg-white/90 backdrop-blur-xl rounded-[1.5rem] sm:rounded-[2rem] shadow-lg sm:shadow-xl shadow-slate-200/40 border border-white hover:border-blue-100 transition-all duration-300 transform hover:-translate-y-1 group flex flex-col lg:flex-row overflow-hidden relative">

                        @php
                            $statusColor = 'bg-slate-300';
                            if($order->status == 'antre') $statusColor = 'bg-slate-400';
                            if($order->status == 'dicuci') $statusColor = 'bg-blue-500';
                            if($order->status == 'disetrika') $statusColor = 'bg-indigo-500';
                            if($order->status == 'selesai') $statusColor = 'bg-emerald-500';
                        @endphp
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 sm:w-2 {{ $statusColor }} transition-colors duration-300"></div>

                        <div class="flex-1 p-5 sm:p-8 lg:pr-10 lg:pl-10 ml-1.5 sm:ml-2">

                            <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
                                <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto justify-between sm:justify-start">
                                    <div class="bg-blue-50 text-blue-700 px-3 sm:px-4 py-1.5 rounded-xl font-black text-xs sm:text-sm tracking-[0.15em] border border-blue-100/50 shadow-sm">
                                        {{ $order->nomor_resi }}
                                    </div>
                                    <span class="text-slate-400 text-xs sm:text-sm font-bold flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </span>
                                </div>

                                <div class="flex flex-wrap gap-2 mt-1 sm:mt-0">
                                    @if($order->status == 'antre')
                                        <span class="bg-slate-100 text-slate-600 px-2.5 sm:px-3 py-1 rounded-lg text-[10px] sm:text-xs font-black uppercase tracking-wider flex items-center gap-1.5"><span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-slate-400 animate-pulse"></span> Antre</span>
                                    @elseif($order->status == 'dicuci')
                                        <span class="bg-blue-100 text-blue-700 px-2.5 sm:px-3 py-1 rounded-lg text-[10px] sm:text-xs font-black uppercase tracking-wider flex items-center gap-1.5"><span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-blue-500 animate-pulse"></span> Dicuci</span>
                                    @elseif($order->status == 'disetrika')
                                        <span class="bg-indigo-100 text-indigo-700 px-2.5 sm:px-3 py-1 rounded-lg text-[10px] sm:text-xs font-black uppercase tracking-wider flex items-center gap-1.5"><span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-indigo-500 animate-pulse"></span> Disetrika</span>
                                    @else
                                        <span class="bg-emerald-100 text-emerald-700 px-2.5 sm:px-3 py-1 rounded-lg text-[10px] sm:text-xs font-black uppercase tracking-wider flex items-center gap-1.5"><span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-emerald-500"></span> Selesai</span>
                                    @endif

                                    @if($order->pembayaran_status == 'lunas')
                                        <span class="bg-emerald-50 text-emerald-600 border border-emerald-200 px-2.5 sm:px-3 py-1 rounded-lg text-[10px] sm:text-xs font-black uppercase tracking-wider">Lunas</span>
                                    @else
                                        <span class="bg-rose-50 text-rose-600 border border-rose-200 px-2.5 sm:px-3 py-1 rounded-lg text-[10px] sm:text-xs font-black uppercase tracking-wider">Belum Bayar</span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-between items-start sm:items-center">
                                <div>
                                    <h3 class="text-xl sm:text-2xl font-black text-slate-800 mb-1 leading-tight">{{ $order->service->nama_layanan }}</h3>
                                    <p class="text-sm sm:text-base text-slate-500 font-medium">
                                        Total Berat: <span class="font-bold text-slate-700">{{ $order->jumlah_berat }} {{ $order->service->satuan }}</span>
                                    </p>
                                </div>
                                <div class="w-full sm:w-auto bg-slate-50/80 border border-slate-100 px-4 sm:px-5 py-3 rounded-2xl text-left sm:text-right">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Total Tagihan</p>
                                    <p class="text-xl sm:text-2xl font-black text-blue-600 leading-none">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-t-2 lg:border-t-0 lg:border-l-2 border-dashed border-slate-200 mx-5 lg:mx-0 lg:my-5"></div>

                        <div class="p-5 sm:p-8 lg:w-72 bg-slate-50/50 flex flex-col justify-center gap-3">

                            <a href="{{ route('order.track', ['resi' => $order->nomor_resi]) }}" class="w-full flex items-center justify-center gap-2 bg-indigo-50 text-indigo-700 hover:bg-indigo-600 hover:text-white border border-indigo-100 font-bold px-4 py-2.5 sm:py-3 rounded-xl text-sm transition-all shadow-sm group/btn">
                                <span class="group-hover/btn:animate-bounce">📍</span> Lacak Pesanan
                            </a>

                            <a href="{{ route('order.invoice', $order->id) }}" class="w-full flex items-center justify-center gap-2 bg-blue-50 text-blue-700 hover:bg-blue-600 hover:text-white border border-blue-100 font-bold px-4 py-2.5 sm:py-3 rounded-xl text-sm transition-all shadow-sm">
                                🧾 Struk Digital
                            </a>

                            <div class="grid grid-cols-2 gap-3 w-full pt-2 border-t border-slate-200/60 mt-1">

                                @if($order->status == 'antre')
                                    <a href="{{ route('order.edit', $order->id) }}" class="flex items-center justify-center gap-1 bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white border border-amber-100 font-bold px-2 py-2 sm:py-2.5 rounded-xl text-[11px] sm:text-xs transition-all shadow-sm">
                                        ✏️ Edit
                                    </a>

                                    <form action="{{ route('order.destroy', $order->id) }}" method="POST" class="w-full">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')" class="w-full flex items-center justify-center gap-1 bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white border border-rose-100 font-bold px-2 py-2 sm:py-2.5 rounded-xl text-[11px] sm:text-xs transition-all shadow-sm">
                                            ❌ Batal
                                        </button>
                                    </form>

                                @elseif($order->status == 'selesai')
                                    <form action="{{ route('order.destroy', $order->id) }}" method="POST" class="col-span-2 w-full">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus pesanan ini dari riwayat Anda?')" class="w-full flex items-center justify-center gap-2 bg-slate-100 text-slate-500 hover:bg-rose-500 hover:text-white border border-slate-200 hover:border-rose-500 font-bold px-4 py-2.5 rounded-xl text-xs transition-all shadow-sm">
                                            🗑️ Bersihkan Riwayat
                                        </button>
                                    </form>
                                @endif

                            </div>

                        </div>
                    </div>

                @empty
                    <div class="bg-white/80 backdrop-blur-xl rounded-[2rem] p-8 sm:p-16 text-center border border-white shadow-2xl shadow-slate-200/40">
                        <div class="relative w-24 h-24 sm:w-32 sm:h-32 mx-auto mb-6">
                            <div class="absolute inset-0 bg-blue-100 rounded-full animate-ping opacity-50"></div>
                            <div class="relative bg-gradient-to-br from-blue-50 to-indigo-100 rounded-full w-full h-full flex items-center justify-center text-4xl sm:text-5xl shadow-inner border border-white">
                                📭
                            </div>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-black text-slate-800 mb-3">Belum Ada Riwayat Pesanan</h3>
                        <p class="text-sm sm:text-base text-slate-500 font-medium mb-8 max-w-md mx-auto">Anda belum pernah menggunakan layanan kami. Yuk, mulai percayakan cucian Anda pada SmartLaundry hari ini!</p>
                        <a href="{{ route('order.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-black px-8 py-4 rounded-2xl shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 hover:-translate-y-1 transition-all duration-300">
                            🚀 Buat Pesanan Pertama
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
