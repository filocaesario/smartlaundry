<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // Ambil data user, hitung jumlah pesanannya, dan jumlahkan uang yang sudah dibayar
        $customers = User::where('role', 'user')
            ->withCount('orders') // Menghitung total transaksi (menghasilkan $customer->orders_count)
            ->withSum(['orders' => function($query) {
                $query->where('pembayaran_status', 'lunas'); // Hanya hitung tagihan yang sudah lunas
            }], 'total_harga') // Menghasilkan $customer->orders_sum_total_harga
            ->orderByDesc('orders_count') // Urutkan dari pelanggan yang paling sering nyuci
            ->get();

        // Rapikan penamaan variabel agar sesuai dengan tampilan Blade
        foreach($customers as $customer) {
            $customer->total_spent = $customer->orders_sum_total_harga ?? 0;
        }

        return view('admin.customers.index', compact('customers'));
    }
}
