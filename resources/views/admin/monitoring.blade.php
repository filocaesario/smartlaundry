<x-app-layout>
    <x-slot name="header">
        Monitoring Pesanan
    </x-slot>

    <div class="p-4 sm:p-8 pb-28 lg:pb-12 relative min-h-screen overflow-x-hidden">

        <div class="absolute top-0 right-0 w-[30rem] h-[30rem] bg-slate-200/50 rounded-full blur-[100px] -z-10 pointer-events-none"></div>
        <div class="absolute bottom-20 left-0 w-[20rem] h-[20rem] bg-blue-100/30 rounded-full blur-[80px] -z-10 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-slate-800 text-white rounded-lg text-xs font-black tracking-widest uppercase mb-3 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Live Monitor
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-black text-slate-800 tracking-tight mb-2">Pusat Kendali Pesanan</h2>
                    <p class="text-sm sm:text-base text-slate-500 font-medium">Kelola status pengerjaan, proses pembayaran kasir, dan pantau seluruh aktivitas laundry.</p>
                </div>

                <button onclick="window.location.reload()" class="w-full md:w-auto flex items-center justify-center gap-2 bg-white text-slate-600 hover:text-blue-600 border border-slate-200 hover:border-blue-200 px-5 py-3 rounded-xl font-bold shadow-sm transition-all group">
                    <svg class="w-5 h-5 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Refresh Data
                </button>
            </div>

            @if(session('success'))
                <div class="mb-8 bg-emerald-50/80 backdrop-blur-md border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl font-bold flex items-center gap-4 shadow-lg shadow-emerald-100/50 animate-[fadeInDown_0.5s_ease-out]">
                    <div class="w-8 h-8 bg-emerald-500 text-white rounded-xl flex items-center justify-center text-xl flex-shrink-0 shadow-inner">✓</div>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/90 backdrop-blur-xl rounded-[2rem] shadow-2xl shadow-slate-200/40 border border-white overflow-hidden">

                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest w-1/4">Info Pelanggan</th>
                                <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest w-1/4">Layanan & Harga</th>
                                <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-center">Status Pengerjaan</th>
                                <th class="px-6 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-center">Aksi Administrator</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse($orders as $order)
                                <tr class="hover:bg-slate-50/50 transition-colors group">

                                    <td class="px-6 py-5 align-top">
                                        <div class="flex items-start gap-4">
                                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 text-blue-600 flex items-center justify-center font-black shadow-sm flex-shrink-0">
                                                {{ substr($order->nama_pelanggan, 0, 1) }}
                                            </div>
                                            <div>
                                                <h4 class="font-black text-slate-800 text-base mb-0.5">{{ $order->nama_pelanggan }}</h4>
                                                <div class="flex items-center gap-2 mb-2">
                                                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-md text-[10px] font-black tracking-widest">{{ $order->nomor_resi }}</span>
                                                    <span class="text-xs font-bold text-slate-400">{{ $order->created_at->format('d M, H:i') }}</span>
                                                </div>
                                                <p class="text-xs font-medium text-slate-500 truncate max-w-[200px]" title="{{ $order->alamat }}">📍 {{ $order->alamat }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5 align-top">
                                        <h4 class="font-bold text-slate-800 text-sm mb-1">{{ $order->service->nama_layanan }}</h4>
                                        <p class="text-xs font-medium text-slate-500 mb-2">Berat: <span class="font-bold text-slate-700">{{ $order->jumlah_berat }} {{ $order->service->satuan }}</span></p>

                                        <div class="flex flex-col items-start gap-1">
                                            <span class="font-black text-lg text-blue-600 leading-none">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>

                                            @if($order->pembayaran_status == 'lunas')
                                                <span class="bg-emerald-50 text-emerald-600 border border-emerald-200 px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-widest mt-1">✓ LUNAS</span>
                                            @else
                                                <span class="bg-rose-50 text-rose-600 border border-rose-200 px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-widest mt-1">⏳ BELUM BAYAR</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-5 align-top">
                                        <div class="flex justify-center">
                                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="bg-slate-50 border border-slate-200 p-2 rounded-xl flex flex-col sm:flex-row items-center gap-2 shadow-sm focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-500/20 transition-all">
                                                @csrf
                                                @method('PUT')

                                                <select name="status" class="bg-transparent border-none text-xs font-black text-slate-700 focus:ring-0 py-1 pl-2 pr-8 cursor-pointer uppercase tracking-wider">
                                                    <option value="antre" {{ $order->status == 'antre' ? 'selected' : '' }}>⏱️ Antre</option>
                                                    <option value="dicuci" {{ $order->status == 'dicuci' ? 'selected' : '' }}>🫧 Dicuci</option>
                                                    <option value="disetrika" {{ $order->status == 'disetrika' ? 'selected' : '' }}>♨️ Setrika</option>
                                                    <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>✨ Selesai</option>
                                                </select>

                                                <button type="submit" class="w-full sm:w-auto bg-slate-800 text-white hover:bg-blue-600 p-2 rounded-lg transition-colors shadow-sm flex items-center justify-center" title="Simpan Perubahan Status">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5 align-top">
                                        <div class="flex flex-col sm:flex-row items-center justify-center gap-2">

                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="w-full sm:w-auto flex items-center justify-center gap-1.5 bg-blue-50 text-blue-700 hover:bg-blue-600 hover:text-white border border-blue-100 font-bold px-4 py-2.5 rounded-xl text-xs transition-all shadow-sm">
                                                <span>💳</span> Kasir
                                            </a>

                                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="w-full sm:w-auto">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Peringatan: Hapus pesanan ini secara permanen dari database?')" class="w-full flex items-center justify-center gap-1.5 bg-white text-rose-500 hover:bg-rose-500 hover:text-white border border-rose-200 font-bold px-4 py-2.5 rounded-xl text-xs transition-all shadow-sm">
                                                    <span>🗑️</span> Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center">
                                        <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-50 text-slate-300 rounded-full mb-4 text-4xl shadow-inner">
                                            📊
                                        </div>
                                        <h3 class="text-xl font-black text-slate-800 mb-2">Data Kosong</h3>
                                        <p class="text-slate-500 font-medium">Belum ada pesanan laundry yang masuk ke sistem.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f8fafc; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: #94a3b8; }
    </style>
</x-app-layout>
