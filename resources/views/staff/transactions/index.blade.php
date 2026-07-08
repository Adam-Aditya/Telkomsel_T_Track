<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sirkulasi Transaksi Saya | Telkomsel T-Track Staff</title>
    
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

    @if(session('success'))
    <div id="success-toast" class="fixed bottom-5 right-5 z-[110] bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-4 rounded-2xl shadow-xl flex items-center gap-3 animate-bounce">
        <span class="material-symbols-outlined text-green-600">check_circle</span>
        <p class="text-xs font-bold text-gray-950 dark:text-white">{{ session('success') }}</p>
    </div>
    <script>setTimeout(() => { document.getElementById('success-toast').remove(); }, 4000);</script>
    @endif

    <aside class="w-64 h-screen fixed left-0 top-0 bg-white border-r border-outline-variant flex flex-col py-6 px-4 space-y-2 z-50 overflow-y-auto">
        <div class="flex items-center gap-2.5 px-2 mb-8">
            <img src="{{ asset('images/telkomsel.svg') }}" alt="Logo Telkomsel" class="h-6 w-auto block object-contain select-none">
            <h1 class="font-black text-lg tracking-tight text-gray-900 dark:text-white leading-none">
                Telkomsel <span class="text-red-600">T-Track</span>
            </h1>
        </div>

        <div class="space-y-1">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-3 py-2">General</p>
            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 font-semibold rounded-xl transition-colors" href="{{ route('staff.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-xs tracking-wide">Dashboard Saya</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 font-semibold rounded-xl transition-colors" href="{{ route('staff.products.index') }}">
                <span class="material-symbols-outlined">inventory_2</span>
                <span class="text-xs tracking-wide">Master Data Logistik</span>
            </a>
            
            <a class="flex items-center gap-3 px-4 py-3 text-red-600 bg-red-50 dark:bg-red-950/20 font-bold rounded-xl transition-colors" href="#">
                <span class="material-symbols-outlined">swap_horiz</span>
                <span class="text-xs tracking-wide">Transaksi</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 {{ Request::routeIs('staff.history.index') ? 'text-red-600 bg-red-50 dark:bg-red-950/20 font-bold' : 'text-gray-600 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 font-semibold' }} rounded-xl transition-colors" 
            href="{{ route('staff.history.index') }}">
                <span class="material-symbols-outlined">history</span>
                <span class="text-xs tracking-wide">Riwayat</span>
            </a>
        </div>

        <div class="mt-auto pt-4 border-t border-outline-variant flex items-center gap-3 p-2 bg-gray-50 rounded-2xl dark:bg-gray-800/50">
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

    <header class="h-16 w-full sticky top-0 z-40 bg-white/80 dark:bg-gray-950/80 backdrop-blur-md border-b border-outline-variant/60 flex justify-between items-center px-8 ml-64 max-w-[calc(100%-16rem)]">
        <div class="flex items-center gap-2 text-gray-400">
            <nav class="flex items-center gap-2 text-xs font-bold tracking-wide">
                <span class="text-gray-400">Pages</span>
                <span class="text-gray-300">/</span>
                <span class="text-gray-900 dark:text-white">Transaksi Saya</span>
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

    <main class="ml-64 p-8 min-h-screen">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h2 class="text-xl font-black tracking-tight text-gray-950 dark:text-white">Alur Sirkulasi Aset Personal</h2>
                <p class="text-xs text-gray-400 mt-0.5">Ajukan permintaan peminjaman material lapangan dan lakukan konfirmasi pengembalian mandiri.</p>
            </div>
            <button onclick="openTransactionModal()" class="inline-flex items-center gap-2 text-xs font-black bg-red-600 text-white px-5 py-3 rounded-full hover:bg-red-700 shadow-md shadow-red-600/10 transition-all">
                <span class="material-symbols-outlined text-sm">add_shopping_cart</span> Buat Pengajuan Baru
            </button>
        </div>

        <div class="glass-card rounded-[24px] p-4 mb-6 flex flex-col sm:flex-row gap-4 items-center justify-between">
            <div class="text-xs font-bold text-gray-500 dark:text-gray-400">
                Menampilkan log sirkulasi perangkat khusus akun Anda.
            </div>
        </div>

        <div class="glass-card rounded-[24px] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/70 dark:bg-gray-900 text-gray-400 text-[10px] uppercase tracking-widest font-bold border-b border-gray-100 dark:border-gray-800">
                        <tr>
                            <th class="px-6 py-4">Nama Peminjam</th>
                            <th class="px-4 py-4">Tanggal Pinjam</th>
                            <th class="px-4 py-4">Tenggat Kembali</th>
                            <th class="px-4 py-4">Otorisator Staff</th>
                            <th class="px-4 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi Cepat</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs divide-y divide-gray-100 dark:divide-gray-800 font-medium text-gray-700 dark:text-gray-300">
                        @forelse($transactions as $trans)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors">
                            <td class="px-6 py-4 font-bold text-gray-950 dark:text-white">
                                {{ $trans->user->name ?? 'User Tidak Ditemukan' }}
                                
                                <div class="mt-1 text-[10px] font-medium text-gray-400 space-y-0.5">
                                    @foreach($trans->details as $detail)
                                        <div>
                                            <span class="text-red-600 dark:text-red-400 font-bold">[{{ $detail->product->product_code ?? 'N/A' }}]</span> 
                                            {{ $detail->product->name ?? 'Aset Terhapus' }} 
                                            <span class="font-black text-gray-900 dark:text-white">({{ $detail->qty }} Pcs)</span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-4 py-4 text-gray-400">{{ \Carbon\Carbon::parse($trans->borrow_date)->format('d/m/Y') }}</td>
                            <td class="px-4 py-4 text-gray-400">{{ $trans->return_date ? \Carbon\Carbon::parse($trans->return_date)->format('d/m/Y') : '-' }}</td>
                        

                            <td class="px-4 py-4">
                                <span class="font-semibold text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-800 px-2.5 py-1 rounded-md text-[11px]">
                                    {{ $trans->user->role->name ?? 'Staff' }}
                                </span>
                            </td>
                                                        
                            <td class="px-4 py-4">
                                @if($trans->status === 'Dipinjam')
                                    <span class="px-2.5 py-1 rounded-full text-[9px] font-bold bg-amber-50 text-amber-700 border border-amber-200 dark:border-amber-900/20 dark:bg-amber-950/20">Dipinjam</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[9px] font-bold bg-green-50 text-green-700 border border-green-200 dark:border-green-900/20 dark:bg-green-950/20">Dikembalikan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                @if($trans->status === 'Dipinjam')
                                    <form action="{{ route('staff.transactions.return', $trans->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="inline-flex items-center gap-1 text-[10px] font-black bg-green-600 text-white px-3 py-1.5 rounded-full hover:bg-green-700 shadow-sm transition-all">
                                            <span class="material-symbols-outlined text-xs">assignment_return</span> Kembalikan
                                        </button>
                                    </form>
                                @else
                                    <span class="text-[10px] text-gray-400 font-semibold px-3 py-1.5 bg-gray-50 dark:bg-gray-800 rounded-full select-none">Selesai Audit</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-10 text-gray-400">
                                <span class="material-symbols-outlined text-3xl block mb-2">swap_horizontal_circle</span>
                                Belum ada sirkulasi transaksi aktif saat ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($transactions->hasPages())
            <div class="p-4 border-t border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/40">
                {{ $transactions->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </main>

    <div id="create-transaction-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white dark:bg-gray-900 w-full max-w-md rounded-[28px] p-6 shadow-2xl border border-gray-100 dark:border-gray-800 transform scale-95 transition-all duration-300 space-y-4">
            
            <div class="flex justify-between items-center pb-2 border-b border-gray-100 dark:border-gray-800">
                <div>
                    <h3 class="text-base font-black text-gray-950 dark:text-white tracking-tight">Form Transaksi Baru</h3>
                    <p class="text-[11px] text-gray-400">Registrasi sirkulasi peminjaman perangkat internal.</p>
                </div>
                <button onclick="closeTransactionModal()" class="p-1.5 text-gray-400 hover:text-red-600 rounded-full transition-colors">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>

            <form action="{{ route('staff.transactions.store') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                
                <div class="space-y-1.5">
                    <label class="font-bold text-gray-700 dark:text-gray-300">Pilih Akun Peminjam (User / Staff)</label>
                    <select name="user_id" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all cursor-pointer">
                        <option value="" disabled selected hidden>Pilih nama staff peminjam...</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->role->name ?? 'Staff' }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div class="col-span-2 space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Pilih Aset Logistik</label>
                        <select name="product_id" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all cursor-pointer">
                            <option value="" disabled selected hidden>Pilih barang...</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product_code }} - {{ $product->name }} (Stok: {{ $product->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Qty (Pcs)</label>
                        <input type="number" name="quantity" min="1" value="1" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Tanggal Pinjam</label>
                        <input type="date" name="borrow_date" value="{{ date('Y-m-d') }}" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all">
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Tenggat Kembali</label>
                        <input type="date" name="return_date" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all">
                    </div>
                </div>

                <div class="flex justify-end gap-2 pt-2 border-t border-gray-100 dark:border-gray-800">
                    <button type="button" onclick="closeTransactionModal()" class="px-4 py-2 rounded-full border border-gray-200 dark:border-gray-800 text-xs font-bold text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-full bg-red-600 text-white text-xs font-black hover:bg-red-700 shadow-md shadow-red-600/10 transition-all">Proses Pinjam</button>
                </div>
            </form>
        </div>
    </div>

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

        function openTransactionModal() {
            const modal = document.getElementById('create-transaction-modal');
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.replace('scale-95', 'scale-100');
        }

        function closeTransactionModal() {
            const modal = document.getElementById('create-transaction-modal');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.replace('scale-100', 'scale-95');
        }
    </script>
</body>
</html>