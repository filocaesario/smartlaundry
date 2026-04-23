<x-app-layout>
    <x-slot name="header">
        Manajemen Layanan Premium
    </x-slot>

    <div class="p-4 sm:p-8 pb-28 lg:pb-12 relative min-h-screen overflow-x-hidden">

        <div class="absolute top-0 right-0 w-[40rem] h-[40rem] bg-blue-100/50 rounded-full blur-[120px] -z-10 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[30rem] h-[30rem] bg-indigo-100/40 rounded-full blur-[100px] -z-10 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
                <div>
                    <h2 class="text-4xl font-black text-slate-800 tracking-tight mb-2">Daftar Layanan</h2>
                    <p class="text-slate-500 font-medium">Kelola kategori jasa laundry dan atur harga terbaik untuk pelanggan Anda.</p>
                </div>

                <a href="{{ route('admin.services.create') }}" class="group relative inline-flex items-center justify-center gap-3 bg-slate-900 text-white font-black px-8 py-4 rounded-2xl shadow-2xl shadow-slate-900/20 hover:shadow-slate-900/40 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
                    <span class="text-2xl leading-none">+</span> Tambah Layanan Baru
                </a>
            </div>

            @if(session('success'))
                <div class="mb-8 bg-emerald-50/80 backdrop-blur-md border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl font-bold flex items-center gap-4 shadow-lg shadow-emerald-100/50 animate-[fadeInDown_0.5s_ease-out]">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center text-xl flex-shrink-0 shadow-inner">✓</div>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services as $service)
                    @php
                        // Logika Cerdas Pemilihan Ikon Berdasarkan Nama
                        $name = strtolower($service->nama_layanan);
                        $icon = '✨'; // Default
                        $bgColor = 'from-blue-500 to-indigo-600'; // Default Color

                        if (str_contains($name, 'sepatu')) {
                            $icon = '👟';
                            $bgColor = 'from-amber-400 to-orange-500';
                        } elseif (str_contains($name, 'baju') || str_contains($name, 'pakaian') || str_contains($name, 'kaos')) {
                            $icon = '👕';
                            $bgColor = 'from-blue-500 to-indigo-600';
                        } elseif (str_contains($name, 'selimut') || str_contains($name, 'bedcover') || str_contains($name, 'sprei')) {
                            $icon = '🛌';
                            $bgColor = 'from-purple-500 to-pink-600';
                        } elseif (str_contains($name, 'karpet')) {
                            $icon = '🧹';
                            $bgColor = 'from-emerald-500 to-teal-600';
                        } elseif (str_contains($name, 'helm')) {
                            $icon = '🪖';
                            $bgColor = 'from-slate-600 to-slate-800';
                        } elseif (str_contains($name, 'tas')) {
                            $icon = '🎒';
                            $bgColor = 'from-rose-500 to-red-600';
                        } elseif (str_contains($name, 'setrika')) {
                            $icon = '👔';
                            $bgColor = 'from-cyan-500 to-blue-600';
                        }
                    @endphp

                    <div class="group bg-white/90 backdrop-blur-xl rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-white hover:border-blue-200 transition-all duration-500 flex flex-col justify-between relative overflow-hidden">

                        <div class="absolute -right-20 -top-20 w-40 h-40 bg-blue-400/10 rounded-full blur-3xl group-hover:bg-blue-400/20 transition-all duration-500"></div>

                        <div>
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br {{ $bgColor }} text-white flex items-center justify-center text-3xl shadow-lg shadow-blue-200 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 mb-6">
                                {{ $icon }}
                            </div>

                            <h3 class="text-2xl font-black text-slate-800 mb-2 leading-tight">{{ $service->nama_layanan }}</h3>

                            <div class="flex items-center gap-2 mb-6">
                                <span class="bg-slate-100 text-slate-500 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest border border-slate-200">
                                    {{ $service->satuan == 'kg' ? 'Berdasarkan Berat' : 'Satuan / Pcs' }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-4 flex flex-col gap-6">
                            <div class="flex items-end justify-between border-t border-slate-100 pt-6">
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-tighter mb-1">Harga Layanan</p>
                                    <h4 class="text-2xl font-black text-blue-600 tracking-tight">
                                        Rp {{ number_format($service->harga, 0, ',', '.') }}<span class="text-sm text-slate-400">/{{ $service->satuan }}</span>
                                    </h4>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="flex-1 flex items-center justify-center gap-2 bg-slate-50 text-slate-600 hover:bg-indigo-600 hover:text-white px-4 py-3.5 rounded-xl font-bold transition-all duration-300 group/btn shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    Edit
                                </a>

                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="flex-shrink-0">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus layanan ini secara permanen?')" class="w-12 h-12 flex items-center justify-center bg-slate-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all duration-300 shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white/50 backdrop-blur-md rounded-[3rem] border-4 border-dashed border-slate-200">
                        <span class="text-6xl mb-4 block">📦</span>
                        <h3 class="text-2xl font-black text-slate-800">Layanan Masih Kosong</h3>
                        <p class="text-slate-500 font-medium mb-8">Anda belum menambahkan jenis layanan laundry apapun.</p>
                        <a href="{{ route('admin.services.create') }}" class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-black shadow-xl shadow-blue-600/30">Mulai Tambah Sekarang</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
