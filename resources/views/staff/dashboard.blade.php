<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dasbor Staff | Telkomsel T-Track</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
                        "primary": "#dc2626",
                        "on-background": "#111317",
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
            font-family: 'Inter', sans-serif; background-color: #f8f9fa; color: #111317; -webkit-font-smoothing: antialiased;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24; }
        .glass-card {
            background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(8px); border: 1px solid rgba(229, 231, 235, 0.6);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.02), 0 10px 10px -5px rgba(0, 0, 0, 0.01);
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .pro-gradient { background: linear-gradient(135deg, #111317 0%, #dc2626 100%); }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

        .dark body { background-color: #0b0c0e; color: #f3f4f6; }
        .dark aside, .dark header, .dark .glass-card { background-color: #111317; border-color: #1f242e; color: #f3f4f6; }
        .dark .text-gray-950, .dark .text-gray-900 { color: #ffffff; }
        .dark .text-gray-600, .dark .text-gray-400 { color: #9ca3af; }
        .dark .bg-gray-50 { background-color: #1f242e; }
        .dark tr:hover { background-color: #1f242e; }
    </style>
    
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('light');
        } else {
            document.documentElement.classList.add('light');
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="text-on-surface antialiased">

    <!-- SIDEBAR KIRI STAFF -->
    <aside class="w-64 h-screen fixed left-0 top-0 bg-white border-r border-outline-variant flex flex-col py-6 px-4 space-y-2 z-50 overflow-y-auto">
        <div class="flex items-center gap-2.5 px-2 mb-8">
            <img src="{{ asset('images/telkomsel.svg') }}" alt="Logo Telkomsel" class="h-6 w-auto block object-contain select-none">
            <h1 class="font-black text-lg tracking-tight text-gray-900 dark:text-white leading-none">
                Telkomsel <span class="text-red-600">T-Track</span>
            </h1>
        </div>

        <div class="space-y-1">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-3 py-2">General</p>
            <!-- Navigasi Aktif: Dasbor Staff -->
            <a class="flex items-center gap-3 px-4 py-3 text-red-600 bg-red-50 dark:bg-red-950/20 font-bold rounded-xl transition-colors" href="#">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-xs tracking-wide">Dashboard Saya</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 font-semibold rounded-xl transition-colors" 
            href="{{ route('staff.products.index') }}">
                <span class="material-symbols-outlined">inventory_2</span>
                <span class="text-xs tracking-wide">Master Data Logistik</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 font-semibold rounded-xl transition-colors" 
            href="{{ route('staff.transactions.index') }}">
                <span class="material-symbols-outlined">swap_horiz</span>
                <span class="text-xs tracking-wide">Transaksi</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 {{ Request::routeIs('staff.history.index') ? 'text-red-600 bg-red-50 dark:bg-red-950/20 font-bold' : 'text-gray-600 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 font-semibold' }} rounded-xl transition-colors" 
            href="{{ route('staff.history.index') }}">
                <span class="material-symbols-outlined">history</span>
                <span class="text-xs tracking-wide">Riwayat</span>
            </a>
        </div>

        <div class="mt-auto pt-4 border-t border-outline-variant flex items-center gap-3 p-2 bg-gray-50 dark:bg-gray-800/50 rounded-2xl">
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

    <!-- HEADER BAR -->
    <header class="h-16 w-full sticky top-0 z-40 bg-white/80 dark:bg-gray-950/80 backdrop-blur-md border-b border-outline-variant/60 flex justify-between items-center px-8 ml-64 max-w-[calc(100%-16rem)]">
        <div class="flex items-center gap-2 text-gray-400">
            <nav class="flex items-center gap-2 text-xs font-bold tracking-wide">
                <span class="text-gray-400">Pages</span>
                <span class="text-gray-300">/</span>
                <span class="text-gray-900 dark:text-white">Workspace Staff</span>
            </nav>
        </div>
        
        <div class="flex items-center gap-4">
            <button id="theme-toggle" class="p-2 text-gray-500 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-full transition-all flex items-center justify-center">
                <span id="theme-toggle-dark-icon" class="material-symbols-outlined text-xl hidden">dark_mode</span>
                <span id="theme-toggle-light-icon" class="material-symbols-outlined text-xl hidden">light_mode</span>
            </button>
            <div class="w-px h-5 bg-gray-200 dark:bg-gray-800"></div>
            <div class="flex items-center gap-2.5 pl-2">
                <div class="text-right hidden xl:block">
                    <p class="text-xs font-black text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-gray-400 font-semibold">Staff Lapangan T-Track</p>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTEXT WORKSPACE -->
    <main class="ml-64 p-8 min-h-screen">
        
        <!-- Welcome Banner Card -->
        <section class="pro-gradient rounded-[24px] p-8 mb-8 text-white relative overflow-hidden flex justify-between items-center group shadow-lg shadow-red-900/5">
            <div class="relative z-10 space-y-2">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">badge</span>
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-90">Panel Kendali Distribusi Perangkat Staff</p>
                </div>
                <h2 class="text-2xl font-black tracking-tight max-w-xl">Halo, {{ Auth::user()->name }}! Pantau Perangkat Operasional Anda</h2>
                <p class="text-xs opacity-80 font-normal">Gunakan lembar kerja ini untuk melihat barang inventaris yang Anda bawa, riwayat sirkulasi personal, serta ketersediaan unit siap pasang di gudang.</p>
            </div>
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-white/5 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-700"></div>
        </section>

        <!-- Section Title -->
        <div class="flex justify-between items-end mb-6">
            <h2 class="text-lg font-black tracking-tight text-gray-950 dark:text-white">Statistik Alat & Bahan Saya</h2>
            <div class="flex items-center gap-2 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 px-4 py-2 rounded-xl text-xs font-bold text-gray-600">
                <span class="material-symbols-outlined text-sm">hourglass_empty</span> Sinkronisasi Berhasil
            </div>
        </div>

        <!-- KARTU STATISTIK INDIVIDU -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- 1. Sedang Dipinjam -->
            <div class="glass-card p-5 rounded-[20px]">
                <div class="flex justify-between items-start mb-3">
                    <div class="w-9 h-9 bg-amber-50 dark:bg-amber-950/40 rounded-xl flex items-center justify-center text-amber-700 shadow-sm">
                        <span class="material-symbols-outlined text-lg">engineering</span>
                    </div>
                </div>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-wider mb-1">Aset di Tangan Saya</p>
                <h3 class="text-xl font-black text-gray-950 dark:text-white tracking-tight">{{ number_format($myBorrowedAset) }} <span class="text-xs font-medium text-gray-400">Pcs</span></h3>
                <p class="text-[10px] font-bold text-amber-600 mt-1">Harus dikembalikan setelah selesai tugas</p>
            </div>

            <!-- 2. Selesai Di audit / Dikembalikan -->
            <div class="glass-card p-5 rounded-[20px]">
                <div class="flex justify-between items-start mb-3">
                    <div class="w-9 h-9 bg-green-50 dark:bg-green-950/40 rounded-xl flex items-center justify-center text-green-700 shadow-sm">
                        <span class="material-symbols-outlined text-lg">assignment_turned_in</span>
                    </div>
                </div>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-wider mb-1">Total Selesai Audit</p>
                <h3 class="text-xl font-black text-gray-950 dark:text-white tracking-tight">{{ number_format($myReturnedCount) }} <span class="text-xs font-medium text-gray-400">Transaksi</span></h3>
                <p class="text-[10px] font-bold text-green-600 mt-1">Aset aman terverifikasi gudang</p>
            </div>

            <!-- 3. Stok Gudang Tersedia -->
            <div class="glass-card p-5 rounded-[20px]">
                <div class="flex justify-between items-start mb-3">
                    <div class="w-9 h-9 bg-red-50 dark:bg-red-950/40 rounded-xl flex items-center justify-center text-red-600 shadow-sm">
                        <span class="material-symbols-outlined text-lg">gite</span>
                    </div>
                </div>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-wider mb-1">Stok Aset Ready Gudang</p>
                <h3 class="text-xl font-black text-gray-950 dark:text-white tracking-tight">{{ number_format($totalAsetReady) }} <span class="text-xs font-medium text-gray-400">Unit</span></h3>
                <p class="text-[10px] font-bold text-gray-400 mt-1">Tersedia untuk pengajuan pinjam baru</p>
            </div>
        </div>

        <!-- AREA CHART & KATEGORI FAVORIT -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="glass-card p-6 rounded-[24px] lg:col-span-2 flex flex-col justify-between">
                <div>
                    <h3 class="text-sm font-black text-gray-950 dark:text-white tracking-tight mb-1">Tren Pengambilan Alat Perangkat Saya</h3>
                    <p class="text-[11px] text-gray-400 font-medium">Grafik kuantitas volume logistik yang Anda pinjam selama tahun berjalan.</p>
                </div>
                <div class="w-full mt-4 h-64 relative flex items-center justify-center">
                    <canvas id="staffBorrowingChart"></canvas>
                </div>
            </div>

            <!-- Kategori Terpopuler Khas Staff -->
            <div class="glass-card p-6 rounded-[24px] flex flex-col justify-between">
                <div>
                    <h3 class="text-sm font-black text-gray-950 dark:text-white tracking-tight mb-1">Alokasi Muatan Terbanyak</h3>
                    <p class="text-[11px] text-gray-400 font-medium">Jenis material logistik yang paling sering Anda gunakan di lapangan.</p>
                </div>
                <div class="space-y-3.5 my-4">
                    @forelse($myCategories as $cat)
                    <div class="space-y-1">
                        <div class="flex justify-between text-[11px] font-bold">
                            <span>{{ $cat->name }}</span>
                            <span class="text-red-600">{{ $cat->percentage }}%</span>
                        </div>
                        <div class="w-full bg-gray-100 dark:bg-gray-800 h-2 rounded-full overflow-hidden">
                            <div class="bg-red-600 h-full rounded-full transition-all duration-500" 
                                style="width: {!! $cat->percentage !!}%">
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-xs text-gray-400 py-4">Belum ada komoditas terdaftar.</p>
                    @endforelse
                </div>
                <div class="pt-3 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between text-[10px] font-bold text-gray-400">
                    <span>Data ter-update real-time</span>
                    <span class="material-symbols-outlined text-xs text-green-600 animate-pulse">sync</span>
                </div>
            </div>
        </div>

        <!-- TABLE LOG TRANS AKHIR PERSONAL STAFF -->
        <div class="glass-card rounded-[24px] overflow-hidden mb-12">
            <div class="p-6 pb-0 border-b border-outline-variant">
                <h3 class="text-base font-black text-gray-950 dark:text-white tracking-tight mb-4">Eksplorasi Transaksi Terakhir Saya</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/70 dark:bg-gray-900 text-gray-400 text-[10px] uppercase tracking-widest font-bold border-b border-gray-100 dark:border-gray-800">
                        <tr>
                            <th class="px-6 py-4 font-black">ID TRX</th>
                            <th class="px-4 py-4 font-black">Tanggal Ambil</th>
                            <th class="px-4 py-4 font-black">Volume Muatan</th>
                            <th class="px-4 py-4 font-black">Detail Nama Barang</th>
                            <th class="px-4 py-4 font-black">Status Saya</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs divide-y divide-gray-100 dark:divide-gray-800 font-medium text-gray-700 dark:text-gray-300">
                        @forelse($myRecentLogs as $log)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-gray-400">#TRX-{{ str_pad($log->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-4 py-4 text-gray-400">{{ \Carbon\Carbon::parse($log->borrow_date)->format('d/m/Y') }}</td>
                            <td class="px-4 py-4 font-bold">
                                @foreach($log->details as $detail)
                                    <div>{{ $detail->qty }} Pcs</div>
                                @endforeach
                            </td>
                            <td class="px-4 py-4 truncate max-w-[200px]">
                                @foreach($log->details as $detail)
                                    <div>{{ $detail->product->name ?? 'Aset Terhapus' }}</div>
                                @endforeach
                            </td>
                            <td class="px-4 py-4">
                                @if($log->status === 'Dipinjam')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[9px] font-bold bg-amber-50 text-amber-700 border border-amber-200 dark:border-amber-900/30 dark:bg-amber-950/20">
                                        <span class="w-1 h-1 rounded-full bg-amber-700"></span> Masih Dibawa
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[9px] font-bold bg-green-50 text-green-700 border border-green-200 dark:border-green-900/30 dark:bg-green-950/20">
                                        <span class="w-1 h-1 rounded-full bg-green-700"></span> Dikembalikan
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-400">Anda belum melakukan sirkulasi peminjaman perangkat pendukung lapangan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- KONTROL SINKRON TEMA & CHART SINKRON -->
    <script>
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        if (document.documentElement.classList.contains('dark')) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        const themeToggleBtn = document.getElementById('theme-toggle');
        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
                localStorage.setItem('theme', 'light');
                updateChartTheme('light'); 
            } else {
                document.documentElement.classList.remove('light');
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                updateChartTheme('dark'); 
            }
        });

        document.querySelectorAll('.glass-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-2px)';
                card.style.transition = 'transform 0.2s cubic-bezier(0.4, 0, 0.2, 1)';
            });
            card.addEventListener('mouseleave', () => { card.style.transform = 'translateY(0)'; });
        });

        // ==========================================
        // 📉 RENDER GRAFIK SINKRON (ANTI ERROR VS CODE)
        // ==========================================
        const ctx = document.getElementById('staffBorrowingChart').getContext('2d');

        const getGridColor = () => document.documentElement.classList.contains('dark') ? '#1f242e' : '#e5e7eb';
        const getTextColor = () => document.documentElement.classList.contains('dark') ? '#9ca3af' : '#4b5563';

        const borrowingChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Volume Pinjam Saya',
                    data: JSON.parse('{!! json_encode($monthlyData) !!}'), 
                    borderColor: '#dc2626', 
                    borderWidth: 3,
                    pointBackgroundColor: '#dc2626',
                    pointHoverRadius: 7,
                    tension: 0.35, 
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: getTextColor(), font: { family: 'Inter', size: 10, weight: '600' } }
                    },
                    y: {
                        grid: { color: getGridColor(), drawTicks: false },
                        border: { dash: [5, 5] },
                        ticks: { color: getTextColor(), font: { family: 'Inter', size: 10 } }
                    }
                }
            }
        });

        function updateChartTheme(theme) {
            const isDark = theme === 'dark';
            borrowingChart.options.scales.x.ticks.color = isDark ? '#9ca3af' : '#4b5563';
            borrowingChart.options.scales.y.ticks.color = isDark ? '#9ca3af' : '#4b5563';
            borrowingChart.options.scales.y.grid.color = isDark ? '#1f242e' : '#e5e7eb';
            borrowingChart.update();
        }
    </script>
</body>
</html>