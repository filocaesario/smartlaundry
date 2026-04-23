<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - SmartLaundry</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased overflow-hidden">
    <div class="min-h-screen flex flex-row-reverse">

        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-indigo-900 via-blue-800 to-blue-600 relative items-center justify-center overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
            <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-[100px] opacity-60"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-[100px] opacity-60"></div>

            <div class="relative z-10 text-center px-12">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-white/10 backdrop-blur-xl rounded-3xl mb-8 shadow-2xl border border-white/20">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                </div>
                <h1 class="text-4xl lg:text-5xl font-black text-white mb-6 leading-tight">Mulai Perjalanan<br>Baru Anda</h1>
                <p class="text-blue-100 text-lg font-medium leading-relaxed max-w-md mx-auto">
                    Gabung dengan ribuan pelanggan lainnya yang telah membebaskan diri dari rutinitas mencuci pakaian.
                </p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 xl:p-24 overflow-y-auto bg-white">
            <div class="w-full max-w-md">

                <div class="lg:hidden flex items-center gap-2 mb-8">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-white text-xl font-black">S</span>
                    </div>
                    <span class="text-2xl font-black tracking-tight text-blue-900">Smart<span class="text-blue-600">Laundry</span></span>
                </div>

                <h2 class="text-3xl font-black text-gray-900 mb-2">Buat Akun</h2>
                <p class="text-gray-500 font-medium mb-8">Hanya butuh 1 menit untuk mendaftar.</p>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-extrabold text-gray-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all font-medium text-gray-800 placeholder-gray-400" placeholder="Budi Santoso">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-rose-500 text-xs font-bold" />
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-extrabold text-gray-700 mb-2">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all font-medium text-gray-800 placeholder-gray-400" placeholder="nama@email.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-500 text-xs font-bold" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-extrabold text-gray-700 mb-2">Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all font-medium text-gray-800 placeholder-gray-400" placeholder="Minimal 8 karakter">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-500 text-xs font-bold" />
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-extrabold text-gray-700 mb-2">Ulangi Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all font-medium text-gray-800 placeholder-gray-400" placeholder="Ketik ulang kata sandi">
                        </div>
                    </div>

                    <button type="submit" class="w-full mt-6 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-black text-lg py-4 rounded-2xl shadow-[0_10px_20px_-10px_rgba(37,99,235,0.5)] hover:shadow-[0_15px_25px_-10px_rgba(37,99,235,0.6)] hover:-translate-y-1 transition-all duration-300">
                        DAFTAR SEKARANG
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-gray-500 font-medium">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:text-blue-800 transition border-b border-blue-600 pb-0.5">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
