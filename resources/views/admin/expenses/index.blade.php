<x-app-layout>
    <x-slot name="header">
        Buku Kas & Pengeluaran
    </x-slot>

    <div class="p-4 sm:p-8 pb-28 lg:pb-12 relative min-h-screen overflow-x-hidden">

        <div
            class="absolute top-0 right-0 w-[30rem] h-[30rem] bg-emerald-200/30 rounded-full blur-[100px] -z-10 pointer-events-none">
        </div>
        <div
            class="absolute bottom-20 left-0 w-[20rem] h-[20rem] bg-rose-100/40 rounded-full blur-[80px] -z-10 pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-6">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight mb-2">Laporan Keuangan</h2>
                    <p class="text-sm sm:text-base text-slate-500 font-medium">Pantau arus kas, catat biaya operasional,
                        dan lihat laba bersih bulan ini.</p>
                </div>

                <a href="{{ route('admin.expenses.create') }}"
                    class="w-full md:w-auto group relative inline-flex items-center justify-center gap-3 bg-slate-900 text-white font-black px-6 py-3.5 rounded-2xl shadow-xl shadow-slate-900/20 hover:shadow-2xl hover:shadow-slate-900/30 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                    <div
                        class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]">
                    </div>
                    <span class="text-rose-400 text-xl leading-none">-</span> Catat Pengeluaran
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                <div
                    class="bg-white/90 backdrop-blur-xl rounded-[2rem] p-6 shadow-lg shadow-slate-200/40 border border-white flex items-center gap-5 transform transition-transform hover:-translate-y-1">
                    <div
                        class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-3xl font-black shadow-inner">
                        💰
                    </div>
                    <div>
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Pendapatan Kotor</p>
                        <h3 class="text-2xl font-black text-slate-800">Rp
                            {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                    </div>
                </div>

                <div
                    class="bg-white/90 backdrop-blur-xl rounded-[2rem] p-6 shadow-lg shadow-slate-200/40 border border-white flex items-center gap-5 transform transition-transform hover:-translate-y-1">
                    <div
                        class="w-16 h-16 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-3xl font-black shadow-inner">
                        📉
                    </div>
                    <div>
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Pengeluaran
                        </p>
                        <h3 class="text-2xl font-black text-slate-800">Rp
                            {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
                    </div>
                </div>

                <div
                    class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-[2rem] p-6 shadow-xl shadow-slate-900/20 border border-slate-700 flex items-center gap-5 transform transition-transform hover:-translate-y-1 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/20 rounded-full blur-2xl -mr-10 -mt-10">
                    </div>
                    <div
                        class="w-16 h-16 rounded-2xl bg-white/10 text-emerald-400 flex items-center justify-center text-3xl font-black shadow-inner border border-white/10 relative z-10">
                        📈
                    </div>
                    <div class="relative z-10">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Laba Bersih (Profit)
                        </p>
                        <h3 class="text-2xl font-black text-emerald-400">Rp
                            {{ number_format($labaBersih, 0, ',', '.') }}</h3>
                    </div>
                </div>

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

            <div
                class="bg-white/90 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/40 border border-white overflow-hidden">

                <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="text-xl font-black text-slate-800">Catatan Pengeluaran Terbaru</h3>
                    <div
                        class="bg-white border border-slate-200 px-4 py-2 rounded-xl text-sm font-bold text-slate-600 shadow-sm">
                        Bulan Ini (Mei 2026)
                    </div>
                </div>

                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-white border-b border-slate-100">
                                <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">
                                    Tanggal</th>
                                <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">
                                    Kategori</th>
                                <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">
                                    Keterangan</th>
                                <th
                                    class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-right">
                                    Nominal</th>
                                <th
                                    class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">

                            @forelse($expenses ?? [] as $expense)
                                @php
                                    /** @var \App\Models\Expense $expense */
                                @endphp
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-8 py-5">
                                        <span class="font-bold text-slate-700">{{ \Carbon\Carbon::parse($expense->tanggal)->format('d M Y') }}</span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span
                                            class="bg-indigo-50 text-indigo-600 border border-indigo-100 px-3 py-1 rounded-lg text-xs font-black uppercase tracking-widest">
                                            {{ $expense->kategori }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <p class="font-medium text-slate-500 truncate max-w-[250px]">
                                            {{ $expense->keterangan }}</p>
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <span class="font-black text-rose-500 text-lg">- Rp
                                            {{ number_format($expense->jumlah, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex justify-center gap-2">
                                            <form action="{{ route('admin.expenses.destroy', $expense->id) }}"
                                                method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Hapus catatan pengeluaran ini?')"
                                                    class="p-2 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-colors shadow-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2.5"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-16 text-center">
                                        <div
                                            class="inline-flex items-center justify-center w-20 h-20 bg-slate-50 text-slate-300 rounded-full mb-4 text-4xl shadow-inner">
                                            📝
                                        </div>
                                        <h3 class="text-xl font-black text-slate-800 mb-2">Buku Kas Bersih</h3>
                                        <p class="text-slate-500 font-medium">Belum ada catatan pengeluaran yang
                                            dimasukkan bulan ini.</p>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
