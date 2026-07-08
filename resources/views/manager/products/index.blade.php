<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Monitoring Stok Gudang | Telkomsel T-Track</title>
    
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

    <!-- SIDEBAR KIRI MANAGER -->
    <aside class="w-64 h-screen fixed left-0 top-0 bg-white border-r border-outline-variant flex flex-col py-6 px-4 space-y-2 z-50 overflow-y-auto">
        <div class="flex items-center gap-2.5 px-2 mb-8">
            <img src="{{ asset('images/telkomsel.svg') }}" alt="Logo Telkomsel" class="h-6 w-auto block object-contain select-none">
            <h1 class="font-black text-lg tracking-tight text-gray-900 dark:text-white leading-none">
                Telkomsel <span class="text-red-600">T-Track</span>
            </h1>
        </div>

        <div class="space-y-1">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-3 py-2">Management</p>
            
            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 font-semibold rounded-xl transition-colors" href="{{ route('manager.dashboard') }}">
                <span class="material-symbols-outlined">analytics</span>
                <span class="text-xs tracking-wide">Executive Dashboard</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 font-semibold rounded-xl transition-colors" href="{{ route('manager.reports.index') }}">
                <span class="material-symbols-outlined">assessment</span>
                <span class="text-xs tracking-wide">Laporan Distribusi</span>
            </a>

            <!-- Menu Aktif: Monitoring Stok -->
            <a class="flex items-center gap-3 px-4 py-3 text-red-600 bg-red-50 dark:bg-red-950/20 font-bold rounded-xl transition-colors" href="#">
                <span class="material-symbols-outlined">inventory</span>
                <span class="text-xs tracking-wide">Monitoring Stok Gudang</span>
            </a>
            
            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 font-semibold rounded-xl transition-colors" href="{{ route('manager.staff.index') }}">
                <span class="material-symbols-outlined">group</span>
                <span class="text-xs tracking-wide">Aktivitas Tim Staff</span>
            </a>
        </div>

        <div class="mt-auto pt-4 border-t border-outline-variant flex items-center gap-3 p-2 bg-gray-50 dark:bg-gray-800/50 rounded-2xl">
            <div class="w-9 h-9 bg-red-600 text-white font-black text-xs rounded-xl flex items-center justify-center shadow-md shadow-red-600/10">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div class="flex-1 overflow-hidden">
                <p class="text-xs font-black truncate text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
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
                <span class="text-gray-900 dark:text-white">Monitoring Stok</span>
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
                    <p class="text-[10px] text-gray-400 font-semibold">Regional Manager</p>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN WORKSPACE -->
    <main class="ml-64 p-8 min-h-screen">
        
        <!-- Header Judul -->
        <div class="mb-6">
            <h2 class="text-xl font-black tracking-tight text-gray-950 dark:text-white">Audit & Monitoring Stok Gudang</h2>
            <p class="text-xs text-gray-400 mt-0.5">Pantau volume kesediaan perangkat logistik internal secara real-time harian.</p>
        </div>

        <!-- STATISTIK RINGKASAN ATAS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div class="glass-card p-5 rounded-[20px] flex items-center gap-4">
                <div class="w-10 h-10 bg-blue-50 dark:bg-blue-950/40 rounded-xl flex items-center justify-center text-blue-600 shadow-sm flex-shrink-0">
                    <span class="material-symbols-outlined text-xl">warehouse</span>
                </div>
                <div>
                    <p class="text-gray-400 font-bold text-[10px] uppercase tracking-wider mb-0.5">Stok Layak Operasional (Bagus)</p>
                    <h3 class="text-lg font-black text-gray-950 dark:text-white tracking-tight">{{ number_format($totalStockBagus) }} <span class="text-xs font-medium text-gray-400">Unit</span></h3>
                </div>
            </div>
            <div class="glass-card p-5 rounded-[20px] flex items-center gap-4">
                <div class="w-10 h-10 bg-red-50 dark:bg-red-950/40 rounded-xl flex items-center justify-center text-red-600 shadow-sm flex-shrink-0">
                    <span class="material-symbols-outlined text-xl">report</span>
                </div>
                <div>
                    <p class="text-gray-400 font-bold text-[10px] uppercase tracking-wider mb-0.5">Item Kritis Menipis (Stok ≤ 5)</p>
                    <h3 class="text-lg font-black text-red-600 dark:text-red-400 tracking-tight">{{ $totalItemsKritis }} <span class="text-xs font-medium text-gray-400">Barang</span></h3>
                </div>
            </div>
        </div>

        <!-- FORM FILTER & PENCARIAN -->
        <div class="glass-card rounded-[24px] p-4 mb-6">
            <form action="{{ route('manager.products.index') }}" method="GET" class="flex flex-col md:flex-row gap-3 items-stretch md:items-center w-full">
                <div class="relative flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama perangkat..." class="w-full pl-10 pr-4 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900 text-xs font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all">
                    <span class="material-symbols-outlined text-gray-400 text-lg absolute left-3 top-2.5">search</span>
                </div>

                <div class="w-full md:w-48">
                    <select name="category_id" onchange="this.form.submit()" class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900 text-xs font-bold focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all cursor-pointer">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full md:w-44">
                    <select name="condition" onchange="this.form.submit()" class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900 text-xs font-bold focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all cursor-pointer">
                        <option value="">Semua Kondisi</option>
                        <option value="Bagus" {{ request('condition') == 'Bagus' ? 'selected' : '' }}>Bagus (Ready)</option>
                        <option value="Rusak Ringan" {{ request('condition') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="Rusak Berat" {{ request('condition') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                </div>

                @if(request('search') || request('condition') || request('category_id'))
                    <a href="{{ route('manager.products.index') }}" class="inline-flex items-center justify-center text-xs font-bold text-gray-500 hover:text-red-600 px-3 transition-colors">Reset</a>
                @endif
            </form>
        </div>

        <!-- DATA STOCK TABLE -->
        <div class="glass-card rounded-[24px] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/70 dark:bg-gray-900 text-gray-400 text-[10px] uppercase tracking-widest font-bold border-b border-gray-100 dark:border-gray-800">
                        <tr>
                            <th class="px-6 py-4">Kode Perangkat</th>
                            <th class="px-4 py-4">Nama Logistik / Tipe</th>
                            <th class="px-4 py-4">Kategori</th>
                            <th class="px-4 py-4 text-center">Kondisi Fisik</th>
                            <th class="px-6 py-4 text-right">Volume Tersedia</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs divide-y divide-gray-100 dark:divide-gray-800 font-medium text-gray-700 dark:text-gray-300">
                        @forelse($products as $prod)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors">
                            <td class="px-6 py-4 font-mono font-bold text-red-600 dark:text-red-400">[{{ $prod->product_code }}]</td>
                            <td class="px-4 py-4 font-bold text-gray-950 dark:text-white">{{ $prod->name }}</td>
                            <td class="px-4 py-4 text-gray-400">{{ $prod->category->name ?? 'Umum' }}</td>
                            <td class="px-4 py-4 text-center whitespace-nowrap">
                                @if($prod->condition === 'Bagus')
                                    <span class="px-2.5 py-1 rounded-full text-[9px] font-bold bg-green-50 text-green-700 border border-green-200 dark:border-green-900/20 dark:bg-green-950/20">Bagus</span>
                                @elseif($prod->condition === 'Rusak Ringan')
                                    <span class="px-2.5 py-1 rounded-full text-[9px] font-bold bg-amber-50 text-amber-700 border border-amber-200 dark:border-amber-900/20 dark:bg-amber-950/20">Rusak Ringan</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[9px] font-bold bg-red-50 text-red-700 border border-red-200 dark:border-red-900/20 dark:bg-red-950/20">Rusak Berat</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap font-black">
                                @if($prod->condition === 'Bagus' && $prod->stock <= 5)
                                    <span class="text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-950/30 px-2 py-1 rounded-lg animate-pulse">
                                        {{ $prod->stock }} Pcs (Kritis)
                                    </span>
                                @else
                                    <span class="text-gray-900 dark:text-white">{{ $prod->stock }} Pcs</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-400">
                                <span class="material-symbols-outlined text-3xl block mb-2">inventory_2</span>
                                Log muatan logistik gudang tidak ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
            <div class="p-4 border-t border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/40">
                {{ $products->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </main>

    <!-- INTEGRASI SCRIPT NAVIGASI TEMA -->
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
            } else {
                document.documentElement.classList.remove('light');
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });

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