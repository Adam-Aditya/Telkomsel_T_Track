<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Daftar Akun | Telkomsel T-Track</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght=400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    
    <style data-purpose="typography">
        body {
            font-family: 'Inter', sans-serif;
        }
        .ethereal-bg {
            background: radial-gradient(circle at 10% 20%, rgba(254, 242, 242, 1) 0%, rgba(255, 255, 255, 1) 100%);
            position: relative;
            overflow: hidden;
        }
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            z-index: 0;
        }
        .blob-1 {
            width: 500px;
            height: 500px;
            background: rgba(239, 68, 68, 0.08);
            top: -150px;
            left: -150px;
        }
        .blob-2 {
            width: 600px;
            height: 600px;
            background: rgba(244, 63, 94, 0.06);
            bottom: -200px;
            right: -150px;
        }
    </style>
</head>
<body class="ethereal-bg min-h-screen flex items-center justify-center p-4 lg:p-8">

    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <main class="relative z-10 w-full max-w-6xl bg-white/80 backdrop-blur-2xl rounded-[2.5rem] shadow-2xl flex flex-col md:flex-row overflow-hidden border border-white/60" data-purpose="main-card">
        
        <section class="w-full md:w-5/12 p-8 lg:p-16 flex flex-col justify-between bg-gray-50/40 md:border-r md:border-gray-100" data-purpose="hero-content">
            <div class="space-y-10">
                <div class="flex items-center space-x-2.5">
                    <img src="{{ asset('images/telkomsel.svg') }}" alt="Logo Telkomsel" class="h-6 w-auto block object-contain select-none">
                    <span class="font-black text-xl tracking-tight text-gray-900">
                        Telkomsel <span class="text-red-600">T-Track</span>
                    </span>
                </div>

                <div class="space-y-4">
                    <h1 class="text-3xl lg:text-4xl font-black text-gray-950 tracking-tight leading-tight">
                        Fast, Efficient and Productive
                    </h1>
                    <p class="text-gray-500 text-sm leading-relaxed font-normal">
                        Sistem digitalisasi internal pengelolaan aset logistik untuk mempermudah pemantauan stok, pelacakan mutasi, dan efisiensi pelaporan dalam satu platform terpadu.
                    </p>
                </div>
            </div>

            <div class="mt-12 flex flex-wrap items-center justify-between gap-4 text-xs font-semibold text-gray-400">
                <div class="flex gap-4">
                    <a class="hover:text-red-600 transition-colors" href="#">Terms</a>
                    <a class="hover:text-red-600 transition-colors" href="#">Plans</a>
                    <a class="hover:text-red-600 transition-colors" href="#">Contact Us</a>
                </div>
                <span class="text-[11px]">© 2026 PT Telkomsel Indonesia.</span>
            </div>
        </section>

        <section class="w-full md:w-7/12 bg-white p-8 lg:p-16 flex items-center">
            <div class="w-full max-w-md mx-auto relative">

                @if ($errors->any())
                    <div class="mb-4 p-4 text-sm text-red-700 bg-red-50 rounded-xl border border-red-100">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div id="signup-container" class="space-y-6">
                    <div>
                        <h2 class="text-2xl font-black text-gray-950 tracking-tight">Sign Up</h2>
                        <p class="text-xs text-gray-400 font-semibold tracking-wide mt-0.5">Daftarkan akun sistem inventaris internal Anda</p>
                    </div>

                    <form id="signup-form" action="{{ route('register') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-700 tracking-wide">Nama Lengkap</label>
                            <input class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 text-sm font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required type="text"/>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-700 tracking-wide">Email</label>
                            <input class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 text-sm font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all" name="email" value="{{ old('email') }}" placeholder="Email" required type="email"/>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-700 tracking-wide">Pilih Hak Akses / Peran</label>
                            <select class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 text-sm font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all cursor-pointer text-gray-700" name="role_id" required>
                                <option value="" disabled selected hidden>Pilih hak akses kerja Anda...</option>
                                <option value="1">Admin / Supervisor (Kendali Penuh Systems)</option>
                                <option value="2">Staff / Operator (Input & Sortir Logistik)</option>
                                <option value="3">Manager / Eksekutif (Monitoring & Unduh Laporan)</option>
                            </select>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-700 tracking-wide">Password</label>
                            <input class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 text-sm font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all" name="password" placeholder="••••••••" required type="password"/>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-700 tracking-wide">Repeat Password</label>
                            <input class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 text-sm font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all" name="password_confirmation" placeholder="••••••••" required type="password"/>
                        </div>

                        <button class="w-full inline-flex items-center justify-center text-sm font-black bg-red-600 text-white py-3 rounded-full hover:bg-red-700 shadow-md shadow-red-600/10 transform active:scale-[0.98] transition tracking-wide duration-150 mt-2" type="submit">Sign Up</button>
                    </form>

                    <p class="text-center text-xs font-semibold text-gray-400 pt-2">
                        Already have an account? <button type="button" onclick="switchForm('login')" class="text-red-600 font-black hover:underline ml-1">Sign In</button>
                    </p>
                </div>

                <div id="login-container" class="space-y-6 hidden">
                    <div>
                        <h2 class="text-2xl font-black text-gray-950 tracking-tight">Sign In</h2>
                        <p class="text-xs text-gray-400 font-semibold tracking-wide mt-0.5">Masuk ke akun sistem inventaris internal Anda</p>
                    </div>

                    <form id="login-form" action="{{ route('login') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-700 tracking-wide">Email</label>
                            <input class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 text-sm font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all" name="email" value="{{ old('email') }}" placeholder="Email" required type="email"/>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-gray-700 tracking-wide">Password</label>
                            <input class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 text-sm font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all" name="password" placeholder="••••••••" required type="password"/>
                        </div>

                        <button class="w-full inline-flex items-center justify-center text-sm font-black bg-red-600 text-white py-3 rounded-full hover:bg-red-700 shadow-md shadow-red-600/10 transform active:scale-[0.98] transition tracking-wide duration-150 mt-2" type="submit">Sign In</button>
                    </form>

                    <p class="text-center text-xs font-semibold text-gray-400 pt-2">
                        Don't have an account? <button type="button" onclick="switchForm('signup')" class="text-red-600 font-black hover:underline ml-1">Sign Up</button>
                    </p>
                </div>

            </div>
        </section>
    </main>
    
    <script>
        function switchForm(target) {
            const signup = document.getElementById('signup-container');
            const login = document.getElementById('login-container');
            if (target === 'login') {
                signup.classList.add('hidden');
                login.classList.remove('hidden');
                document.title = "Masuk Akun | Telkomsel T-Track";
            } else {
                login.classList.add('hidden');
                signup.classList.remove('hidden');
                document.title = "Daftar Akun | Telkomsel T-Track";
            }
        }

        // Kita konversi logika Blade menjadi boolean JavaScript murni agar VS Code tidak bingung
        const hasLoginError = "{{ (!$errors->has('name') && ($errors->has('email') || $errors->has('password'))) ? 'true' : 'false' }}" === 'true';
        
        if (hasLoginError) {
            switchForm('login');
        }
    </script>
</body>
</html>