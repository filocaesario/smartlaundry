<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::orderBy('created_at', 'desc')->get();
        return view('admin.promos.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|unique:promos,kode|max:20',
            'diskon_persen' => 'required|integer|min:1|max:100',
            'kuota' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        // Huruf besar semua untuk kode promo (otomatis)
        $data = $request->all();
        $data['kode'] = strtoupper($request->kode);
        $data['is_active'] = true;

        Promo::create($data);

        return redirect()->route('admin.promos.index')->with('success', 'Voucher baru berhasil diterbitkan!');
    }

    public function destroy(Promo $promo)
    {
        $promo->delete();
        return redirect()->route('admin.promos.index')->with('success', 'Voucher berhasil dihapus secara permanen.');
    }
}
