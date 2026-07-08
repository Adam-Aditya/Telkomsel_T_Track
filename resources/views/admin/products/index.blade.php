<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Master Data Logistik | Telkomsel T-Track</title>
    
    <!-- Tailwind CSS & Fonts (Diselaraskan dengan Dashboard Utama) -->
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
            font-family: 'Inter', sans-serif; 
            background-color: #f8f9fa; 
            color: #111317; 
            -webkit-font-smoothing: antialiased; 
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24; }
        .glass-card { 
            background: rgba(255, 255, 255, 0.9); 
            backdrop-filter: blur(8px); 
            border: 1px solid rgba(229, 231, 235, 0.6); 
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.02), 0 10px 10px -5px rgba(0, 0, 0, 0.01); 
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .pro-gradient { background: linear-gradient(135deg, #111317 0%, #dc2626 100%); }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

        /* Varian Dark Mode Kustom dengan Utility Tailwind */
        .dark body { background-color: #0b0c0e; color: #f3f4f6; }
        .dark aside, .dark header, .dark .glass-card { background-color: #111317; border-color: #1f242e; color: #f3f4f6; }
        .dark .text-gray-950, .dark .text-gray-900 { color: #ffffff; }
        .dark .text-gray-600, .dark .text-gray-400 { color: #9ca3af; }
        .dark .bg-gray-50 { background-color: #1f242e; }
        .dark tr:hover { background-color: #1f242e; }
    </style>
    
    <!-- Script pencegah flash putih agar tersinkronisasi instan dari localStorage -->
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

    <!-- SIDEBAR KIRI (Sinkron Penuh dengan Dashboard Utama) -->
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
            
            <!-- Master Data Logistik Aktif -->
            <a class="flex items-center gap-3 px-4 py-3 text-red-600 bg-red-50 dark:bg-red-950/20 font-bold rounded-xl transition-colors" href="#">
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

        <!-- Ditambahkan Kelompok Menu: Sistem Akses (Sama Seperti Dashboard) -->
        <div class="pt-4 space-y-1">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-3 py-2">Sistem Akses</p>
            <a class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 font-semibold rounded-xl transition-colors" href="{{ route('admin.users.index') }}">
                <span class="material-symbols-outlined">group</span>
                <span class="text-xs tracking-wide">Kelola Akun</span>
                <span class="ml-auto text-[10px] bg-gray-100 dark:bg-gray-800 font-bold px-1.5 py-0.5 rounded-md">{{ \App\Models\User::count() }}</span>
            </a>
        </div>

        <!-- Ditambahkan Informasi Profil User & Tombol Keluar di Bagian Bawah Sidebar -->
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

    <!-- HEADER (Kini Memiliki Tombol Pengendali Sinkronisasi Dark Mode) -->
    <header class="h-16 w-full sticky top-0 z-40 bg-white/80 dark:bg-gray-950/80 backdrop-blur-md border-b border-outline-variant/60 flex justify-between items-center px-8 ml-64 max-w-[calc(100%-16rem)]">
        <div class="flex items-center gap-2 text-gray-400">
            <nav class="flex items-center gap-2 text-xs font-bold tracking-wide">
                <span class="text-gray-400">Pages</span>
                <span class="text-gray-300">/</span>
                <span class="text-gray-900 dark:text-white">Master Data Logistik</span>
            </nav>
        </div>
        
        <div class="flex items-center gap-4">
            <!-- 🌗 TOMBOL TOGGLE DARK MODE SINKRON -->
            <button id="theme-toggle" class="p-2 text-gray-500 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-full transition-all flex items-center justify-center">
                <span id="theme-toggle-dark-icon" class="material-symbols-outlined text-xl hidden">dark_mode</span>
                <span id="theme-toggle-light-icon" class="material-symbols-outlined text-xl hidden">light_mode</span>
            </button>

            <!-- TOMBOL NOTIFIKASI -->
            <button class="p-2 text-gray-500 hover:text-red-600 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-full transition-all">
                <span class="material-symbols-outlined text-xl">notifications</span>
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
                <h2 class="text-xl font-black tracking-tight text-gray-950 dark:text-white">Manajemen Inventaris Gudang</h2>
                <p class="text-xs text-gray-400 mt-0.5">Kelola informasi penempatan, stok, dan standardisasi kondisi aset logistik.</p>
            </div>
            <button onclick="openCreateModal()" class="inline-flex items-center gap-2 text-xs font-black bg-red-600 text-white px-5 py-3 rounded-full hover:bg-red-700 shadow-md shadow-red-600/10 transition-all">
                <span class="material-symbols-outlined text-sm">add_box</span> Registrasi Aset Baru
            </button>
        </div>

        <!-- Filter & Search Card Section -->
        <div class="glass-card rounded-[24px] p-4 mb-6 flex flex-col sm:flex-row gap-4 items-center justify-between">
            <form action="{{ route('admin.products.index') }}" method="GET" class="w-full sm:w-80 relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang atau kode aset..." class="w-full pl-10 pr-4 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900 text-xs font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all">
                <span class="material-symbols-outlined text-gray-400 text-lg absolute left-3 top-2.5">search</span>
            </form>
        </div>

        <!-- Inventaris Main Data Table -->
        <div class="glass-card rounded-[24px] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/70 dark:bg-gray-900 text-gray-400 text-[10px] uppercase tracking-widest font-bold border-b border-gray-100 dark:border-gray-800">
                        <tr>
                            <th class="px-6 py-4">Gambar</th>
                            <th class="px-4 py-4">Kode Barang</th>
                            <th class="px-4 py-4">Nama Aset</th>
                            <th class="px-4 py-4">Kategori</th>
                            <th class="px-4 py-4">Stok Gudang</th>
                            <th class="px-4 py-4">Lokasi Rak</th>
                            <th class="px-4 py-4">Kondisi</th>
                            <th class="px-6 py-4 text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs divide-y divide-gray-100 dark:divide-gray-800 font-medium text-gray-700 dark:text-gray-300">
                        @forelse($products as $product)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-800 overflow-hidden border border-gray-200/60 dark:border-gray-700 flex items-center justify-center">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="material-symbols-outlined text-gray-400 text-lg">image</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-4 font-bold text-red-600 dark:text-red-400">{{ $product->product_code }}</td>
                            <td class="px-4 py-4 font-bold text-gray-950 dark:text-white">{{ $product->name }}</td>
                            <td class="px-4 py-4">{{ $product->category->name }}</td>
                            <td class="px-4 py-4">
                                <span class="font-black">{{ $product->stock }}</span> Pcs
                                @if($product->stock <= 5)
                                    <span class="ml-1.5 inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold bg-red-50 text-red-700 border border-red-200 animate-pulse">Menipis</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-gray-400">{{ $product->storage_location }}</td>
                            <td class="px-4 py-4">
                                @if($product->condition === 'Bagus')
                                    <span class="px-2.5 py-1 rounded-full text-[9px] font-bold bg-green-50 text-green-700 border border-green-200">Bagus</span>
                                @elseif($product->condition === 'Rusak Ringan')
                                    <span class="px-2.5 py-1 rounded-full text-[9px] font-bold bg-amber-50 text-amber-700 border border-amber-200">Rusak Ringan</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[9px] font-bold bg-red-50 text-red-700 border border-red-200">Rusak Berat</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-1 whitespace-nowrap">
                                <button type="button" 
                                        onclick="openDetailModal(this)"
                                        data-code="{{ $product->product_code }}"
                                        data-name="{{ $product->name }}"
                                        data-category="{{ $product->category->name ?? 'Tanpa Kategori' }}"
                                        data-stock="{{ $product->stock }}"
                                        data-location="{{ $product->storage_location }}"
                                        data-condition="{{ $product->condition }}"
                                        data-image="{{ $product->image ? asset('storage/' . $product->image) : '' }}"
                                        data-date="{{ $product->created_at->format('d M Y - H:i') }}"
                                        class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg text-gray-500 hover:text-blue-600 transition-colors" 
                                        title="Detail Barang">
                                    <span class="material-symbols-outlined text-base">visibility</span>
                                </button>
                                <button type="button" 
                                        onclick="openEditModal(this)"
                                        data-id="{{ $product->id }}"
                                        data-code="{{ $product->product_code }}"
                                        data-name="{{ $product->name }}"
                                        data-category="{{ $product->category_id }}"
                                        data-stock="{{ $product->stock }}"
                                        data-location="{{ $product->storage_location }}"
                                        data-condition="{{ $product->condition }}"
                                        class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg text-gray-500 hover:text-amber-600 transition-colors" 
                                        title="Edit Barang">
                                    <span class="material-symbols-outlined text-base">edit</span>
                                </button>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-flex delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" 
                                            onclick="openDeleteModal(this)"
                                            data-action="{{ route('admin.products.destroy', $product->id) }}"
                                            data-name="{{ $product->name }}"
                                            data-code="{{ $product->product_code }}"
                                            class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg text-gray-400 hover:text-red-600 transition-colors" 
                                            title="Hapus Aset">
                                        <span class="material-symbols-outlined text-base">delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-10 text-gray-400">
                                <span class="material-symbols-outlined text-3xl block mb-2">inventory</span>
                                Belum ada aset logistik terdaftar atau data tidak ditemukan.
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

    <div id="create-product-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white dark:bg-gray-900 w-full max-w-lg rounded-[28px] p-6 shadow-2xl border border-gray-100 dark:border-gray-800 transform scale-95 transition-all duration-300 space-y-4">
            
            <div class="flex justify-between items-center pb-2 border-b border-gray-100 dark:border-gray-800">
                <div>
                    <h3 class="text-base font-black text-gray-950 dark:text-white tracking-tight">Form Registrasi Aset</h3>
                    <p class="text-[11px] text-gray-400">Pastikan standardisasi field data terisi dengan benar.</p>
                </div>
                <button onclick="closeCreateModal()" class="p-1.5 text-gray-400 hover:text-red-600 rounded-full transition-colors">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Kode Barang / SN</label>
                        <input type="text" 
                            name="product_code" 
                            value="{{ $autoProductCode }}" 
                            readonly 
                            required 
                            class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-100 dark:bg-gray-800 font-bold text-red-600 dark:text-red-400 cursor-not-allowed outline-none select-none">
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Nama Aset Logistik</label>
                        <input type="text" name="name" placeholder="Nama Perangkat/Barang" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Kategori</label>
                        <div class="space-y-1.5">
                            <select name="category_id" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all cursor-pointer">
                                <option value="" disabled selected hidden>Pilih kategori...</option>
                                
                                @if(isset($categories) && $categories->count() > 0)
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled>⚠️ Data kategori kosong / belum di-seed</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Stok Gudang Awal</label>
                        <input type="number" name="stock" min="0" placeholder="0" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Lokasi Penempatan Rak</label>
                        <input type="text" name="storage_location" placeholder="Contoh: Rak A-12" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all">
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Kondisi Fisik</label>
                        <select name="condition" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-red-600 focus:border-red-600 outline-none transition-all cursor-pointer">
                            <option value="Bagus">Bagus (Siap Distribusi)</option>
                            <option value="Rusak Ringan">Rusak Ringan (Maintenance)</option>
                            <option value="Rusak Berat">Rusak Berat (Karantina Aset)</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="font-bold text-gray-700 dark:text-gray-300">Foto Dokumentasi Aset (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-red-50 file:text-red-700 dark:file:bg-gray-800 dark:file:text-gray-200 hover:file:bg-red-100 cursor-pointer">
                </div>

                <div class="flex justify-end gap-2 pt-2 border-t border-gray-100 dark:border-gray-800">
                    <button type="button" 
                            onclick="closeCreateModal()" 
                            class="px-4 py-2 rounded-full border border-gray-200 dark:border-gray-800 text-xs font-bold text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-full bg-red-600 text-white text-xs font-black hover:bg-red-700 shadow-md shadow-red-600/10 transition-all">Simpan Aset</button>
                </div>
            </form>
        </div>
    </div>

    <div id="detail-product-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white dark:bg-gray-900 w-full max-w-md rounded-[28px] p-6 shadow-2xl border border-gray-100 dark:border-gray-800 transform scale-95 transition-all duration-300 space-y-4">
            
            <div class="flex justify-between items-center pb-2 border-b border-gray-100 dark:border-gray-800">
                <div>
                    <h3 class="text-base font-black text-gray-950 dark:text-white tracking-tight">Rincian Informasi Aset</h3>
                    <p class="text-[11px] text-gray-400">Manajemen Pelacakan Master Data Logistik</p>
                </div>
                <button onclick="closeDetailModal()" class="p-1.5 text-gray-400 hover:text-red-600 rounded-full transition-colors">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>

            <div class="space-y-4 text-xs">
                <div id="detail-image-container" class="hidden w-full h-40 rounded-2xl overflow-hidden bg-gray-50 dark:bg-gray-950 border border-gray-100 dark:border-gray-800">
                    <img id="detail-image" src="" alt="Foto Aset" class="w-full h-full object-cover">
                </div>

                <div class="space-y-2.5">
                    <div class="flex justify-between items-center py-2 border-b border-gray-50 dark:border-gray-800/50">
                        <span class="text-gray-400 font-medium">Kode Barang / SN</span>
                        <span id="detail-code" class="font-black text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-950/50 px-2.5 py-0.5 rounded-md tracking-wider"></span>
                    </div>
                    <div class="flex justify-between items-start py-2 border-b border-gray-50 dark:border-gray-800/50">
                        <span class="text-gray-400 font-medium">Nama Aset</span>
                        <span id="detail-name" class="font-bold text-gray-900 dark:text-white text-right max-w-[200px]"></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-50 dark:border-gray-800/50">
                        <span class="text-gray-400 font-medium">Kategori</span>
                        <span id="detail-category" class="font-semibold text-gray-700 dark:text-gray-300"></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-50 dark:border-gray-800/50">
                        <span class="text-gray-400 font-medium">Stok Tersedia</span>
                        <span id="detail-stock" class="font-bold text-gray-900 dark:text-white"></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-50 dark:border-gray-800/50">
                        <span class="text-gray-400 font-medium">Lokasi Rak</span>
                        <span id="detail-location" class="font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide"></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-50 dark:border-gray-800/50">
                        <span class="text-gray-400 font-medium">Kondisi Fisik</span>
                        <span id="detail-condition" class="font-bold px-2.5 py-0.5 rounded-full text-[10px]"></span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-400 font-medium">Tanggal Registrasi</span>
                        <span id="detail-date" class="font-medium text-gray-500"></span>
                    </div>
                </div>
            </div>

            <div class="pt-2 border-t border-gray-100 dark:border-gray-800 flex justify-end">
                <button type="button" onclick="closeDetailModal()" class="w-full sm:w-auto text-center px-5 py-2 rounded-full bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 text-xs font-bold transition-all">
                    Tutup Tampilan
                </button>
            </div>
        </div>
    </div>

    <div id="edit-product-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white dark:bg-gray-900 w-full max-w-lg rounded-[28px] p-6 shadow-2xl border border-gray-100 dark:border-gray-800 transform scale-95 transition-all duration-300 space-y-4">
            
            <div class="flex justify-between items-center pb-2 border-b border-gray-100 dark:border-gray-800">
                <div>
                    <h3 class="text-base font-black text-gray-950 dark:text-white tracking-tight">Edit Informasi Aset</h3>
                    <p class="text-[11px] text-gray-400">Perbarui rincian data aset logistik secara berkala.</p>
                </div>
                <button type="button" onclick="closeEditModal()" class="p-1.5 text-gray-400 hover:text-red-600 rounded-full transition-colors">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>

            <form id="edit-product-form" action="" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf
                @method('PUT') <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Kode Barang / SN (Terkunci)</label>
                        <input type="text" id="edit-code" readonly class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-100 dark:bg-gray-800 font-bold text-gray-400 outline-none cursor-not-allowed">
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Nama Aset Logistik</label>
                        <input type="text" name="name" id="edit-name" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-amber-500 focus:border-amber-500 outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Kategori</label>
                        <select name="category_id" id="edit-category" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-amber-500 focus:border-amber-500 outline-none transition-all cursor-pointer">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Stok Tersedia</label>
                        <input type="number" name="stock" id="edit-stock" min="0" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-amber-500 focus:border-amber-500 outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Lokasi Penempatan Rak</label>
                        <input type="text" name="storage_location" id="edit-location" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-amber-500 focus:border-amber-500 outline-none transition-all">
                    </div>
                    <div class="space-y-1.5">
                        <label class="font-bold text-gray-700 dark:text-gray-300">Kondisi Fisik</label>
                        <select name="condition" id="edit-condition" required class="w-full px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-950 font-medium focus:ring-1 focus:ring-amber-500 focus:border-amber-500 outline-none transition-all cursor-pointer">
                            <option value="Bagus">Bagus (Siap Distribusi)</option>
                            <option value="Rusak Ringan">Rusak Ringan (Maintenance)</option>
                            <option value="Rusak Berat">Rusak Berat (Karantina Aset)</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="font-bold text-gray-700 dark:text-gray-300">Ganti Foto Dokumentasi (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-amber-50 file:text-amber-700 dark:file:bg-gray-800 dark:file:text-gray-200 hover:file:bg-amber-100 cursor-pointer">
                </div>

                <div class="flex justify-end gap-2 pt-2 border-t border-gray-100 dark:border-gray-800">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-full border border-gray-200 dark:border-gray-800 text-xs font-bold text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">Batal</button>
                    
                    <button type="submit" class="px-5 py-2 rounded-full bg-red-600 text-white text-xs font-black hover:bg-red-700 shadow-md shadow-red-600/10 transition-all">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="delete-confirmation-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white dark:bg-gray-900 w-full max-w-sm rounded-[24px] p-6 text-center shadow-2xl border border-gray-100 dark:border-gray-800 transform scale-95 transition-all duration-300 space-y-4">

            <div class="w-14 h-14 bg-red-50 dark:bg-red-950/30 text-red-600 rounded-full flex items-center justify-center mx-auto shadow-inner">
                <span class="material-symbols-outlined text-2xl animate-pulse" style="font-variation-settings: 'FILL' 1;">warning</span>
            </div>

            <div class="space-y-1">
                <h4 class="text-base font-black tracking-tight text-gray-950 dark:text-white">Hapus Aset Permanen?</h4>
                <p class="text-xs text-gray-400 font-medium leading-relaxed">
                    Tindakan ini akan menghapus aset <span id="del-modal-code" class="font-bold text-red-600"></span> - <span id="del-modal-name" class="font-bold text-gray-900 dark:text-white"></span> serta berkas dokumentasinya secara permanen dari sistem audit logistik.
                </p>
            </div>

            <form id="delete-executable-form" action="" method="POST" class="space-y-2 pt-2">
                @csrf
                @method('DELETE')

                <div class="flex flex-col sm:flex-row-reverse gap-2">
                    <button type="submit" class="w-full inline-flex items-center justify-center text-xs font-black bg-red-600 text-white py-3 rounded-full hover:bg-red-700 shadow-md shadow-red-600/10 transform active:scale-[0.97] transition duration-150">
                        Ya, Hapus Permanen
                    </button>
                    <button type="button" onclick="closeDeleteModal()" class="w-full inline-flex items-center justify-center text-xs font-bold bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 py-3 rounded-full transition duration-150">
                        Batalkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="detail-product-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white dark:bg-gray-900 w-full max-w-md rounded-[28px] p-6 shadow-2xl border border-gray-100 dark:border-gray-800 transform scale-95 transition-all duration-300 space-y-4">
            
            <div class="flex justify-between items-center pb-2 border-b border-gray-100 dark:border-gray-800">
                <div>
                    <h3 class="text-base font-black text-gray-950 dark:text-white tracking-tight">Rincian Informasi Aset</h3>
                    <p class="text-[11px] text-gray-400">Manajemen Pelacakan Master Data Logistik</p>
                </div>
                <button onclick="closeDetailModal()" class="p-1.5 text-gray-400 hover:text-red-600 rounded-full transition-colors">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>

            <div class="space-y-4 text-xs">
                <div id="detail-image-container" class="hidden w-full h-40 rounded-2xl overflow-hidden bg-gray-50 dark:bg-gray-950 border border-gray-100 dark:border-gray-800">
                    <img id="detail-image" src="" alt="Foto Aset" class="w-full h-full object-cover">
                </div>

                <div class="space-y-2.5">
                    <div class="flex justify-between items-center py-2 border-b border-gray-50 dark:border-gray-800/50">
                        <span class="text-gray-400 font-medium">Kode Barang / SN</span>
                        <span id="detail-code" class="font-black text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-950/50 px-2.5 py-0.5 rounded-md tracking-wider"></span>
                    </div>
                    <div class="flex justify-between items-start py-2 border-b border-gray-50 dark:border-gray-800/50">
                        <span class="text-gray-400 font-medium">Nama Aset</span>
                        <span id="detail-name" class="font-bold text-gray-900 dark:text-white text-right max-w-[200px]"></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-50 dark:border-gray-800/50">
                        <span class="text-gray-400 font-medium">Kategori</span>
                        <span id="detail-category" class="font-semibold text-gray-700 dark:text-gray-300"></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-50 dark:border-gray-800/50">
                        <span class="text-gray-400 font-medium">Stok Tersedia</span>
                        <span id="detail-stock" class="font-bold text-gray-900 dark:text-white"></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-50 dark:border-gray-800/50">
                        <span class="text-gray-400 font-medium">Lokasi Rak</span>
                        <span id="detail-location" class="font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide"></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-50 dark:border-gray-800/50">
                        <span class="text-gray-400 font-medium">Kondisi Fisik</span>
                        <span id="detail-condition" class="font-bold px-2.5 py-0.5 rounded-full text-[10px]"></span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-400 font-medium">Tanggal Registrasi</span>
                        <span id="detail-date" class="font-medium text-gray-500"></span>
                    </div>
                </div>
            </div>

            <div class="pt-2 border-t border-gray-100 dark:border-gray-800 flex justify-end">
                <button type="button" onclick="closeDetailModal()" class="w-full sm:w-auto text-center px-5 py-2 rounded-full bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 text-xs font-bold transition-all">
                    Tutup Tampilan
                </button>
            </div>
        </div>
    </div>

    <!-- Script Kontrol Transisi TEMA & MIKRO-INTERAKSI SINKRON -->
    <script>
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Sinkronisasi Ikon Tombol Tema Saat Halaman Dimuat
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

        // Efek Hover Mikro Kartu Statistik
        document.querySelectorAll('.glass-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-2px)';
                card.style.transition = 'transform 0.2s cubic-bezier(0.4, 0, 0.2, 1)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });

        // Fungsi membuka Form Registrasi Modal
        function openCreateModal() {
            const modal = document.getElementById('create-product-modal');
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-95');
            modal.firstElementChild.classList.add('scale-100');
        }

        // Fungsi menutup Form Registrasi Modal (Pastikan namanya closeCreateModal)
        function closeCreateModal() {
            const modal = document.getElementById('create-product-modal');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-100');
            modal.firstElementChild.classList.add('scale-95');
        }
        function openDetailModal(button) {
            const modal = document.getElementById('detail-product-modal');
            
            // Ambil data dari atribut tombol yang diklik
            const code = button.getAttribute('data-code');
            const name = button.getAttribute('data-name');
            const category = button.getAttribute('data-category');
            const stock = button.getAttribute('data-stock');
            const location = button.getAttribute('data-location');
            const condition = button.getAttribute('data-condition');
            const image = button.getAttribute('data-image');
            const date = button.getAttribute('data-date');

            // Suntikkan data ke dalam elemen HTML modal
            document.getElementById('detail-code').innerText = code;
            document.getElementById('detail-name').innerText = name;
            document.getElementById('detail-category').innerText = category;
            document.getElementById('detail-stock').innerText = stock + ' Unit';
            document.getElementById('detail-location').innerText = location;
            document.getElementById('detail-date').innerText = date;

            // Pengaturan warna badge kondisi fisik secara dinamis
            const conditionBadge = document.getElementById('detail-condition');
            conditionBadge.innerText = condition;
            conditionBadge.className = "font-bold px-2.5 py-0.5 rounded-full text-[10px]"; // reset class
            
            if (condition === 'Bagus') {
                conditionBadge.classList.add('bg-green-50', 'text-green-700', 'dark:bg-green-950/40', 'dark:text-green-400');
            } else if (condition === 'Rusak Ringan') {
                conditionBadge.classList.add('bg-amber-50', 'text-amber-700', 'dark:bg-amber-950/40', 'dark:text-amber-400');
            } else {
                conditionBadge.classList.add('bg-red-50', 'text-red-700', 'dark:bg-red-950/40', 'dark:text-red-400');
            }

            // Handle Tampilan Gambar jika ada dokumentasi foto aset
            const imageContainer = document.getElementById('detail-image-container');
            const imgTag = document.getElementById('detail-image');
            if (image) {
                imgTag.src = image;
                imageContainer.classList.remove('hidden');
            } else {
                imageContainer.classList.add('hidden');
                imgTag.src = '';
            }

            // Tampilkan modal dengan efek transisi halus
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-95');
            modal.firstElementChild.classList.add('scale-100');
        }

        function closeDetailModal() {
            const modal = document.getElementById('detail-product-modal');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-100');
            modal.firstElementChild.classList.add('scale-95');
        }
        function openEditModal(button) {
            const modal = document.getElementById('edit-product-modal');
            const form = document.getElementById('edit-product-form');
            
            // Ambil data-atribut dari tombol edit yang diklik
            const id = button.getAttribute('data-id');
            const code = button.getAttribute('data-code');
            const name = button.getAttribute('data-name');
            const category = button.getAttribute('data-category');
            const stock = button.getAttribute('data-stock');
            const location = button.getAttribute('data-location');
            const condition = button.getAttribute('data-condition');

            // Atur URL Action form secara dinamis mengarah ke ID produk tersebut
            form.action = `/admin/products/${id}`;

            // Suntikkan data lama aset ke dalam kolom input form modal edit
            document.getElementById('edit-code').value = code;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-category').value = category;
            document.getElementById('edit-stock').value = stock;
            document.getElementById('edit-location').value = location;
            document.getElementById('edit-condition').value = condition;

            // Tampilkan modal edit dengan animasi smooth
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-95');
            modal.firstElementChild.classList.add('scale-100');
        }

        function closeEditModal() {
            const modal = document.getElementById('edit-product-modal');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-100');
            modal.firstElementChild.classList.add('scale-95');
        }
        function confirmDelete(button) {
            const productName = button.getAttribute('data-name');
            const productCode = button.getAttribute('data-code');
            
            // Tampilkan jendela konfirmasi bawaan browser yang aman
            const kofirmasi = confirm(`⚠️ PERINGATAN AUDIT LOGISTIK!\n\nApakah Anda yakin ingin menghapus aset:\n[${productCode}] - ${productName}?\n\nData yang dihapus tidak dapat dikembalikan.`);
            
            if (kofirmasi) {
                // Jika user menekan OK, jalankan submit form DELETE
                button.closest('form').submit();
            }
        }
        // Fungsi membuka Modal Konfirmasi Hapus Kustom
        function openDeleteModal(button) {
            const modal = document.getElementById('delete-confirmation-modal');
            const form = document.getElementById('delete-executable-form');
            
            // Ambil data dari atribut tombol tabel yang diklik
            const actionUrl = button.getAttribute('data-action');
            const productName = button.getAttribute('data-name');
            const productCode = button.getAttribute('data-code');

            // Suntikkan rute dan teks ke dalam UI Modal
            form.action = actionUrl;
            document.getElementById('del-modal-code').innerText = productCode;
            document.getElementById('del-modal-name').innerText = productName;

            // Picu animasi muncul (fade-in & scale-up)
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-95');
            modal.firstElementChild.classList.add('scale-100');
        }

        // Fungsi menutup Modal Konfirmasi Hapus
        function closeDeleteModal() {
            const modal = document.getElementById('delete-confirmation-modal');
            
            // Kembalikan efek animasi menghilang
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.remove('scale-100');
            modal.firstElementChild.classList.add('scale-95');
        }
        
        function openDetailModal(button) {
            const modal = document.getElementById('detail-product-modal');
            
            // Ambil parameter data-attributes dari tombol yang diklik
            const code = button.getAttribute('data-code');
            const name = button.getAttribute('data-name');
            const category = button.getAttribute('data-category');
            const stock = button.getAttribute('data-stock');
            const location = button.getAttribute('data-location');
            const condition = button.getAttribute('data-condition');
            const image = button.getAttribute('data-image');
            const date = button.getAttribute('data-date');

            // Suntikkan teks ke dalam elemen modal detail
            document.getElementById('detail-code').innerText = code;
            document.getElementById('detail-name').innerText = name;
            document.getElementById('detail-category').innerText = category;
            document.getElementById('detail-stock').innerText = stock + " Pcs";
            document.getElementById('detail-location').innerText = location || '-';
            document.getElementById('detail-date').innerText = date;

            // Logika Pengkondisian Warna Badge Kondisi Fisik (Menyelaraskan tema warna)
            const conditionBadge = document.getElementById('detail-condition');
            conditionBadge.innerText = condition;
            
            // Reset class badge kondisi terlebih dahulu
            conditionBadge.className = "font-bold px-2.5 py-0.5 rounded-full text-[10px]";
            if (condition === 'Bagus') {
                conditionBadge.classList.add('bg-green-50', 'text-green-700', 'border', 'border-green-200');
            } else if (condition === 'Rusak Ringan') {
                conditionBadge.classList.add('bg-amber-50', 'text-amber-700', 'border', 'border-amber-200');
            } else {
                conditionBadge.classList.add('bg-red-50', 'text-red-700', 'border', 'border-red-200');
            }

            // Logika Pengkondisian Container Gambar Dokumentasi
            const imageContainer = document.getElementById('detail-image-container');
            const imageElement = document.getElementById('detail-image');
            
            if (image && image !== '') {
                imageElement.src = image;
                imageContainer.classList.remove('hidden');
            } else {
                imageElement.src = '';
                imageContainer.classList.add('hidden');
            }

            // Tampilkan modal dengan animasi fade dan scale up
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.replace('scale-95', 'scale-100');
        }

        function closeDetailModal() {
            const modal = document.getElementById('detail-product-modal');
            
            // Sembunyikan modal dengan animasi scale down dan fade out
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.firstElementChild.classList.replace('scale-100', 'scale-95');
        }
    </script>
</body>
</html>