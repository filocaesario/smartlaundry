<x-app-layout>
    <x-slot name="header">
        Lacak Pesanan
    </x-slot>

    <div class="p-4 sm:p-8 pb-24 lg:pb-12 relative min-h-[80vh]">

        <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[30rem] h-[30rem] bg-blue-500/10 rounded-full blur-[100px] -z-10 pointer-events-none"></div>

        <div class="max-w-4xl mx-auto space-y-8">

            <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-white p-8 sm:p-12 text-center relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-full blur-3xl -mr-10 -mt-10 transition duration-700 group-hover:bg-blue-100"></div>

                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 text-blue-600 rounded-2xl mb-6 shadow-inner transform -rotate-3 group-hover:rotate-0 transition-transform duration-500 text-3xl">
                    🔍
                </div>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight mb-3">Lacak Status Cucian</h2>
                <p class="text-slate-500 font-medium mb-8 max-w-lg mx-auto">Masukkan nomor resi Anda untuk melihat proses pengerjaan secara <span class="font-bold text-blue-600">real-time</span>.</p>

                <form action="{{ route('order.track') }}" method="GET" class="relative max-w-2xl mx-auto flex flex-col sm:flex-row gap-4">
                    <div class="relative flex-1 group/input">
                        <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-slate-400 group-focus-within/input:text-blue-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="resi" value="{{ request('resi') }}" placeholder="Contoh: LND-1234" required
                            class="w-full pl-14 pr-6 py-5 bg-slate-50/80 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 font-black text-lg tracking-[0.1em] text-slate-800 uppercase placeholder:font-normal placeholder:tracking-normal placeholder:text-slate-400 placeholder:normal-case shadow-sm outline-none text-center sm:text-left">
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-black text-lg px-10 py-5 rounded-2xl shadow-[0_10px_30px_-10px_rgba(37,99,235,0.6)] hover:shadow-[0_15px_40px_-10px_rgba(37,99,235,0.8)] hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
                        LACAK <span class="hidden sm:inline">SEKARANG</span>
                    </button>
                </form>
            </div>

            @if(request('resi'))
                @if(isset($order) && $order)

                    <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden transform animate-[fadeInUp_0.5s_ease-out]">

                        <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 p-8 sm:px-12 text-white relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-2xl -mr-20 -mt-20"></div>

                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 relative z-10">
                                <div>
                                    <p class="text-blue-300 font-black text-xs uppercase tracking-[0.2em] mb-2">Kode Resi Pesanan</p>
                                    <h3 class="text-4xl sm:text-5xl font-black tracking-wider">{{ $order->nomor_resi }}</h3>
                                </div>
                                <div class="text-left sm:text-right bg-white/10 backdrop-blur-md px-6 py-4 rounded-2xl border border-white/20">
                                    <p class="text-sm font-bold text-blue-100 mb-1">{{ $order->service->nama_layanan }}</p>
                                    <div class="flex items-center sm:justify-end gap-2">
                                        <span class="text-2xl font-black text-white">{{ $order->jumlah_berat }}</span>
                                        <span class="text-sm font-bold text-blue-200 uppercase">{{ $order->service->satuan }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-8 sm:p-14">
                            <div class="relative max-w-2xl mx-auto">

                                <div class="absolute left-8 sm:left-12 top-10 bottom-10 w-1.5 bg-slate-100 rounded-full"></div>

                                @php
                                    $progressHeight = '0%';
                                    if(in_array($order->status, ['dicuci'])) $progressHeight = '33%';
                                    if(in_array($order->status, ['disetrika'])) $progressHeight = '66%';
                                    if(in_array($order->status, ['selesai'])) $progressHeight = '100%';
                                @endphp
                                <div class="absolute left-8 sm:left-12 top-10 w-1.5 bg-gradient-to-b from-blue-500 to-indigo-600 rounded-full transition-all duration-1000 ease-out" style="height: {{ $progressHeight }}"></div>

                                <div class="space-y-12 relative">

                                    <div class="flex items-start gap-6 sm:gap-10 relative">
                                        @php $isActive = in_array($order->status, ['antre', 'dicuci', 'disetrika', 'selesai']); @endphp
                                        @php $isCurrent = $order->status == 'antre'; @endphp

                                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-black z-10 flex-shrink-0 transition-all duration-500
                                            {{ $isActive ? 'bg-blue-600 text-white shadow-[0_0_30px_rgba(37,99,235,0.4)]' : 'bg-slate-100 text-slate-400 border-2 border-white' }}
                                            {{ $isCurrent ? 'animate-pulse ring-4 ring-blue-500/30' : '' }}">
                                            ⏱️
                                        </div>

                                        <div class="pt-3">
                                            <h4 class="text-xl font-black {{ $isActive ? 'text-slate-800' : 'text-slate-400' }}">Pesanan Diterima</h4>
                                            <p class="text-sm font-medium mt-1.5 {{ $isActive ? 'text-slate-500' : 'text-slate-300' }}">Cucian Anda telah masuk ke dalam sistem dan sedang dalam antrean pengerjaan.</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-6 sm:gap-10 relative">
                                        @php $isActive = in_array($order->status, ['dicuci', 'disetrika', 'selesai']); @endphp
                                        @php $isCurrent = $order->status == 'dicuci'; @endphp

                                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-black z-10 flex-shrink-0 transition-all duration-500
                                            {{ $isActive ? 'bg-blue-600 text-white shadow-[0_0_30px_rgba(37,99,235,0.4)]' : 'bg-slate-100 text-slate-400 border-2 border-white' }}
                                            {{ $isCurrent ? 'animate-pulse ring-4 ring-blue-500/30' : '' }}">
                                            🫧
                                        </div>
                                        <div class="pt-3">
                                            <h4 class="text-xl font-black {{ $isActive ? 'text-slate-800' : 'text-slate-400' }}">Sedang Dicuci</h4>
                                            <p class="text-sm font-medium mt-1.5 {{ $isActive ? 'text-slate-500' : 'text-slate-300' }}">Pakaian Anda sedang dibersihkan dengan deterjen premium untuk mengangkat noda.</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-6 sm:gap-10 relative">
                                        @php $isActive = in_array($order->status, ['disetrika', 'selesai']); @endphp
                                        @php $isCurrent = $order->status == 'disetrika'; @endphp

                                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-black z-10 flex-shrink-0 transition-all duration-500
                                            {{ $isActive ? 'bg-blue-600 text-white shadow-[0_0_30px_rgba(37,99,235,0.4)]' : 'bg-slate-100 text-slate-400 border-2 border-white' }}
                                            {{ $isCurrent ? 'animate-pulse ring-4 ring-blue-500/30' : '' }}">
                                            ♨️
                                        </div>
                                        <div class="pt-3">
                                            <h4 class="text-xl font-black {{ $isActive ? 'text-slate-800' : 'text-slate-400' }}">Tahap Setrika</h4>
                                            <p class="text-sm font-medium mt-1.5 {{ $isActive ? 'text-slate-500' : 'text-slate-300' }}">Memasuki tahap pengeringan, penyetrikaan uap, dan pemberian pewangi pakaian.</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-6 sm:gap-10 relative">
                                        @php $isActive = $order->status == 'selesai'; @endphp

                                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-black z-10 flex-shrink-0 transition-all duration-500
                                            {{ $isActive ? 'bg-emerald-500 text-white shadow-[0_0_30px_rgba(16,185,129,0.5)]' : 'bg-slate-100 text-slate-400 border-2 border-white' }}
                                            {{ $isActive ? 'ring-4 ring-emerald-500/30' : '' }}">
                                            ✨
                                        </div>
                                        <div class="pt-3">
                                            <h4 class="text-xl font-black {{ $isActive ? 'text-emerald-600' : 'text-slate-400' }}">Siap Diambil</h4>
                                            <p class="text-sm font-medium mt-1.5 {{ $isActive ? 'text-emerald-700' : 'text-slate-300' }}">Hore! Pakaian Anda sudah bersih, wangi, rapi, dan siap untuk diambil / diantar.</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-50 p-6 sm:p-8 border-t border-slate-100 text-center flex flex-col sm:flex-row items-center justify-center gap-4">
                            <a href="{{ route('order.invoice', $order->id) }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-blue-100 text-blue-700 hover:bg-blue-600 hover:text-white font-black px-8 py-4 rounded-xl transition-all duration-300 shadow-sm">
                                🧾 Buka Struk Digital
                            </a>
                            <a href="https://wa.me/6281234567890" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-white text-slate-600 hover:bg-slate-100 border border-slate-200 font-bold px-8 py-4 rounded-xl transition-all duration-300 shadow-sm">
                                💬 Hubungi Admin
                            </a>
                        </div>
                    </div>

                @else
                    <div class="bg-white/80 backdrop-blur-xl border border-white rounded-[2.5rem] p-12 text-center shadow-xl shadow-rose-100/50 max-w-2xl mx-auto transform animate-[fadeInUp_0.5s_ease-out]">
                        <div class="w-24 h-24 bg-rose-50 text-rose-500 rounded-[2rem] flex items-center justify-center text-5xl mx-auto mb-6 shadow-inner border border-rose-100 transform -rotate-6">
                            🤷‍♂️
                        </div>
                        <h3 class="text-3xl font-black text-slate-800 mb-3">Oops! Resi Tidak Ditemukan</h3>
                        <p class="text-slate-500 font-medium text-lg mb-8 leading-relaxed">Kami tidak dapat menemukan data untuk resi <span class="font-bold text-rose-600 bg-rose-50 px-2 py-1 rounded-md">{{ request('resi') }}</span>. Mohon periksa kembali nomor resi yang Anda masukkan.</p>

                        <a href="{{ route('order.history') }}" class="inline-flex items-center justify-center gap-2 bg-slate-900 text-white font-bold px-8 py-4 rounded-2xl hover:bg-slate-800 transition-all shadow-lg hover:-translate-y-1">
                            Lihat Riwayat Pesanan Saya
                        </a>
                    </div>
                @endif
            @endif

        </div>
    </div>

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-app-layout>
