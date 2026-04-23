<x-app-layout>
    <x-slot name="header">
        Manajemen Pelanggan (CRM)
    </x-slot>

    <div class="p-4 sm:p-8 pb-28 lg:pb-12 relative min-h-screen overflow-x-hidden">

        <div
            class="absolute top-0 right-0 w-[30rem] h-[30rem] bg-indigo-200/30 rounded-full blur-[100px] -z-10 pointer-events-none">
        </div>
        <div
            class="absolute bottom-20 left-0 w-[20rem] h-[20rem] bg-purple-100/40 rounded-full blur-[80px] -z-10 pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-6">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight mb-2">Customer Insights</h2>
                    <p class="text-sm sm:text-base text-slate-500 font-medium">Kenali pelanggan Anda, pantau loyalitas
                        mereka, dan temukan pelanggan VIP Anda.</p>
                </div>

                <button onclick="window.print()"
                    class="w-full md:w-auto flex items-center justify-center gap-2 bg-white text-slate-600 hover:text-indigo-600 border border-slate-200 hover:border-indigo-200 px-5 py-3 rounded-xl font-bold shadow-sm transition-all group print:hidden">
                    <svg class="w-5 h-5 group-hover:-translate-y-1 transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                        </path>
                    </svg>
                    Cetak Laporan
                </button>
            </div>

            <div
                class="bg-white/90 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/40 border border-white overflow-hidden">

                <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center text-xl shadow-inner">
                            👥</div>
                        <h3 class="text-xl font-black text-slate-800">Daftar Member SmartLaundry</h3>
                    </div>
                </div>

                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-white border-b border-slate-100">
                                <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Profil
                                    Pelanggan</th>
                                <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">
                                    Bergabung Sejak</th>
                                <th
                                    class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-center">
                                    Total Cucian</th>
                                <th
                                    class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-right">
                                    Total Transaksi (LTV)</th>
                                <th
                                    class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-center">
                                    Status Member</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">

                            @forelse($customers ?? [] as $customer)
                                @php
                                    /** @var \App\Models\User $customer */
                                @endphp
                                <tr class="hover:bg-slate-50/50 transition-colors group">

                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-12 h-12 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 text-white flex items-center justify-center font-black shadow-md flex-shrink-0 text-lg">
                                                {{ substr($customer->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <h4 class="font-black text-slate-800 text-base mb-0.5">
                                                    {{ $customer->name }}</h4>
                                                <p class="text-xs font-medium text-slate-500 flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                    {{ $customer->email }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-8 py-5">
                                        <span
                                            class="font-bold text-slate-600">{{ $customer->created_at->format('d M Y') }}</span>
                                    </td>

                                    <td class="px-8 py-5 text-center">
                                        @php $orderCount = $customer->orders_count ?? 0; @endphp
                                        <div
                                            class="inline-flex items-center justify-center w-10 h-10 bg-blue-50 text-blue-600 rounded-xl font-black text-lg border border-blue-100">
                                            {{ $orderCount }}
                                        </div>
                                    </td>

                                    <td class="px-8 py-5 text-right">
                                        @php $totalSpent = $customer->total_spent ?? 0; @endphp
                                        <span class="font-black text-emerald-600 text-lg">Rp
                                            {{ number_format($totalSpent, 0, ',', '.') }}</span>
                                    </td>

                                    <td class="px-8 py-5 text-center">
                                        @if ($totalSpent > 1000000 || $orderCount > 10)
                                            <span
                                                class="bg-gradient-to-r from-amber-200 to-yellow-400 text-yellow-900 border border-yellow-300 px-3 py-1.5 rounded-lg text-xs font-black uppercase tracking-widest shadow-sm">
                                                👑 VIP
                                            </span>
                                        @elseif($orderCount > 3)
                                            <span
                                                class="bg-indigo-50 text-indigo-600 border border-indigo-200 px-3 py-1.5 rounded-lg text-xs font-black uppercase tracking-widest">
                                                ⭐ Regular
                                            </span>
                                        @else
                                            <span
                                                class="bg-slate-100 text-slate-500 border border-slate-200 px-3 py-1.5 rounded-lg text-xs font-black uppercase tracking-widest">
                                                🌱 Newbie
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-16 text-center">
                                        <div
                                            class="inline-flex items-center justify-center w-20 h-20 bg-slate-50 text-slate-300 rounded-full mb-4 text-4xl shadow-inner">
                                            👥
                                        </div>
                                        <h3 class="text-xl font-black text-slate-800 mb-2">Belum Ada Pelanggan</h3>
                                        <p class="text-slate-500 font-medium">Data pelanggan akan muncul secara otomatis
                                            ketika ada pengguna baru yang mendaftar.</p>
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
