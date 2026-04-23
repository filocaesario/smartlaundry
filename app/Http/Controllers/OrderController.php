<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ✔️ Posisi Auth sudah rapi di atas
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Promo;

class OrderController extends Controller
{
    // 1. Menampilkan Form Pemesanan
    public function index()
    {
        $services = Service::all();
        return view('user.order', compact('services'));
    }
    // 2. Memproses Data Pesanan

public function store(Request $request)
{
    // 1. Validasi Input Dasar
    $request->validate([
        'nama_pelanggan' => 'required',
        'no_wa' => 'required',
        'alamat' => 'required',
        'service_id' => 'required|exists:services,id',
        'jumlah_berat' => 'required|numeric|min:1',
    ]);

    // 2. Ambil Data Layanan & Hitung Harga Awal
    $service = Service::find($request->service_id);
    $hargaAwal = $service->harga * $request->jumlah_berat;
    $diskon = 0;
    $totalHarga = $hargaAwal;

    // 3. LOGIKA KODE PROMO (Inti Fitur)
    if ($request->filled('kode_promo')) {
        $promo = Promo::where('kode', strtoupper($request->kode_promo))
                      ->where('is_active', true)
                      ->where('kuota', '>', 0)
                      ->first();

        if ($promo) {
            // Hitung Potongan
            $diskon = ($hargaAwal * $promo->diskon_persen) / 100;
            $totalHarga = $hargaAwal - $diskon;

            // Kurangi Kuota Voucher di Database
            $promo->decrement('kuota');
        } else {
            // Jika kode salah/habis, kirim pesan error kembali ke form
            return back()->with('error', 'Opps! Kode promo tidak valid atau sudah habis.')->withInput();
        }
    }

    // 4. Simpan Pesanan ke Database
    $order = Order::create([
        'user_id' => auth()->id(),
        'nomor_resi' => 'LND-' . strtoupper(\Illuminate\Support\Str::random(6)),
        'nama_pelanggan' => $request->nama_pelanggan,
        'no_wa' => $request->no_wa,
        'alamat' => $request->alamat,
        'service_id' => $request->service_id,
        'jumlah_berat' => $request->jumlah_berat,
        'total_harga' => $totalHarga, // Simpan harga yang sudah dipotong diskon
       'status' => 'antre',
        'pembayaran_status' => 'belum' // Atau sesuaikan dengan enum di database-mu
    ]);

    return redirect()->route('order.history')->with('success', 'Pesanan berhasil dibuat! Diskon Berhasil digunakan.');
}
    // 3. Menampilkan Dashboard User (Hanya kartu menu)
    public function userDashboard()
    {
        return view('dashboard');
    }
    // 4. Menampilkan Halaman Riwayat Pesanan
    public function history()
    {
        // Ambil semua pesanan milik user yang sedang login (yang tidak disembunyikan)
        // Urutkan dari yang paling baru
        $orders = Order::with('service')
            ->where('user_id', Auth::id())
            ->where('is_hidden_by_user', false)
            ->latest()
            ->get();

        // Pastikan nama file view-nya sesuai (history atau riwayat)
        // Jika file kamu namanya riwayat.blade.php, ganti 'user.history' menjadi 'user.riwayat'
        return view('user.riwayat', compact('orders'));
    }
    // 5. Menampilkan Halaman Lacak Cucian
    public function track(Request $request)
    {
        $order = null;

        // Jika ada parameter 'resi' di URL (hasil klik dari halaman riwayat)
        // atau hasil input manual dari form pencarian
        if ($request->has('resi')) {
            $order = Order::with('service')
                ->where('nomor_resi', $request->resi)
                ->first();
        }

        return view('user.track', compact('order'));
    }
    // Tambahkan fungsi-fungsi ini di dalam class OrderController

    // 1. Tampilkan Halaman Edit
    public function edit($id)
    {
        // Cari pesanan milik user yang sedang login
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        // Proteksi: Hanya bisa edit jika status masih antre
        if ($order->status !== 'antre') {
            return redirect()->route('order.history')->with('error', 'Pesanan yang sedang diproses tidak dapat diubah.');
        }

        $services = Service::all();
        return view('user.edit', compact('order', 'services'));
    }
    // 2. Proses Update Data
    public function update(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        if ($order->status !== 'antre') {
            return redirect()->route('order.history')->with('error', 'Gagal memperbarui. Pesanan sudah masuk tahap pengerjaan.');
        }

        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'alamat' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'jumlah_berat' => 'required|numeric|min:1',
        ]);

        // Hitung ulang total harga jika layanan atau berat berubah
        $service = Service::find($request->service_id);
        $total_harga = $service->harga * $request->jumlah_berat;

        $order->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
            'service_id' => $request->service_id,
            'jumlah_berat' => $request->jumlah_berat,
            'total_harga' => $total_harga,
        ]);

        return redirect()->route('order.history')->with('success', 'Pesanan berhasil diperbarui.');
    }

    // 3. Batalkan Pesanan (Hapus dari Database)
    public function destroy($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        // Jika status Antre, kita hapus permanen (karena pembatalan total)
        if ($order->status === 'antre') {
            $order->delete();
            $pesan = 'Pesanan berhasil dibatalkan.';
        }
        // Jika status Selesai, kita sembunyikan saja dari User (Admin tetap bisa lihat)
        elseif ($order->status === 'selesai') {
            $order->update(['is_hidden_by_user' => true]);
            $pesan = 'Riwayat pesanan telah dibersihkan dari daftar Anda.';
        } else {
            return redirect()->route('order.history')->with('error', 'Pesanan sedang diproses dan tidak bisa dihapus.');
        }

        return redirect()->route('order.history')->with('success', $pesan);
    }
    public function cetakStruk($id)
    {
        $order = Order::with('service')->findOrFail($id);

        // Tambahkan Kunci Keamanan VIP di sini juga
        if ($order->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak. Anda salah masuk kamar nih! 😎');
        }

        // ... (biarkan sisa kode cetak PDF domPDF di bawahnya tetap sama) ...
        $pdf = Pdf::loadView('user.struk_pdf', compact('order'));
        return $pdf->download('Struk-' . $order->nomor_resi . '.pdf');
    }

    public function invoice($id)
    {
        $order = Order::with('service')->findOrFail($id);

        // KUNCI KEAMANAN BARU:
        // Tolak akses JIKA dia BUKAN pemilik pesanan DAN dia BUKAN admin
        if ($order->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak. Anda salah masuk kamar nih! 😎');
        }

        return view('user.invoice', compact('order'));
    }
}
