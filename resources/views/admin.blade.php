<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dasbor Admin | Telkomsel T-Track</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface": "#ffffff",
                        "primary": "#dc2626", /* Merah Utama Telkomsel */
                        "on-background": "#111317", /* Abu-abu Gelap Korporat */
                        "on-surface": "#111317",
                        "outline-variant": "#e5e7eb",
                        "outline": "#9ca3af"
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #111317;
            -webkit-font-smoothing: antialiased;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(229, 231, 235, 0.6);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.02), 0 10px 10px -5px rgba(0, 0, 0, 0.01);
        }
        .pro-gradient {
            background: linear-gradient(135deg, #111317 0%, #dc2626 100%);
        }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="text-on-surface antialiased">

    @if(session('success') || Request::get('registered'))
    <div id="success-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-white w-full max-w-sm rounded-[24px] p-6 text-center shadow-2xl border border-gray-100 transform transition-all scale-100 space-y-4">
            <div class="w-14 h-14 bg-red-50 text-red-600 rounded-full flex items-center justify-center mx-auto shadow-inner">
                <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">verified_user</span>
            </div>
            <div class="space-y-1">
                <h4 class="text-lg font-black text-gray-950 tracking-tight">Sign Up Berhasil!</h4>
                <p class="text-xs text-gray-400 font-medium leading-relaxed">Selamat datang di ekosistem digital internal. Akun Admin Anda telah aktif sepenuhnya.</p>
            </div>
            <button onclick="closeModal()" class="w-full inline-flex items-center justify-center text-xs font-black bg-red-600 text-white py-3 rounded-full hover:bg-red-700 shadow-md shadow-red-600/10 transform active:scale-[0.97] transition duration-150">
                Buka Lembar Kerja →
            </button>
        </div>
    </div>
    @endif

    <aside class="w-64 h-screen fixed left-0 top-0 bg-white border-r border-outline-variant flex flex-col py-6 px-4 space-y-2 z-50 overflow-y-auto">
        <div class="flex items-center gap-2.5 px-2 mb-8">
            <img src="{{ asset('images/telkomsel.svg') }}" alt="Logo Telkomsel" class="h-6 w-auto block object-contain select-none">
            <h1 class="font-black text-lg tracking-tight text-gray-900 leading-none">
                Telkomsel <span class="text-red-600">T-Track</span>
            </h1>
        </div>

        <div class="space-y-1">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-3 py-2">General</p>
            <a class="flex items-center gap-3 px-4 py-3 text-red-600 bg-red-50 font-bold rounded-xl transition-colors" href="#">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-xs tracking-wide">Dashboard Admin</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 font-semibold rounded-xl transition-colors" href="#">
                <span class="material-symbols-outlined">inventory_2</span>
                <span class="text-xs tracking-wide">Penyortiran Aset</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 font-semibold rounded-xl transition-colors" href="#">
                <span class="material-symbols-outlined">local_shipping</span>
                <span class="text-xs tracking-wide">Mutasi & Logistik</span>
            </a>
        </div>

        <div class="pt-4 space-y-1">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-3 py-2">Sistem Akses</p>
            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 font-semibold rounded-xl transition-colors" href="#">
                <span class="material-symbols-outlined">group</span>
                <span class="text-xs tracking-wide">Kelola Akun Staff</span>
                <span class="ml-auto text-[10px] bg-gray-100 font-bold px-1.5 py-0.5 rounded-md">4</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 font-semibold rounded-xl transition-colors" href="#">
                <span class="material-symbols-outlined">settings</span>
                <span class="text-xs tracking-wide">Konfigurasi Hak Akses</span>
            </a>
        </div>

        <div class="mt-auto pt-4 border-t border-outline-variant flex items-center gap-3 p-2 bg-gray-50 rounded-2xl">
            <div class="w-9 h-9 bg-red-600 text-white font-black text-xs rounded-xl flex items-center justify-center shadow-md shadow-red-600/10">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div class="flex-1 overflow-hidden">
                <p class="text-xs font-black truncate">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-gray-400 truncate">{{ Auth::user()->email }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="submit" class="flex items-center text-gray-400 hover:text-red-600 transition-colors">
                    <span class="material-symbols-outlined text-lg cursor-pointer">logout</span>
                </button>
            </form>
        </div>
    </aside>

    <header class="h-16 w-full sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-outline-variant/60 flex justify-between items-center px-8 ml-64 max-w-[calc(100%-16rem)]">
        <div class="flex items-center gap-2 text-gray-400">
            <nav class="flex items-center gap-2 text-xs font-bold tracking-wide">
                <span class="text-gray-400">Pages</span>
                <span class="text-gray-300">/</span>
                <span class="text-gray-900">Dashboard Internal</span>
            </nav>
        </div>
        
        <div class="flex items-center gap-4">
            <button class="p-2 text-gray-500 hover:text-red-600 hover:bg-gray-50 rounded-full transition-all">
                <span class="material-symbols-outlined text-xl">notifications</span>
            </button>
            <div class="w-px h-5 bg-gray-200"></div>
            <div class="flex items-center gap-2.5 pl-2">
                <div class="text-right hidden xl:block">
                    <p class="text-xs font-black text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-gray-400 font-semibold">{{ Auth::user()->role->name }} T-Track</p>
                </div>
            </div>
        </div>
    </header>

    <main class="ml-64 p-8 min-h-screen">
        
        <section class="pro-gradient rounded-[24px] p-8 mb-8 text-white relative overflow-hidden flex justify-between items-center group shadow-lg shadow-red-900/5">
            <div class="relative z-10 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">verified</span>
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-90">Kredensial Otoritas Tinggi Terverifikasi</p>
                </div>
                <h2 class="text-2xl font-black tracking-tight max-w-xl">Selamat Datang di Portal Manajemen Inventaris Telkomsel T-Track</h2>
                <p class="text-xs opacity-80 font-normal">Anda memiliki akses penuh sebagai {{ Auth::user()->role->name }} untuk memantau status penyortiran barang dan mengesahkan mutasi logistik.</p>
            </div>
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-white/5 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-700"></div>
        </section>

        <div class="flex justify-between items-end mb-6">
            <h2 class="text-lg font-black tracking-tight text-gray-950">Statistik Global Sortir</h2>
            <div class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-xl text-xs font-bold text-gray-600">
                <span class="material-symbols-outlined text-sm">calendar_today</span> Real-time Data Tracker
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="glass-card p-5 rounded-[20px]">
                <div class="flex justify-between items-start mb-3">
                    <div class="w-9 h-9 bg-red-50 rounded-xl flex items-center justify-center text-red-600 shadow-sm">
                        <span class="material-symbols-outlined text-lg">inventory_2</span>
                    </div>
                </div>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-wider mb-1">Total Aset Masuk</p>
                <h3 class="text-xl font-black text-gray-950 tracking-tight">124,542 <span class="text-xs font-medium text-gray-400">Unit</span></h3>
                <p class="text-[10px] font-bold text-green-600 mt-1 flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">trending_up</span> +14% <span class="font-medium text-gray-400">bulan ini</span>
                </p>
            </div>
            <div class="glass-card p-5 rounded-[20px]">
                <div class="flex justify-between items-start mb-3">
                    <div class="w-9 h-9 bg-red-50 rounded-xl flex items-center justify-center text-red-600 shadow-sm">
                        <span class="material-symbols-outlined text-lg">done_all</span>
                    </div>
                </div>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-wider mb-1">Selesai Disortir</p>
                <h3 class="text-xl font-black text-gray-950 tracking-tight">98,210 <span class="text-xs font-medium text-gray-400">Unit</span></h3>
                <p class="text-[10px] font-bold text-green-600 mt-1 flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">trending_up</span> +8% <span class="font-medium text-gray-400">efisiensi meningkat</span>
                </p>
            </div>
            <div class="glass-card p-5 rounded-[20px]">
                <div class="flex justify-between items-start mb-3">
                    <div class="w-9 h-9 bg-red-50 rounded-xl flex items-center justify-center text-red-600 shadow-sm">
                        <span class="material-symbols-outlined text-lg">pending_actions</span>
                    </div>
                </div>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-wider mb-1">Tertunda (Pending)</p>
                <h3 class="text-xl font-black text-gray-950 tracking-tight">26,332 <span class="text-xs font-medium text-gray-400">Unit</span></h3>
                <p class="text-[10px] font-bold text-amber-600 mt-1 flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">hourglass_empty</span> Butuh Operator Tambahan
                </p>
            </div>
            <div class="glass-card p-5 rounded-[20px]">
                <div class="flex justify-between items-start mb-3">
                    <div class="w-9 h-9 bg-red-50 rounded-xl flex items-center justify-center text-red-600 shadow-sm">
                        <span class="material-symbols-outlined text-lg">gavel</span>
                    </div>
                </div>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-wider mb-1">Aset Rusak/Karantina</p>
                <h3 class="text-xl font-black text-gray-950 tracking-tight">1,404 <span class="text-xs font-medium text-gray-400">Unit</span></h3>
                <p class="text-[10px] font-bold text-red-600 mt-1 flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">warning</span> Menunggu Berita Acara
                </p>
            </div>
        </div>

        <div class="glass-card rounded-[24px] overflow-hidden mb-12">
            <div class="p-6 pb-0 border-b border-outline-variant">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-base font-black text-gray-950 tracking-tight">Log Aktivitas Penyortiran Terbaru</h3>
                    <div class="flex items-center gap-2">
                        <button class="inline-flex items-center gap-1.5 text-xs font-bold text-red-600 bg-red-50 px-4 py-2 rounded-full hover:bg-red-600 hover:text-white transition-all">
                            <span class="material-symbols-outlined text-sm">visibility</span> Lihat Semua
                        </button>
                    </div>
                </div>
                <div class="flex items-center gap-6 overflow-x-auto scrollbar-hide text-xs font-bold tracking-wide">
                    <button class="pb-3 text-red-600 border-b-2 border-red-600 whitespace-nowrap">Semua Tugas</button>
                    <button class="pb-3 text-gray-400 hover:text-gray-900 whitespace-nowrap transition-colors">Selesai Sortir</button>
                    <button class="pb-3 text-gray-400 hover:text-gray-900 whitespace-nowrap transition-colors flex items-center gap-1.5">
                        Menunggu Persetujuan Admin
                        <span class="bg-red-600 px-1.5 py-0.5 rounded-md text-[9px] text-white">2</span>
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/70 text-gray-400 text-[10px] uppercase tracking-widest font-bold border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 font-black">Operator Lapangan</th>
                            <th class="px-4 py-4 font-black">Tanggal Masuk</th>
                            <th class="px-4 py-4 font-black">Volume Aset</th>
                            <th class="px-4 py-4 font-black">Kategori Logistik</th>
                            <th class="px-4 py-4 font-black">Deskripsi Muatan</th>
                            <th class="px-4 py-4 font-black">Status Validasi</th>
                            <th class="px-6 py-4 font-black"></th>
                        </tr>
                    </thead>
                    <tbody class="text-xs divide-y divide-gray-100 font-medium text-gray-700">
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-gray-950">Savannah Nguyen</td>
                            <td class="px-4 py-4 text-gray-400">07/05/2026</td>
                            <td class="px-4 py-4 font-bold">2,500 Pcs</td>
                            <td class="px-4 py-4">Network Device</td>
                            <td class="px-4 py-4 text-gray-400 truncate max-w-[150px]">ONT Modems Huawei HG8245H5...</td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[9px] font-bold bg-green-50 text-green-700 border border-green-200">
                                    <span class="w-1 h-1 rounded-full bg-green-700"></span> Disetujui
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="p-1.5 text-gray-400 hover:text-red-600 rounded-lg"><span class="material-symbols-outlined text-sm">more_horiz</span></button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-gray-950">Jerome Bell</td>
                            <td class="px-4 py-4 text-gray-400">07/05/2026</td>
                            <td class="px-4 py-4 font-bold">450 Pcs</td>
                            <td class="px-4 py-4">Infrastructure</td>
                            <td class="px-4 py-4 text-gray-400 truncate max-w-[150px]">Kabel FO Drop Core 1 Core...</td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[9px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1 h-1 rounded-full bg-amber-700"></span> Pending Admin
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="p-1.5 text-gray-400 hover:text-red-600 rounded-lg"><span class="material-symbols-outlined text-sm">more_horiz</span></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        // Fungsi untuk menutup modal notifikasi sukses secara halus
        function closeModal() {
            const modal = document.getElementById('success-modal');
            if (modal) {
                modal.classList.add('opacity-0', 'pointer-events-none');
                setTimeout(() => { modal.remove(); }, 300);
            }
        }

        // Efek mikro-interaksi hover pada kartu matriks statistik
        document.querySelectorAll('.glass-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-2px)';
                card.style.transition = 'transform 0.2s cubic-bezier(0.4, 0, 0.2, 1)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>