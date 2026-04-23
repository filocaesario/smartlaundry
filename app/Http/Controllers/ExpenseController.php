<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Order;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * 1. Menampilkan Halaman Buku Kas (Tabel & Ringkasan)
     */
    public function index()
    {
        // Ambil semua data pengeluaran, urutkan dari yang terbaru
        $expenses = Expense::orderBy('tanggal', 'desc')->get();

        // Hitung Total Pendapatan Kotor (Dari pesanan yang statusnya LUNAS)
        $totalPendapatan = Order::where('pembayaran_status', 'lunas')->sum('total_harga');

        // Hitung Total Pengeluaran
        $totalPengeluaran = Expense::sum('jumlah');

        // Hitung Laba Bersih
        $labaBersih = $totalPendapatan - $totalPengeluaran;

        return view('admin.expenses.index', compact('expenses', 'totalPendapatan', 'totalPengeluaran', 'labaBersih'));
    }

    /**
     * 2. Menampilkan Halaman Form "Catat Pengeluaran Baru"
     * (Ini adalah fungsi yang bikin error tadi karena belum ada!)
     */
    public function create()
    {
        return view('admin.expenses.create');
    }

    /**
     * 3. Menyimpan Data Pengeluaran ke Database
     */
    public function store(Request $request)
    {
        // Validasi data agar tidak ada input yang salah/kosong
        $request->validate([
            'tanggal' => 'required|date',
            'kategori' => 'required|string',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Simpan ke tabel expenses
        Expense::create([
            'tanggal' => $request->tanggal,
            'kategori' => $request->kategori,
            'keterangan' => $request->keterangan,
            'jumlah' => $request->jumlah,
        ]);

        // Kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.expenses.index')->with('success', 'Catatan pengeluaran berhasil ditambahkan ke Buku Kas!');
    }

    /**
     * 4. Menghapus Data Pengeluaran
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('admin.expenses.index')->with('success', 'Catatan pengeluaran berhasil dihapus.');
    }
}
