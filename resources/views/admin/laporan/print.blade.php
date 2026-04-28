<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan SmartLaundry - {{ $namaBulan }} {{ $year }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Pengaturan Khusus Kertas Printer */
        @media print {
            @page { margin: 1.5cm; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; background-color: white; }
            .no-print { display: none !important; }
            .print-break { page-break-before: always; }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans p-4 sm:p-8">

    <div class="max-w-4xl mx-auto bg-white p-8 sm:p-12 shadow-xl print:shadow-none print:p-0">

        <div class="mb-8 text-right no-print">
            <button onclick="window.print()" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold shadow-md hover:bg-blue-700">
                🖨️ Cetak Sekarang
            </button>
        </div>

        <div class="border-b-4 border-slate-800 pb-6 mb-8 text-center">
            <h1 class="text-4xl font-black tracking-widest uppercase">SmartLaundry</h1>
            <p class="text-sm text-slate-500 mt-1 font-medium">Layanan Cuci Premium & Terpercaya</p>
            <p class="text-xs text-slate-400 mt-1">Cigombong, Jawa Barat, Indonesia | Telp: 0812-XXXX-XXXX</p>

            <div class="mt-8 inline-block bg-slate-100 px-6 py-2 rounded-full border border-slate-200">
                <h2 class="text-xl font-bold uppercase tracking-widest text-slate-700">Laporan Keuangan Bulanan</h2>
            </div>
            <p class="font-bold text-slate-600 mt-3 text-lg">Periode: <span class="text-blue-600">{{ $namaBulan }} {{ $year }}</span></p>
        </div>

        <div class="flex border-2 border-slate-800 rounded-xl overflow-hidden mb-10">
            <div class="flex-1 p-4 text-center border-r-2 border-slate-800 bg-emerald-50">
                <p class="text-xs font-black uppercase tracking-widest text-slate-500 mb-1">Total Pemasukan</p>
                <h3 class="text-xl font-black text-emerald-600">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</h3>
            </div>
            <div class="flex-1 p-4 text-center border-r-2 border-slate-800 bg-rose-50">
                <p class="text-xs font-black uppercase tracking-widest text-slate-500 mb-1">Total Pengeluaran</p>
                <h3 class="text-xl font-black text-rose-600">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
            </div>
            <div class="flex-1 p-4 text-center bg-blue-50">
                <p class="text-xs font-black uppercase tracking-widest text-slate-500 mb-1">Laba Bersih</p>
                <h3 class="text-xl font-black text-blue-600">Rp {{ number_format($labaBersih, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="mb-10">
            <h3 class="text-lg font-black uppercase border-b-2 border-slate-200 pb-2 mb-4 text-slate-800">1. Rincian Pemasukan (Pesanan Selesai)</h3>
            <table class="w-full text-left text-sm border-collapse">
                <thead>
                    <tr class="bg-slate-100">
                        <th class="p-3 border border-slate-300">Tanggal</th>
                        <th class="p-3 border border-slate-300">No. Resi</th>
                        <th class="p-3 border border-slate-300">Pelanggan</th>
                        <th class="p-3 border border-slate-300 text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="p-3 border border-slate-300">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</td>
                            <td class="p-3 border border-slate-300 font-bold">{{ $order->nomor_resi }}</td>
                            <td class="p-3 border border-slate-300">{{ $order->nama_pelanggan }}</td>
                            <td class="p-3 border border-slate-300 text-right font-bold text-emerald-600">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="p-4 text-center text-slate-400 italic border border-slate-300">Tidak ada data pemasukan di bulan ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mb-10">
            <h3 class="text-lg font-black uppercase border-b-2 border-slate-200 pb-2 mb-4 text-slate-800">2. Rincian Pengeluaran (Beban Kas)</h3>
            <table class="w-full text-left text-sm border-collapse">
                <thead>
                    <tr class="bg-slate-100">
                        <th class="p-3 border border-slate-300">Tanggal</th>
                        <th class="p-3 border border-slate-300">Keterangan</th>
                        <th class="p-3 border border-slate-300 text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expenses as $expense)
                        <tr>
                            <td class="p-3 border border-slate-300">{{ \Carbon\Carbon::parse($expense->tanggal)->format('d M Y') }}</td>
                            <td class="p-3 border border-slate-300">{{ $expense->keterangan }}</td>
                            <td class="p-3 border border-slate-300 text-right font-bold text-rose-600">Rp {{ number_format($expense->jumlah, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="p-4 text-center text-slate-400 italic border border-slate-300">Tidak ada data pengeluaran di bulan ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-16 flex justify-end">
            <div class="text-center w-48">
                <p class="text-sm mb-16 text-slate-600">Cigombong, {{ now()->format('d M Y') }}<br>Mengetahui,</p>
                <p class="font-bold border-b border-slate-800 pb-1">{{ auth()->user()->name }}</p>
                <p class="text-xs text-slate-500 mt-1">Administrator / Pemilik</p>
            </div>
        </div>

    </div>

    <script>
        // Otomatis memunculkan dialog print saat halaman selesai dimuat
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
