<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Laporan Distribusi Ekskutif | Telkomsel T-Track</title>
    
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

        /* Aturan Cetak Laporan Formal Berita Acara Regional */
        @media print {
            aside, header, .no-print, #theme-toggle { display: none !important; }
            main { margin-left: 0 !important; padding: 0 !important; max-width: 100% !important; width: 100% !important; }
            .glass-card { border: none !important; box-shadow: none !important; background: transparent !important; }
            body { background-color: #fff !important; color: #000 !important; }
        }
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

    <aside class="w-64 h-screen fixed left-0 top-0 bg-white border-r border-outline-variant flex flex-col py-6 px-4 space-y-2 z-50 overflow-y-auto no-print">
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

            <a class="flex items-center gap-3 px-4 py-3 text-red-600 bg-red-50 dark:bg-red-950/20 font-bold rounded-xl transition-colors" href="#">
                <span class="material-symbols-outlined">assessment</span>
                <span class="text-xs tracking-wide">Laporan Distribusi</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 font-semibold rounded-xl transition-colors" href="{{ route('manager.products.index') }}">
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

    <header class="h-16 w-full sticky top-0 z-40 bg-white/80 dark:bg-gray-950/80 backdrop-blur-md border-b border-outline-variant/60 flex justify-between items-center px-8 ml-64 max-w-[calc(100%-16rem)] no-print">
        <div class="flex items-center gap-2 text-gray-400">
            <nav class="flex items-center gap-2 text-xs font-bold tracking-wide">
                <span class="text-gray-400">Pages</span>
                <span class="text-gray-300">/</span>
                <span class="text-gray-900 dark:text-white">Laporan Distribusi</span>
            </nav>
        </div>
        
        <div class="flex items-center gap-4">
            <button id="theme-toggle" class="p-2 text-gray-500 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-full transition-all flex items-center justify-center">
                <span id="theme-toggle-dark-icon" class="material-symbols-outlined text-xl hidden">dark_mode</span>
                <span id="theme-toggle-light-icon" class="material-symbols-outlined text-xl hidden">light_mode</span>
            </button>
            <button class="p-2 text-gray-500 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-full transition-all">
                <span class="material-symbols-outlined text-xl">notifications</span>
            </button>
            <div class="w-px h-5 bg-gray-200 dark:bg-gray-800"></div>
            <div class="flex items-center gap-2.5 pl-2">
                <div class="text-right hidden xl:block">
                    <p class="text-xs font-black text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-gray-400 font-semibold">{{ Auth::user()->role->name ?? 'Regional Manager' }} T-Track</p>
                </div>
            </div>
        </div>
    </header>

    <main class="ml-64 p-8 min-h-screen">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h2 class="text-xl font-black tracking-tight text-gray-950 dark:text-white">Berkas Rekap Laporan Sirkulasi</h2>
                <p class="text-xs text-gray-400 mt-0.5">Analisis dan ekspor jangkauan lalu lintas penempatan material perangkat infrastruktur.</p>
            </div>
            <button onclick="window.print()" class="inline-flex items-center gap-2 text-xs font-black bg-gray-950 dark:bg-gray-800 text-white px-5 py-3 rounded-full hover:bg-black shadow-md transition-all no-print">
                <span class="material-symbols-outlined text-sm">print</span> Cetak & Ekspor PDF
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div class="glass-card p-5 rounded-[20px] flex items-center gap-4">
                <div class="w-10 h-10 bg-red-50 dark:bg-red-950/40 rounded-xl flex items-center justify-center text-red-600 shadow-sm flex-shrink-0">
                    <span class="material-symbols-outlined text-xl">output_circle</span>
                </div>
                <div>
                    <p class="text-gray-400 font-bold text-[10px] uppercase tracking-wider mb-0.5">Volume Aset Terdistribusi</p>
                    <h3 class="text-lg font-black text-gray-950 dark:text-white tracking-tight">{{ number_format($totalItemsDistributed) }} <span class="text-xs font-medium text-gray-400">Pcs</span></h3>
                </div>
            </div>
            <div class="glass-card p-5 rounded-[20px] flex items-center gap-4">
                <div class="w-10 h-10 bg-green-50 dark:bg-green-950/40 rounded-xl flex items-center justify-center text-green-700 shadow-sm flex-shrink-0">
                    <span class="material-symbols-outlined text-xl">assignment_turned_in</span>
                </div>
                <div>
                    <p class="text-gray-400 font-bold text-[10px] uppercase tracking-wider mb-0.5">Total Dokumen Sirkulasi Terbaca</p>
                    <h3 class="text-lg font-black text-gray-950 dark:text-white tracking-tight">{{ $reports->total() }} <span class="text-xs font-medium text-gray-400">Berkas</span></h3>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-[24px] p-4 mb-6 no-print">
            <form action="{{ route('manager.reports.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-3 items-end">
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Mulai Tanggal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900 text-xs font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all">
                </div>
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900 text-xs font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all">
                </div>
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">Filter Status</label>
                    <select name="status" class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900 text-xs font-bold focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 py-2 text-xs font-black bg-red-600 text-white rounded-xl hover:bg-red-700 shadow-md transition-all">Filter</button>
                    @if(request('start_date') || request('end_date') || request('status'))
                        <a href="{{ route('manager.reports.index') }}" class="px-3 py-2 text-xs font-bold border border-gray-200 dark:border-gray-800 text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-xl flex items-center justify-center transition-all">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="glass-card rounded-[24px] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/70 dark:bg-gray-900 text-gray-400 text-[10px] uppercase tracking-widest font-bold border-b border-gray-100 dark:border-gray-800">
                        <tr>
                            <th class="px-6 py-4">ID Transaksi</th>
                            <th class="px-4 py-4">Peminjam Aset</th>
                            <th class="px-4 py-4">Spesifikasi Material</th>
                            <th class="px-4 py-4 text-center">Volume</th>
                            <th class="px-4 py-4">Tanggal Alokasi</th>
                            <th class="px-6 py-4 text-center">Status Akhir</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs divide-y divide-gray-100 dark:divide-gray-800 font-medium text-gray-700 dark:text-gray-300">
                        @forelse($reports as $item)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors">
                            <td class="px-6 py-4 font-bold text-gray-400">#TRX-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-4 py-4">
                                <div class="font-bold text-gray-950 dark:text-white">{{ $item->user->name ?? 'User Terhapus' }}</div>
                                <div class="text-[10px] font-semibold text-gray-400 mt-0.5">{{ $item->user->role->name ?? 'Staff' }}</div>
                            </td>
                            <td class="px-4 py-4">
                                @foreach($item->details as $detail)
                                    <div class="leading-tight mb-1 last:mb-0">
                                        <p class="font-bold text-gray-900 dark:text-gray-100">{{ $detail->product->name ?? 'Aset Terhapus' }}</p>
                                        <p class="text-[10px] text-gray-400 font-mono">Code: {{ $detail->product->product_code ?? '-' }} | {{ $detail->product->category->name ?? 'Umum' }}</p>
                                    </div>
                                @endforeach
                            </td>
                            <td class="px-4 py-4 text-center font-bold text-gray-950 dark:text-white">
                                @foreach($item->details as $detail)
                                    <div>{{ $detail->qty }} Pcs</div>
                                @endforeach
                            </td>
                            <td class="px-4 py-4 text-gray-400 leading-normal font-medium">
                                <div><span class="text-[10px] font-bold text-green-600">Pinjam :</span> {{ \Carbon\Carbon::parse($item->borrow_date)->format('d/m/Y') }}</div>
                                <div><span class="text-[10px] font-bold text-red-500">Tenggat :</span> {{ $item->return_date ? \Carbon\Carbon::parse($item->return_date)->format('d/m/Y') : '-' }}</div>
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                @if($item->status === 'Dipinjam')
                                    <span class="px-2.5 py-1 rounded-full text-[9px] font-bold bg-amber-50 text-amber-700 border border-amber-200 dark:border-amber-900/20 dark:bg-amber-950/20">Dipinjam</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[9px] font-bold bg-green-50 text-green-700 border border-green-200 dark:border-green-900/20 dark:bg-green-950/20">Dikembalikan</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-gray-400">
                                <span class="material-symbols-outlined text-3xl block mb-2">find_in_page</span>
                                Tidak ada rekaman data sirkulasi untuk parameter pencarian periode ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($reports->hasPages())
            <div class="p-4 border-t border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/40 no-print">
                {{ $reports->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </main>

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