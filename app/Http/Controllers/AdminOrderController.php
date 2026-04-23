<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Expense;

class AdminOrderController extends Controller
{
    // 1. FUNGSI UNTUK HALAMAN DASHBOARD (STATISTIK)
    public function dashboard()
    {
        $bulanIni = now()->month;
        $tahunIni = now()->year;

        // 1. Kartu Ringkasan Finansial (Bulan Ini)
        $omzet = Order::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->where('pembayaran_status', 'lunas')
            ->sum('total_harga');

        $pengeluaran = Expense::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->sum('jumlah');

        $laba = $omzet - $pengeluaran;

        $totalPesanan = Order::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->count();

        // 2. Data Grafik Line: Pendapatan 7 Hari Terakhir
        $chartDates = [];
        $chartRevenues = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $chartDates[] = $date->format('d M'); // Contoh: 15 Apr
            $chartRevenues[] = Order::whereDate('created_at', $date)
                ->where('pembayaran_status', 'lunas')
                ->sum('total_harga');
        }

        // 3. Data Grafik Doughnut: Distribusi Status Pesanan
        $statusSelesai = Order::where('status', 'selesai')->count();
        $statusProses = Order::whereIn('status', ['diproses', 'dicuci', 'disetrika'])->count();
        $statusAntre = Order::where('status', 'antre')->count();

        // 4. Tabel 5 Pesanan Masuk Terakhir
        $recentOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'omzet',
            'pengeluaran',
            'laba',
            'totalPesanan',
            'chartDates',
            'chartRevenues',
            'statusSelesai',
            'statusProses',
            'statusAntre',
            'recentOrders'
        ));
    }

    // 2. FUNGSI UNTUK HALAMAN MONITORING TABEL
    public function monitoring()
    {
        $orders = Order::with('service')
            ->where('is_hidden_by_admin', false)
            ->latest()
            ->get();

        return view('admin.monitoring', compact('orders'));
    }

    // --- TAMBAHKAN FUNGSI INI ---
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:antre,dicuci,disetrika,selesai'
        ]);

        $order = Order::findOrFail($id);

        // 1. Update status di database
        $order->update([
            'status' => $request->status
        ]);

        // 2. Siapkan teks pesan WhatsApp
        $statusText = strtoupper($request->status);
        $linkLacak = route('order.track') . "?resi=" . $order->nomor_resi;

        $pesan = "Halo *{$order->nama_pelanggan}*! 👕🫧\n\n";
        $pesan .= "Cucian kamu dengan nomor resi *{$order->nomor_resi}* saat ini berstatus: *{$statusText}*.\n\n";
        $pesan .= "Pantau terus progres cucianmu melalui link berikut:\n{$linkLacak}\n\n";
        $pesan .= "Terima kasih telah mempercayakan cucianmu di SmartLaundry!";

        // 3. Kirim ke API Fonnte (Pastikan format nomor HP benar)
        // Note: Fonnte otomatis mengkonversi angka '08' menjadi '628'
        try {
            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN')
            ])->post('https://api.fonnte.com/send', [
                        'target' => $order->no_wa,
                        'message' => $pesan,
                        'countryCode' => '62',
                    ]);

            // JURUS DEBUGGING: Tampilkan balasan asli dari Fonnte ke layar!


        } catch (\Exception $e) {
            \Log::error('Gagal kirim WA Fonnte: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Status resi ' . $order->nomor_resi . ' berhasil diubah menjadi: ' . $statusText . ' (Notif WA dikirim!)');
    }
    public function cetakLaporan(Request $request)
    {
        // Mengambil input bulan dan tahun, jika tidak ada maka default ke bulan/tahun sekarang
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        // Ambil data pesanan selesai pada periode tersebut
        $orders = Order::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->where('status', 'selesai')
            ->get();

        // Ambil data pengeluaran pada periode tersebut
        $expenses = Expense::whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->get();

        // Hitung ringkasan finansial periode tersebut
        $totalOmzet = $orders->sum('total_harga');
        $totalPengeluaran = $expenses->sum('jumlah');
        $labaBersih = $totalOmzet - $totalPengeluaran;

        // Nama bulan untuk judul laporan
        $namaBulan = \Carbon\Carbon::create()->month($month)->translatedFormat('F');

        return view('admin.laporan.print', compact(
            'orders',
            'expenses',
            'totalOmzet',
            'totalPengeluaran',
            'labaBersih',
            'month',
            'year',
            'namaBulan'
        ));
    }
    // Tambahkan fungsi destroy khusus Admin
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.monitoring')->with('success', 'Pesanan berhasil dihapus dari riwayat.');
    }
    // Tambahkan fungsi baru ini di AdminOrderController.php
    // Menampilkan halaman detail kasir
    public function show($id)
    {
        $order = Order::with(['service'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Memproses konfirmasi pembayaran
    public function konfirmasiPembayaran($id)
    {
        $order = Order::findOrFail($id);

        // Ubah status pembayaran menjadi lunas
        $order->update([
            'pembayaran_status' => 'lunas'
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi! Pesanan sekarang LUNAS.');
    }
    public function create()
    {
        return view('admin.expenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kategori' => 'required|string',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
        ]);

        Expense::create($request->all());

        return redirect()->route('admin.expenses.index')->with('success', 'Catatan pengeluaran berhasil ditambahkan ke Buku Kas!');
    }
}
