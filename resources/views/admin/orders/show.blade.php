<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{ route('admin.monitoring') }}" class="text-blue-500 hover:text-blue-700">&larr; Kembali</a> | {{ __('Sistem Kasir') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm flex items-center gap-2">
                    <span class="text-emerald-500 text-xl">✅</span>
                    <p class="text-emerald-700 font-bold">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-blue-100">

                <div class="bg-blue-800 text-white p-5 sm:px-8 flex items-center gap-3">
                    <svg class="w-6 h-6 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <h3 class="text-xl font-bold tracking-wide">Informasi Pesanan</h3>
                </div>

                <div class="flex flex-col md:flex-row p-6 sm:p-8 gap-8">

                    <div class="w-full md:w-1/3 flex flex-col gap-6">

                        <div class="bg-blue-50/50 border border-blue-100 rounded-xl p-6 text-center shadow-sm">
                            <p class="text-xs text-blue-500 font-bold tracking-widest uppercase mb-1">Nomor Resi / Pelanggan</p>
                            <h4 class="text-2xl font-black text-blue-900 mb-4">{{ $order->nomor_resi }}</h4>

                            <div class="border-t border-blue-100 pt-4">
                                <p class="text-xs text-gray-500 font-bold tracking-widest uppercase mb-1">Total Tagihan</p>
                                <p class="text-3xl font-black text-rose-600">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="font-bold text-gray-800 mb-3 text-lg">Status Pembayaran</p>

                            @if($order->pembayaran_status == 'lunas')
                                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-5 flex flex-col items-center gap-2 shadow-sm text-center">
                                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mb-2">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <span class="text-emerald-700 font-black text-xl tracking-wider">LUNAS</span>
                                    <span class="text-xs text-emerald-600 font-medium">Pembayaran telah dikonfirmasi</span>
                                </div>
                            @else
                                <div class="bg-amber-50 border border-amber-200 rounded-xl p-5 mb-4 shadow-sm flex items-start gap-3">
                                    <span class="text-amber-500 text-2xl mt-1">🕒</span>
                                    <div>
                                        <p class="font-bold text-amber-800 text-sm">BELUM DIBAYAR</p>
                                        <p class="text-xs text-amber-700 mt-1">Menunggu konfirmasi kasir.</p>
                                    </div>
                                </div>

                                <form action="{{ route('admin.orders.konfirmasiPembayaran', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 rounded-xl shadow-lg transition duration-200 flex items-center justify-center gap-2 transform hover:-translate-y-1">
                                        <span>💵</span> Terima Pembayaran
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="w-full md:w-2/3 border-t md:border-t-0 md:border-l border-gray-100 md:pl-8 pt-6 md:pt-0">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-3">Rincian Layanan</h3>

                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <p class="font-bold text-gray-800 text-lg">{{ $order->service->nama_layanan }}</p>
                                <p class="text-sm text-gray-500 mt-1 font-medium">
                                    x {{ $order->jumlah_berat }} {{ $order->service->satuan }} <span class="mx-2">|</span> @ Rp {{ number_format($order->service->harga, 0, ',', '.') }}
                                </p>
                            </div>
                            <p class="font-bold text-gray-800">Rp {{ number_format($order->service->harga * $order->jumlah_berat, 0, ',', '.') }}</p>
                        </div>

                        @if($order->diskon > 0)
                        <div class="flex justify-between items-center mb-6 text-emerald-600 bg-emerald-50 px-4 py-2 rounded-lg border border-emerald-100">
                            <p class="text-sm font-bold flex items-center gap-2">🎟️ Potongan Diskon</p>
                            <p class="text-sm font-bold">- Rp {{ number_format($order->diskon, 0, ',', '.') }}</p>
                        </div>
                        @endif

                        <div class="border-t-2 border-dashed border-gray-200 pt-6 flex justify-between items-center mb-10">
                            <p class="text-xl font-bold text-gray-800">Total Akhir</p>
                            <p class="text-3xl font-black text-rose-600">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                        </div>

                        <div class="flex justify-end border-t border-gray-100 pt-6">
                            <a href="{{ route('order.invoice', $order->id) }}" target="_blank" class="inline-flex items-center gap-2 bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 font-bold px-6 py-3 rounded-lg shadow-sm transition">
                                🖨️ Cetak Struk
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
