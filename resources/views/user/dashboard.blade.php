<x-app-layout>
    <div class="bg-slate-50 min-h-screen py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-[2rem] shadow-2xl p-8 sm:p-12 mb-10 relative overflow-hidden">
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-10"></div>
                <div class="absolute bottom-0 right-20 -mb-16 w-40 h-40 rounded-full bg-white opacity-10"></div>

                <div class="relative z-10">
                    <span class="bg-blue-500/50 text-white px-4 py-1 rounded-full text-xs font-bold tracking-widest uppercase backdrop-blur-sm border border-blue-400/50">SmartLaundry App</span>
                    <h1 class="text-3xl sm:text-5xl font-black text-white mt-6 mb-4">Halo, {{ Auth::user()->name }}! 👋</h1>
                    <p class="text-blue-100 text-lg sm:text-xl max-w-xl font-medium">Pakaian kotor menumpuk? Jangan khawatir, serahkan pada kami dan nikmati waktu santai Anda di rumah.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <a href="{{ route('order.index') }}" class="group bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl border border-blue-50 hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shadow-inner">
                        🧺
                    </div>
                    <h3 class="text-2xl font-extrabold text-gray-800 mb-2">Pesan Laundry</h3>
                    <p class="text-gray-500 font-medium">Buat pesanan baru untuk cuci kiloan, karpet, atau cuci sepatu dengan cepat.</p>
                    <div class="mt-6 flex items-center text-blue-600 font-bold text-sm">
                        Mulai Pesan <span class="ml-2 group-hover:translate-x-2 transition-transform">&rarr;</span>
                    </div>
                </a>

                <a href="{{ route('order.history') }}" class="group bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl border border-blue-50 hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shadow-inner">
                        🧾
                    </div>
                    <h3 class="text-2xl font-extrabold text-gray-800 mb-2">Riwayat & Lacak</h3>
                    <p class="text-gray-500 font-medium">Pantau status cucian Anda saat ini, unduh struk digital, atau lihat histori pesanan.</p>
                    <div class="mt-6 flex items-center text-blue-600 font-bold text-sm">
                        Cek Status Cucian <span class="ml-2 group-hover:translate-x-2 transition-transform">&rarr;</span>
                    </div>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>
