<x-app-layout>
    <x-slot name="header">
        Pusat Kendali Eksekutif
    </x-slot>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="p-4 sm:p-8 pb-28 lg:pb-12 relative min-h-screen overflow-x-hidden">

        <div class="absolute top-0 right-0 w-[40rem] h-[40rem] bg-blue-300/20 rounded-full blur-[120px] -z-10 pointer-events-none"></div>
        <div class="absolute bottom-20 left-0 w-[30rem] h-[30rem] bg-indigo-200/30 rounded-full blur-[100px] -z-10 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto space-y-8">

            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight mb-2">Selamat Datang, Komandan! 🚀</h2>
                    <p class="text-slate-500 font-medium mt-1">Pantau performa real-time dan akses arsip laporan keuangan Anda.</p>
                </div>

                <form action="{{ route('admin.laporan.cetak') }}" method="GET" target="_blank" class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">

                    <div class="flex items-center bg-white border border-slate-200 rounded-xl shadow-sm px-3 py-1.5 w-full sm:w-auto justify-between">
                        <select name="month" class="bg-transparent border-none outline-none focus:ring-0 font-bold text-slate-600 text-sm cursor-pointer pr-4">
                            @foreach(range(1, 12) as $m)
                                <option value="{{ $m }}" {{ now()->month == $m ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                </option>
                            @endforeach
                        </select>

                        <div class="w-px h-5 bg-slate-200 mx-2"></div>

                        <select name="year" class="bg-transparent border-none outline-none focus:ring-0 font-bold text-slate-600 text-sm cursor-pointer pr-4">
                            @foreach(range(now()->year, now()->year - 3) as $y)
                                <option value="{{ $y }}" {{ now()->year == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full sm:w-auto group relative inline-flex items-center justify-center gap-2 bg-white text-slate-700 font-bold px-6 py-3 rounded-xl shadow-sm border border-slate-200 hover:border-blue-500 hover:text-blue-600 transition-all duration-300 hover:-translate-y-0.5">
                        <svg class="w-5 h-5 group-hover:-translate-y-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Cetak Laporan
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white/90 backdrop-blur-xl rounded-[2rem] p-6 shadow-xl shadow-blue-200/40 border border-white flex flex-col justify-between hover:-translate-y-1 transition-transform">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl shadow-inner">💰</div>
                        <span class="bg-emerald-100 text-emerald-700 text-[10px] font-black px-2 py-1 rounded-lg uppercase tracking-wider">Bulan Ini</span>
                    </div>
                    <div>
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Pendapatan Kotor</p>
                        <h3 class="text-2xl font-black text-slate-800">Rp {{ number_format($omzet, 0, ',', '.') }}</h3>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur-xl rounded-[2rem] p-6 shadow-xl shadow-rose-200/40 border border-white flex flex-col justify-between hover:-translate-y-1 transition-transform">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-2xl shadow-inner">📉</div>
                    </div>
                    <div>
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Pengeluaran</p>
                        <h3 class="text-2xl font-black text-slate-800">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</h3>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-[2rem] p-6 shadow-2xl shadow-slate-900/30 border border-slate-700 flex flex-col justify-between hover:-translate-y-1 transition-transform relative overflow-hidden text-white">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/20 rounded-full blur-2xl"></div>
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div class="w-12 h-12 rounded-2xl bg-white/10 text-emerald-400 flex items-center justify-center text-2xl shadow-inner border border-white/10">📈</div>
                    </div>
                    <div class="relative z-10">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Laba Bersih (Profit)</p>
                        <h3 class="text-2xl font-black text-emerald-400">Rp {{ number_format($laba, 0, ',', '.') }}</h3>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur-xl rounded-[2rem] p-6 shadow-xl shadow-indigo-200/40 border border-white flex flex-col justify-between hover:-translate-y-1 transition-transform">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-2xl shadow-inner">🧺</div>
                    </div>
                    <div>
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Total Pesanan</p>
                        <h3 class="text-2xl font-black text-slate-800">{{ $totalPesanan }} <span class="text-sm font-bold text-slate-400">Cucian</span></h3>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white/90 backdrop-blur-xl rounded-[2.5rem] p-8 shadow-2xl shadow-slate-200/40 border border-white">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-xl font-black text-slate-800">Tren Pendapatan</h3>
                            <p class="text-sm font-medium text-slate-500">Omzet 7 hari terakhir</p>
                        </div>
                    </div>
                    <div class="relative h-[300px] w-full">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur-xl rounded-[2.5rem] p-8 shadow-2xl shadow-slate-200/40 border border-white flex flex-col">
                    <div class="mb-2">
                        <h3 class="text-xl font-black text-slate-800">Status Beban Kerja</h3>
                        <p class="text-sm font-medium text-slate-500">Rasio antrean vs selesai</p>
                    </div>
                    <div class="relative flex-1 flex justify-center items-center h-[250px] w-full mt-4">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="bg-white/90 backdrop-blur-xl rounded-[2.5rem] p-8 shadow-2xl shadow-slate-200/40 border border-white">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-black text-slate-800 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">⚡</span>
                        Live Orders (5 Terbaru)
                    </h3>
                    <a href="{{ route('admin.monitoring') }}" class="text-sm font-bold text-blue-600 hover:text-blue-700 bg-blue-50 px-4 py-2 rounded-xl transition-colors">Lihat Semua</a>
                </div>

                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left border-collapse">
                        <tbody>
                            @forelse($recentOrders ?? [] as $order)
                                @php /** @var \App\Models\Order $order */ @endphp
                                <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                                    <td class="py-4 pr-6">
                                        <p class="font-black text-slate-800">{{ $order->nomor_resi }}</p>
                                        <p class="text-xs font-bold text-slate-400">{{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</p>
                                    </td>
                                    <td class="py-4 px-6">
                                        <p class="font-bold text-slate-700">{{ $order->nama_pelanggan }}</p>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <p class="font-black text-blue-600">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-6 text-slate-400 font-medium">Belum ada pesanan masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div> </div> <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Setup Data Line Chart (Pendapatan)
            const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
            let gradientBlue = ctxRevenue.createLinearGradient(0, 0, 0, 400);
            gradientBlue.addColorStop(0, 'rgba(37, 99, 235, 0.2)');
            gradientBlue.addColorStop(1, 'rgba(37, 99, 235, 0)');

            new Chart(ctxRevenue, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartDates) !!},
                    datasets: [{
                        label: 'Pendapatan Harian (Rp)',
                        data: {!! json_encode($chartRevenues) !!},
                        borderColor: '#2563eb',
                        backgroundColor: gradientBlue,
                        borderWidth: 4,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#2563eb',
                        pointBorderWidth: 3,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f1f5f9', drawBorder: false },
                            ticks: { font: { family: 'Nunito', weight: 'bold' }, color: '#94a3b8' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { family: 'Nunito', weight: 'bold' }, color: '#94a3b8' }
                        }
                    }
                }
            });

            // 2. Setup Data Doughnut Chart (Status Pesanan)
            const ctxStatus = document.getElementById('statusChart').getContext('2d');
            new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: ['Selesai', 'Sedang Diproses', 'Antre'],
                    datasets: [{
                        data: [{{ $statusSelesai ?? 0 }}, {{ $statusProses ?? 0 }}, {{ $statusAntre ?? 0 }}],
                        backgroundColor: ['#10b981', '#f59e0b', '#cbd5e1'],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                font: { family: 'Nunito', weight: 'bold' },
                                color: '#64748b'
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
