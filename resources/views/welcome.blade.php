<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartLaundry - Solusi Cuci Bersih & Mewah</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="antialiased bg-white text-slate-900">

    <nav class="fixed w-full z-50 glass-nav border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200">
                        <span class="text-white text-xl font-black">S</span>
                    </div>
                    <span class="text-2xl font-black tracking-tight text-blue-900">Smart<span class="text-blue-600">Laundry</span></span>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition px-4 py-2">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-lg shadow-blue-200 transition transform hover:-translate-y-0.5">Daftar Sekarang</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-blue-50 blur-[120px] opacity-60"></div>
            <div class="absolute bottom-[10%] right-[-5%] w-[30%] h-[30%] rounded-full bg-indigo-50 blur-[100px] opacity-60"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center">
                <span class="inline-block px-4 py-1.5 mb-6 text-xs font-bold tracking-widest text-blue-600 uppercase bg-blue-50 rounded-full border border-blue-100">
                    ✨ Solusi Laundry No. 1 di Indonesia
                </span>
                <h1 class="text-5xl lg:text-7xl font-black text-slate-900 leading-[1.1] mb-8">
                    Cucian Bersih Sempurna,<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 italic">Tanpa Harus Keluar Rumah.</span>
                </h1>
                <p class="text-lg text-slate-500 max-w-2xl mx-auto mb-10 leading-relaxed font-medium">
                    Nikmati layanan laundry premium dengan hasil yang pasti wangi, rapi, dan bersih higienis. Kami jemput pakaian kotor Anda dan antar kembali dalam kondisi sempurna.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-full text-lg font-extrabold shadow-2xl shadow-blue-300 transition-all transform hover:-translate-y-1">
                        Mulai Pesan Sekarang
                    </a>
                    <a href="{{ route('order.track') }}" class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 px-10 py-4 rounded-full text-lg font-extrabold transition-all transform hover:-translate-y-1">
                        📍 Lacak Cucian
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 p-10 bg-slate-50 rounded-[3rem] border border-slate-100">
                <div class="text-center">
                    <h3 class="text-4xl font-black text-blue-600 mb-1">10k+</h3>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Pakaian Dicuci</p>
                </div>
                <div class="text-center border-l border-slate-200">
                    <h3 class="text-4xl font-black text-blue-600 mb-1">5k+</h3>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Pelanggan Puas</p>
                </div>
                <div class="text-center border-l border-slate-200 lg:block hidden">
                    <h3 class="text-4xl font-black text-blue-600 mb-1">24h</h3>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Selesai Cepat</p>
                </div>
                <div class="text-center border-l border-slate-200 lg:block hidden">
                    <h3 class="text-4xl font-black text-blue-600 mb-1">4.9</h3>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Rating Bintang</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 lg:py-32">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row justify-between items-end mb-16 gap-6">
                <div class="max-w-xl">
                    <h2 class="text-4xl font-black text-slate-900 leading-tight mb-4">Mengapa Memilih Layanan Kami?</h2>
                    <p class="text-slate-500 font-medium leading-relaxed">Kami menggunakan teknologi pencucian terbaru dan deterjen ramah lingkungan untuk memastikan serat pakaian Anda tetap terjaga.</p>
                </div>
                <div class="pb-2">
                    <div class="h-1.5 w-24 bg-blue-600 rounded-full"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group p-10 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:border-blue-100 transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300 shadow-inner">
                        🫧
                    </div>
                    <h4 class="text-xl font-black text-slate-900 mb-4">Pencucian Higienis</h4>
                    <p class="text-slate-500 leading-relaxed font-medium">Setiap cucian diproses secara terpisah antar pelanggan untuk menjamin kebersihan 100%.</p>
                </div>

                <div class="group p-10 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:border-blue-100 transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300 shadow-inner">
                        🚚
                    </div>
                    <h4 class="text-xl font-black text-slate-900 mb-4">Antar Jemput Gratis</h4>
                    <p class="text-slate-500 leading-relaxed font-medium">Kurir kami siap menjemput pakaian kotor Anda tepat waktu dan mengantarkannya kembali.</p>
                </div>

                <div class="group p-10 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:border-blue-100 transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300 shadow-inner">
                        🏷️
                    </div>
                    <h4 class="text-xl font-black text-slate-900 mb-4">Harga Terjangkau</h4>
                    <p class="text-slate-500 leading-relaxed font-medium">Nikmati layanan bintang lima dengan harga kaki lima. Transparan tanpa biaya tersembunyi.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-slate-900 text-white pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
                <div>
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center">
                            <span class="text-white text-xl font-black">S</span>
                        </div>
                        <span class="text-2xl font-black tracking-tight">Smart<span class="text-blue-500">Laundry</span></span>
                    </div>
                    <p class="text-slate-400 max-w-sm font-medium leading-relaxed mb-8">
                        Layanan laundry modern berbasis teknologi yang memudahkan hidup Anda. Berdiri sejak 2024 untuk memberikan kesegaran pada setiap pakaian.
                    </p>
                </div>
                <div class="lg:text-right">
                    <h4 class="text-xl font-bold mb-6">Sudah siap untuk tampil wangi & rapi?</h4>
                    <a href="{{ route('register') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3.5 rounded-full font-bold shadow-lg transition transform hover:scale-105">
                        Daftar SmartLaundry Sekarang
                    </a>
                </div>
            </div>
            <div class="border-t border-slate-800 pt-10 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-500 text-sm font-medium">
                    &copy; {{ date('Y') }} SmartLaundry System. Developed for Excellence.
                </p>
                <div class="flex gap-6 text-slate-500 text-sm font-bold">
                    <a href="#" class="hover:text-blue-500">Tentang Kami</a>
                    <a href="#" class="hover:text-blue-500">Kontak</a>
                    <a href="#" class="hover:text-blue-500">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
