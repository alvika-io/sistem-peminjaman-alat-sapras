<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori - SIPRAS</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        /* Mencegah scroll di body utama agar sidebar tidak ikut terangkat */
        body, html { 
            height: 100%; 
            margin: 0; 
            overflow: hidden; 
            font-family: 'Instrument Sans', sans-serif; 
            background-color: #f8fafc; 
        }

        /* Wrapper utama setinggi layar penuh */
        .main-wrapper { 
            display: flex; 
            height: 100vh; 
            width: 100%;
        }

        /* Sidebar Wrapper tetap diam di kiri */
        .sidebar-wrapper {
            height: 100vh;
            flex-shrink: 0;
            z-index: 50;
        }

        /* Area konten yang bisa di-scroll secara mandiri */
        .content-area { 
            flex: 1; 
            display: flex; 
            flex-direction: column; 
            height: 100vh; 
            overflow-y: auto; 
            min-width: 0; 
            scroll-behavior: smooth;
        }
        
        /* Custom Table Styling */
        .sipras-table thead th {
            background-color: #f1f5f9;
            color: #64748b;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            font-weight: 800;
            padding: 1.25rem 1rem;
            position: sticky; /* Header tabel nempel saat scroll */
            top: 0;
            z-index: 10;
        }
        .sipras-table tbody tr {
            transition: all 0.2s;
            border-bottom: 1px solid #f1f5f9;
        }
        .sipras-table tbody tr:hover {
            background-color: #f8fafc;
        }
    </style>
</head>
<body>

<div class="main-wrapper">
    <div class="sidebar-wrapper">
        @include('partials.admin-sidebar')
    </div>

    <div class="content-area">
        @include('partials.navbar')

        <main class="p-8 lg:p-12">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
                <div>
                    <div class="flex items-center gap-3 mb-2 text-blue-600">
                        <span class="h-1 w-8 bg-blue-600 rounded-full"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em]">Klasifikasi Inventaris</span>
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Data Kategori</h1>
                    <p class="text-gray-500 font-medium mt-1">Kelola pengelompokan alat agar pencarian lebih efisien.</p>
                </div>

                <a href="{{ route('admin.kategoris.create') }}" 
                   class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl shadow-xl shadow-blue-100 transition-all transform hover:-translate-y-1 active:scale-95 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                    <span>Tambah Kategori</span>
                </a>
            </div>

            <div class="max-w-4xl bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.02)] border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-50 bg-gray-50/50 flex items-center justify-between px-8 py-6">
                    <h3 class="font-black text-gray-800 tracking-tight text-lg">Daftar Kategori Alat</h3>
                    <div class="flex items-center gap-2 bg-white px-3 py-1.5 rounded-xl border border-gray-100">
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        <span class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Aktif: {{ count($kategoris) }}</span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse sipras-table">
                        <thead>
                            <tr>
                                <th class="pl-8 w-2/3">Nama Kategori</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium text-gray-600">
                            @forelse ($kategoris as $kategori)
                            <tr class="group">
                                <td class="pl-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-gray-50 text-blue-600 flex items-center justify-center font-black text-xs border border-gray-100 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                        </div>
                                        <div>
                                            <span class="text-gray-900 font-black text-base tracking-tight">{{ $kategori->nama }}</span>
                                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter mt-0.5">Kategori Inventaris</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5 text-center px-8">
                                    <div class="flex items-center justify-center gap-3">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('admin.kategoris.edit', $kategori->id) }}" 
                                           class="p-3 bg-gray-50 text-gray-400 hover:bg-blue-600 hover:text-white rounded-2xl transition-all shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('admin.kategoris.destroy', $kategori->id) }}" 
                                              method="POST" 
                                              class="form-delete inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-3 bg-gray-50 text-gray-400 hover:bg-red-600 hover:text-white rounded-2xl transition-all shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="py-20 text-center">
                                    <div class="flex flex-col items-center opacity-30">
                                        <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        <p class="font-bold uppercase tracking-[0.2em] text-xs italic">Belum ada data kategori</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <p class="text-center text-gray-300 text-[10px] mt-12 font-bold uppercase tracking-widest leading-loose">
                SIPRAS Inventory Categorization &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('partials.admin-scripts')
</body>
</html>