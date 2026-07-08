<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Kelola Akun Staff | Telkomsel T-Track</title>
    
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

    <!-- SIDEBAR KIRI -->
    <aside class="w-64 h-screen fixed left-0 top-0 bg-white border-r border-outline-variant flex flex-col py-6 px-4 space-y-2 z-50 overflow-y-auto">
        <div class="flex items-center gap-2.5 px-2 mb-8">
            <img src="{{ asset('images/telkomsel.svg') }}" alt="Logo Telkomsel" class="h-6 w-auto block object-contain select-none">
            <h1 class="font-black text-lg tracking-tight text-gray-900 dark:text-white leading-none">
                Telkomsel <span class="text-red-600">T-Track</span>
            </h1>
        </div>

        <div class="space-y-1">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-3 py-2">General</p>
            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 font-semibold rounded-xl transition-colors" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-xs tracking-wide">Dashboard Admin</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 font-semibold rounded-xl transition-colors" href="{{ route('admin.products.index') }}">
                <span class="material-symbols-outlined">inventory_2</span>
                <span class="text-xs tracking-wide">Master Data Logistik</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 font-semibold rounded-xl transition-colors" href="{{ route('admin.transactions.index') }}">
                <span class="material-symbols-outlined">swap_horiz</span>
                <span class="text-xs tracking-wide">Transaksi</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 font-semibold rounded-xl transition-colors" href="{{ route('admin.history.index') }}">
                <span class="material-symbols-outlined">history</span>
                <span class="text-xs tracking-wide">Riwayat</span>
            </a>
        </div>

        <!-- Sistem Akses Aktif -->
        <div class="pt-4 space-y-1">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-3 py-2">Sistem Akses</p>
            <a class="flex items-center gap-3 px-4 py-3 text-red-600 bg-red-50 dark:bg-red-950/20 font-bold rounded-xl transition-colors" href="#">
                <span class="material-symbols-outlined">group</span>
                <span class="text-xs tracking-wide">Kelola Akun Staff</span>
                <span class="ml-auto text-[10px] bg-gray-100 dark:bg-gray-800 font-bold px-1.5 py-0.5 rounded-md">{{ $users->total() }}</span>
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

    <!-- HEADER -->
    <header class="h-16 w-full sticky top-0 z-40 bg-white/80 dark:bg-gray-950/80 backdrop-blur-md border-b border-outline-variant/60 flex justify-between items-center px-8 ml-64 max-w-[calc(100%-16rem)]">
        <div class="flex items-center gap-2 text-gray-400">
            <nav class="flex items-center gap-2 text-xs font-bold tracking-wide">
                <span class="text-gray-400">Pages</span>
                <span class="text-gray-300">/</span>
                <span class="text-gray-900 dark:text-white">Kelola Akun Staff</span>
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
                    <p class="text-[10px] text-gray-400 font-semibold">{{ Auth::user()->role->name }} T-Track</p>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN WORKSPACE CONTENT -->
    <main class="ml-64 p-8 min-h-screen">
        
        <!-- Action Header Row -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h2 class="text-xl font-black tracking-tight text-gray-950 dark:text-white">Kredensial Otoritas Pengguna</h2>
                <p class="text-xs text-gray-400 mt-0.5">Kelola lisensi hak akses akun staff, operator sortir lapangan, dan manajer gudang logistik.</p>
            </div>
            <button onclick="openCreateModal()" class="inline-flex items-center gap-2 text-xs font-black bg-red-600 text-white px-5 py-3 rounded-full hover:bg-red-700 shadow-md shadow-red-600/10 transition-all">
                <span class="material-symbols-outlined text-sm">person_add</span> Daftarkan Staff Baru
            </button>
        </div>

        <!-- Filter & Search Card Section -->
        <div class="glass-card rounded-[24px] p-4 mb-6 flex flex-col sm:flex-row gap-4 items-center justify-between">
            <form action="{{ route('admin.users.index') }}" method="GET" class="w-full sm:w-80 relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama staff atau alamat email..." class="w-full pl-10 pr-4 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900 text-xs font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all">
                <span class="material-symbols-outlined text-gray-400 text-lg absolute left-3 top-2.5">search</span>
            </form>
        </div>

        <!-- Accounts Main Data Table -->
        <div class="glass-card rounded-[24px] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/70 dark:bg-gray-900 text-gray-400 text-[10px] uppercase tracking-widest font-bold border-b border-gray-100 dark:border-gray-800">
                        <tr>
                            <th class="px-6 py-4">Inisial</th>
                            <th class="px-4 py-4">Nama Lengkap</th>
                            <th class="px-4 py-4">Email Korporat</th>
                            <th class="px-4 py-4">Tingkat Hak Akses (Role)</th>
                            <th class="px-4 py-4">Tanggal Bergabung</th>
                            <th class="px-6 py-4 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs divide-y divide-gray-100 dark:divide-gray-800 font-medium text-gray-700 dark:text-gray-300">
                        @forelse($users as $user)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 flex items-center justify-center font-bold text-[11px] border border-gray-200 dark:border-gray-700">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                            </td>
                            <td class="px-4 py-4 font-bold text-gray-950 dark:text-white">{{ $user->name }}</td>
                            <td class="px-4 py-4 font-mono text-gray-400">{{ $user->email }}</td>
                            <td class="px-4 py-4">
                                @if(($user->role->name ?? '') === 'Admin')
                                    <span class="px-2.5 py-1 rounded-full text-[9px] font-bold bg-red-50 text-red-700 border border-red-200 dark:bg-red-950/20 dark:text-red-400 dark:border-red-900/30">Admin</span>
                                @elseif(($user->role->name ?? '') === 'Manager')
                                    <span class="px-2.5 py-1 rounded-full text-[9px] font-bold bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-950/20 dark:text-blue-400 dark:border-blue-900/30">Manager</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[9px] font-bold bg-green-50 text-green-700 border border-green-200 dark:bg-green-950/20 dark:text-green-400 dark:border-green-900/30">Staff</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-gray-400">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-right space-x-1 whitespace-nowrap">
                                <button type="button" 
                                        onclick="openEditModal(this)"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-role="{{ $user->role_id }}"
                                        class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg text-gray-500 hover:text-amber-600 transition-colors">
                                    <span class="material-symbols-outlined text-base">edit</span>
                                </button>
                                @if($user->id !== Auth::id())
                                <button type="button" 
                                        onclick="openDeleteModal(this)"
                                        data-action="{{ route('admin.users.destroy', $user->id) }}"
                                        data-name="{{ $user->name }}"
                                        class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg text-gray-400 hover:text-red-600 transition-colors">
                                    <span class="material-symbols-outlined text-base">delete</span>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-10 text-gray-400">
                                <span class="material-symbols-outlined text-3xl block mb-2">group_off</span>
                                Tidak ada data staff terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($users->hasPages())
            <div class="p-4 border-t border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/40">
                {{ $users->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </main>

    <!-- ➕ MODAL: REGISTRASI STAFF BARU -->
    <div id="create-user-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white dark:bg-gray-900 w-full max-w-md rounded-[28px] p-6 shadow-2xl border border-gray-100 dark:border-gray-800 transform scale-95 transition-all duration-300 space-y-4">
            <div class="flex justify-between items-center pb-2 border-b border-gray-100 dark:border-gray-800">
                <div>
                    <h3 class="text-base font-black text-gray-950 dark:text-white tracking-tight">Formulir Akses Baru</h3>
                    <p class="text-[11px] text-gray-400">Otorisasikan hak akses ke sistem logistik internal T-Track.</p>
                </div>
                <button onclick="closeCreateModal()" class="p-1.5 text-gray-400 hover:text-red-600 rounded-full transition-colors">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div class="space-y-1.5">
                    <label class="font-bold text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                    <input type="text" name="name" placeholder="Contoh: Raymond - Network Opt" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all">
                </div>
                <div class="space-y-1.5">
                    <label class="font-bold text-gray-700 dark:text-gray-300">Email Telkomsel / Corporate</label>
                    <input type="email" name="email" placeholder="username@telkomsel.co.id" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Password Sistem</label>
                        <input type="password" name="password" placeholder="Min. 8 Karakter" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all">
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Tingkat Hak Akses (Role)</label>
                        <select name="role_id" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all cursor-pointer">
                            <option value="2" selected>Staff (Operator Gudang)</option>
                            <option value="3">Manager (Approval & Report)</option>
                            <option value="1">Admin (Full Control)</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2 border-t border-gray-100 dark:border-gray-800">
                    <button type="button" onclick="closeCreateModal()" class="px-4 py-2 rounded-full border border-gray-200 dark:border-gray-800 text-xs font-bold text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-full bg-red-600 text-white text-xs font-black hover:bg-red-700 shadow-md shadow-red-600/10 transition-all">Daftarkan Akun</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 📝 MODAL: EDIT AKUN STAFF -->
    <div id="edit-user-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white dark:bg-gray-900 w-full max-w-md rounded-[28px] p-6 shadow-2xl border border-gray-100 dark:border-gray-800 transform scale-95 transition-all duration-300 space-y-4">
            <div class="flex justify-between items-center pb-2 border-b border-gray-100 dark:border-gray-800">
                <div>
                    <h3 class="text-base font-black text-gray-950 dark:text-white tracking-tight">Modifikasi Kredensial</h3>
                    <p class="text-[11px] text-gray-400">Sesuaikan tingkat otorisasi atau perbarui kata sandi pengguna.</p>
                </div>
                <button type="button" onclick="closeEditModal()" class="p-1.5 text-gray-400 hover:text-red-600 rounded-full transition-colors">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>

            <form id="edit-user-form" action="" method="POST" class="space-y-4 text-xs">
                @csrf
                @method('PUT')
                <div class="space-y-1.5">
                    <label class="font-bold text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                    <input type="text" name="name" id="edit-name" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-amber-500 focus:border-amber-500 outline-none transition-all">
                </div>
                <div class="space-y-1.5">
                    <label class="font-bold text-gray-700 dark:text-gray-300">Alamat Email</label>
                    <input type="email" name="email" id="edit-email" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-amber-500 focus:border-amber-500 outline-none transition-all">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Ganti Password (Opsional)</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tetap" class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-amber-500 focus:border-amber-500 outline-none transition-all">
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Tingkat Otorisasi (Role)</label>
                        <select name="role_id" id="edit-role" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-amber-500 focus:border-amber-500 outline-none transition-all cursor-pointer">
                            <option value="1">Admin</option>
                            <option value="2">Staff</option>
                            <option value="3">Manager</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-2 border-t border-gray-100 dark:border-gray-800">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-full border border-gray-200 dark:border-gray-800 text-xs font-bold text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-full bg-red-600 text-white text-xs font-black hover:bg-red-700 shadow-md shadow-red-600/10 transition-all">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 🚨 MODAL: KONFIRMASI HAPUS AKUN -->
    <div id="delete-user-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white dark:bg-gray-900 w-full max-w-sm rounded-[24px] p-6 shadow-2xl border border-gray-100 dark:border-gray-800 transform scale-95 transition-all duration-300 space-y-4 text-center">
            <div class="w-12 h-14 bg-red-50 dark:bg-red-950/20 text-red-600 rounded-full flex items-center justify-center mx-auto">
                <span class="material-symbols-outlined text-2xl">person_remove</span>
            </div>
            <div class="space-y-1">
                <h4 class="text-base font-black text-gray-950 dark:text-white tracking-tight">Cabut Akses Akun?</h4>
                <p class="text-xs text-gray-400 font-medium leading-relaxed">Apakah Anda yakin ingin menghapus akun <span id="del-user-name" class="font-bold text-red-600"></span>? Pengguna ini tidak akan bisa login ke T-Track lagi.</p>
            </div>
            <form id="delete-executable-form" action="" method="POST" class="flex gap-2 pt-2">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeDeleteModal()" class="w-full py-2.5 rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 font-bold text-xs transition-all">Batal</button>
                <button type="submit" class="w-full py-2.5 rounded-full bg-red-600 text-white font-black text-xs hover:bg-red-700 shadow-md shadow-red-600/10 transition-all">Ya, Hapus Akses</button>
            </form>
        </div>
    </div>

    <script>
        // Logika Pengendali Dark Mode
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

        // Kontrol Modal Registrasi Baru
        function openCreateModal() {
            const modal = document.getElementById('create-user-modal');
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-95');
            modal.firstElementChild.classList.add('scale-100');
        }
        function closeCreateModal() {
            const modal = document.getElementById('create-user-modal');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-100');
            modal.firstElementChild.classList.add('scale-95');
        }

        // Kontrol Modal Edit Akun
        function openEditModal(button) {
            const modal = document.getElementById('edit-user-modal');
            const form = document.getElementById('edit-user-form');
            
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const email = button.getAttribute('data-email');
            const role = button.getAttribute('data-role');

            form.action = `/admin/users/${id}`;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-role').value = role;

            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-95');
            modal.firstElementChild.classList.add('scale-100');
        }
        function closeEditModal() {
            const modal = document.getElementById('edit-user-modal');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-100');
            modal.firstElementChild.classList.add('scale-95');
        }

        // Kontrol Modal Hapus Akun
        function openDeleteModal(button) {
            const modal = document.getElementById('delete-user-modal');
            const form = document.getElementById('delete-executable-form');
            
            const actionUrl = button.getAttribute('data-action');
            const name = button.getAttribute('data-name');

            form.action = actionUrl;
            document.getElementById('del-user-name').innerText = name;

            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-95');
            modal.firstElementChild.classList.add('scale-100');
        }
        function closeDeleteModal() {
            const modal = document.getElementById('delete-user-modal');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-100');
            modal.firstElementChild.classList.add('scale-95');
        }
    </script>
</body>
</html>