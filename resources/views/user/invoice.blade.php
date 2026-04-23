<x-app-layout>
    <style>
        @media print {
            @page {
                /* Menghilangkan tulisan "Laravel", Tanggal, dan URL bawaan browser */
                margin: 0;
                size: auto;
            }
            body {
                /* Memaksa printer untuk mencetak warna biru yang mewah */
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                margin: 1cm;
            }
        }
    </style>

    <div class="py-12 print:py-0 bg-slate-50 print:bg-white min-h-screen print:min-h-0">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 print:px-0">

            <div class="bg-white rounded-[2rem] print:rounded-xl shadow-2xl print:shadow-none overflow-hidden border border-blue-50 print:border-blue-100">

                <div class="bg-gradient-to-br from-blue-600 to-blue-800 p-8 print:p-6 text-center text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white opacity-10"></div>
                    <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-24 h-24 rounded-full bg-white opacity-10"></div>

                    <div class="inline-flex items-center justify-center w-16 h-16 print:w-12 print:h-12 rounded-full bg-white/20 mb-4 print:mb-2 backdrop-blur-md shadow-inner">
                        <svg class="w-8 h-8 print:w-6 print:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h2 class="text-3xl print:text-2xl font-extrabold mb-1 tracking-tight">Pesanan Diterima!</h2>
                    <p class="text-blue-100 font-medium print:text-sm">Terima kasih telah mempercayakan cucian Anda di SmartLaundry</p>
                </div>

                <div class="p-6 sm:p-10 print:p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 print:gap-4 mb-10 print:mb-6">
                        <div class="space-y-4 print:space-y-2">
                            <div class="flex justify-between items-center border-b border-gray-100 pb-3 print:pb-2">
                                <span class="text-gray-500 text-sm">Pelanggan</span>
                                <span class="font-bold text-gray-800">{{ $order->nama_pelanggan }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-100 pb-3 print:pb-2">
                                <span class="text-gray-500 text-sm">Status Bayar</span>
                                @if($order->pembayaran_status == 'lunas')
                                    <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold border border-emerald-200">Lunas</span>
                                @else
                                    <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-bold border border-amber-200">Belum Bayar</span>
                                @endif
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-100 pb-3 print:pb-2">
                                <span class="text-gray-500 text-sm">Status Cucian</span>
                                <span class="font-bold text-blue-600 uppercase tracking-wide text-sm">{{ $order->status }}</span>
                            </div>
                        </div>

                        <div class="bg-blue-50/80 rounded-2xl p-6 print:p-4 text-center border border-blue-100 shadow-sm flex flex-col justify-center">
                            <span class="text-[10px] text-blue-500 font-bold mb-2 uppercase tracking-[0.2em]">KODE RESI</span>
                            <h3 class="text-3xl print:text-2xl font-black text-blue-800 tracking-wider">{{ $order->nomor_resi }}</h3>
                        </div>
                    </div>

                    <div class="mb-10 print:mb-6">
                        <h3 class="text-lg print:text-base font-extrabold text-gray-800 mb-4 print:mb-2 flex items-center gap-2">
                            <span class="text-blue-600">💳</span> Metode Pembayaran
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 print:gap-2">
                            <div class="border border-gray-100 rounded-2xl print:rounded-lg p-5 print:p-3 bg-white">
                                <h4 class="font-bold text-gray-800 mb-1 print:text-sm">💵 Bayar di Kasir</h4>
                                <p class="text-sm print:text-xs text-gray-500">Sebutkan kode pesanan di atas kepada kasir kami.</p>
                            </div>
                            <div class="border border-gray-100 rounded-2xl print:rounded-lg p-5 print:p-3 bg-white">
                                <h4 class="font-bold text-gray-800 mb-1 print:text-sm">📱 Bayar Transfer</h4>
                                <p class="text-sm print:text-xs text-gray-500 mb-1">BCA: <span class="font-bold text-blue-700">123 456 7890</span></p>
                                <p class="text-sm print:text-xs text-gray-500">GoPay: <span class="font-bold text-blue-700">0812 3456 7890</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50 print:bg-blue-50/30 rounded-2xl print:rounded-xl p-6 sm:p-8 print:p-5 border border-slate-100 print:border-blue-100 relative">
                        <h3 class="text-base font-extrabold text-gray-800 border-b border-gray-200 print:border-blue-200 pb-4 print:pb-2 mb-5 print:mb-3">Rincian Layanan</h3>

                        <div class="flex justify-between items-start mb-4 print:mb-2">
                            <div>
                                <p class="font-bold text-gray-800 text-lg print:text-base">{{ $order->service->nama_layanan }}</p>
                                <p class="text-sm print:text-xs text-gray-500 mt-1">{{ $order->jumlah_berat }} {{ $order->service->satuan }} &times; Rp {{ number_format($order->service->harga, 0, ',', '.') }}</p>
                            </div>
                            <p class="font-bold text-gray-800">Rp {{ number_format($order->service->harga * $order->jumlah_berat, 0, ',', '.') }}</p>
                        </div>

                        @if($order->diskon > 0)
                        <div class="flex justify-between mb-4 print:mb-2 text-emerald-600 bg-emerald-50 print:bg-transparent px-3 print:px-0 py-2 rounded-lg">
                            <p class="text-sm font-bold flex items-center gap-1">🎟️ Diskon Voucher</p>
                            <p class="text-sm font-bold">- Rp {{ number_format($order->diskon, 0, ',', '.') }}</p>
                        </div>
                        @endif

                        <div class="border-t-2 border-dashed border-gray-200 print:border-blue-200 pt-5 print:pt-3 mt-2 flex justify-between items-center">
                            <p class="text-lg font-extrabold text-gray-800">TOTAL</p>
                            <p class="text-3xl print:text-2xl font-black text-blue-600">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                        </div>
                    </div>

                </div>

                <div class="bg-gray-50/80 print:bg-transparent text-center py-5 print:py-3 text-xs text-gray-400 font-bold tracking-widest border-t border-gray-100 print:border-none">
                    &copy; {{ date('Y') }} SMARTLAUNDRY. HAVE A NICE DAY!
                </div>
            </div>

            <div class="mt-8 flex flex-wrap justify-center gap-4 pb-12 print:hidden">

                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 font-bold bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200 transition hover:-translate-x-1">
                        &larr; Kembali ke Kasir
                    </a>
                @else
                    <a href="{{ route('order.history') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 font-bold bg-white px-6 py-3 rounded-full shadow-sm border border-gray-200 transition hover:-translate-x-1">
                        &larr; Kembali ke Riwayat
                    </a>
                @endif

                <button onclick="window.print()" class="inline-flex items-center gap-2 text-white bg-blue-600 hover:bg-blue-700 font-bold px-8 py-3 rounded-full shadow-lg transition hover:-translate-y-1">
                    🖨️ Cetak Struk
                </button>

                <a href="{{ route('order.struk', $order->id) }}" class="inline-flex items-center gap-2 text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 font-bold px-6 py-3 rounded-full shadow-sm transition hover:-translate-y-1">
                    📄 Download PDF
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
