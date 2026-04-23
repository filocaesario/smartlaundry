<x-app-layout>
    <x-slot name="header">
        Manajemen Kode Promo
    </x-slot>

    <div class="p-4 sm:p-8 pb-28 lg:pb-12 relative min-h-screen overflow-x-hidden">

        <div
            class="absolute top-0 right-0 w-[30rem] h-[30rem] bg-amber-200/30 rounded-full blur-[100px] -z-10 pointer-events-none">
        </div>
        <div
            class="absolute bottom-20 left-0 w-[20rem] h-[20rem] bg-orange-100/40 rounded-full blur-[80px] -z-10 pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-6">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight mb-2">Voucher & Diskon</h2>
                    <p class="text-sm sm:text-base text-slate-500 font-medium">Buat kode promo menarik untuk meningkatkan
                        penjualan dan loyalitas pelanggan.</p>
                </div>

                <a href="{{ route('admin.promos.create') }}"
                    class="w-full md:w-auto group relative inline-flex items-center justify-center gap-3 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-black px-6 py-3.5 rounded-2xl shadow-xl shadow-amber-500/30 hover:shadow-2xl hover:shadow-amber-500/40 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                    <div
                        class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]">
                    </div>
                    <span class="text-white text-xl leading-none">+</span> Buat Voucher Baru
                </a>
            </div>

            @if (session('success'))
                <div
                    class="mb-8 bg-emerald-50/80 backdrop-blur-md border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl font-bold flex items-center gap-4 shadow-lg shadow-emerald-100/50 animate-[fadeInDown_0.5s_ease-out]">
                    <div
                        class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center text-xl flex-shrink-0 shadow-inner">
                        ✓</div>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 sm:gap-8">

                @forelse($promos ?? [] as $promo)
                    @php
                        /** @var \App\Models\Promo $promo */
                    @endphp
                    <div
                        class="bg-white/90 backdrop-blur-xl rounded-[2rem] shadow-xl shadow-slate-200/40 border border-white hover:border-amber-200 transition-all duration-300 transform hover:-translate-y-2 group relative flex overflow-hidden">

                        <div class="p-6 sm:p-8 flex-1 relative z-10 border-r-2 border-dashed border-slate-200">
                            <div
                                class="absolute -top-3 -right-3 w-6 h-6 bg-slate-50/50 rounded-full border-b border-l border-slate-200 shadow-inner">
                            </div>
                            <div
                                class="absolute -bottom-3 -right-3 w-6 h-6 bg-slate-50/50 rounded-full border-t border-l border-slate-200 shadow-inner">
                            </div>

                            <div class="flex items-center gap-2 mb-4">
                                <span
                                    class="bg-amber-100 text-amber-700 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm">
                                    Potongan {{ $promo->diskon_persen }}%
                                </span>
                                @if ($promo->is_active)
                                    <span class="text-xs font-bold text-emerald-500 flex items-center gap-1"><span
                                            class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                        Aktif</span>
                                @else
                                    <span class="text-xs font-bold text-rose-500 flex items-center gap-1"><span
                                            class="w-2 h-2 bg-rose-500 rounded-full"></span> Nonaktif</span>
                                @endif
                            </div>

                            <h3 class="text-3xl font-black text-slate-800 tracking-widest font-mono mb-1">
                                {{ $promo->kode }}</h3>
                            <p class="text-xs font-medium text-slate-500 mb-6">
                                {{ $promo->deskripsi ?? 'Voucher diskon spesial untuk pelanggan.' }}</p>

                            <div
                                class="flex items-center gap-4 text-sm font-bold text-slate-600 bg-slate-50 p-3 rounded-xl">
                                <div>
                                    <p class="text-[10px] text-slate-400 uppercase tracking-widest mb-0.5">Sisa Kuota
                                    </p>
                                    <span class="text-indigo-600">{{ $promo->kuota }}x Pemakaian</span>
                                </div>
                            </div>
                        </div>

                        <div
                            class="w-20 bg-amber-50/50 flex flex-col justify-center items-center gap-3 p-3 relative z-10">
                            <form action="{{ route('admin.promos.destroy', $promo->id) }}" method="POST"
                                class="w-full h-full flex-1">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus voucher ini?')"
                                    class="w-full h-full flex flex-col items-center justify-center gap-1 bg-white text-rose-400 hover:bg-rose-500 hover:text-white rounded-xl transition-all shadow-sm border border-rose-100 text-xs font-bold group/btn">
                                    <svg class="w-5 h-5 group-hover/btn:scale-110 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <div
                            class="absolute -right-10 -bottom-10 text-9xl opacity-5 pointer-events-none transform -rotate-12">
                            🎟️</div>
                    </div>
                @empty
                    <div
                        class="col-span-full bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-16 text-center border border-white shadow-2xl shadow-slate-200/40">
                        <div class="relative w-24 h-24 mx-auto mb-6">
                            <div class="absolute inset-0 bg-amber-100 rounded-full animate-ping opacity-50"></div>
                            <div
                                class="relative bg-gradient-to-br from-amber-100 to-orange-100 rounded-full w-full h-full flex items-center justify-center text-4xl shadow-inner border border-white">
                                🎟️
                            </div>
                        </div>
                        <h3 class="text-2xl font-black text-slate-800 mb-3">Belum Ada Voucher</h3>
                        <p class="text-slate-500 font-medium mb-8 max-w-md mx-auto">Berikan kejutan untuk pelanggan Anda
                            dengan membuat kode promo diskon pertama Anda hari ini!</p>
                        <a href="{{ route('admin.promos.create') }}"
                            class="inline-flex items-center gap-3 bg-slate-900 text-white font-black px-8 py-4 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            + Buat Kode Promo Baru
                        </a>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
