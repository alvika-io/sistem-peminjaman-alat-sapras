<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Alat - SIPRAS</title>
    
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
        .sipras-table tbody tr { transition: all 0.2s; border-bottom: 1px solid #f1f5f9; }
        .sipras-table tbody tr:hover { background-color: #f8fafc; }
        
        .img-preview { object-fit: cover; border-radius: 12px; border: 2px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
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
                        <span class="text-[10px] font-black uppercase tracking-[0.3em]">Inventaris Sapras</span>
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Data Alat</h1>
                    <p class="text-gray-500 font-medium mt-1">Manajemen stok dan kondisi seluruh peralatan sarana prasarana.</p>
                </div>

                <a href="{{ route('admin.alats.create') }}" 
                   class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl shadow-xl shadow-blue-100 transition-all transform hover:-translate-y-1 active:scale-95 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                    <span>Tambah Alat Baru</span>
                </a>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.02)] border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-50 bg-gray-50/50 flex items-center justify-between px-8 py-6">
                    <h3 class="font-black text-gray-800 tracking-tight text-lg">Daftar Inventaris</h3>
                    <span class="bg-white border border-gray-200 text-gray-400 text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-widest">Total: {{ count($alats) }}</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse sipras-table">
                        <thead>
                            <tr>
                                <th class="pl-8">Alat</th>
                                <th>Kategori</th>
                                <th class="text-center">Stok Total</th>
                                <th class="text-center">Tersedia</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium text-gray-600">
                            @foreach ($alats as $alat)
                            <tr>
                                <td class="pl-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="flex-shrink-0">
                                            @if($alat->gambar)
                                                <img src="{{ asset('storage/'.$alat->gambar) }}" alt="{{ $alat->nama }}" class="w-14 h-14 img-preview">
                                            @else
                                                <div class="w-14 h-14 bg-gray-100 rounded-xl flex items-center justify-center text-gray-300">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="text-gray-900 font-black text-base tracking-tight block">{{ $alat->nama }}</span>
                                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest italic">ID: #AL-{{ $alat->id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5">
                                    <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest border border-blue-100">
                                        {{ $alat->kategori->nama ?? 'Tanpa Kategori' }}
                                    </span>
                                </td>
                                <td class="py-5 text-center font-bold text-gray-800">{{ $alat->stok_total }}</td>
                                <td class="py-5 text-center px-4">
                                    @php
                                        $statusColor = $alat->stok_tersedia > 5 ? 'bg-green-100 text-green-700' : ($alat->stok_tersedia > 0 ? 'bg-orange-100 text-orange-700' : 'bg-red-100 text-red-700');
                                    @endphp
                                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl {{ $statusColor }} font-black text-xs min-w-[60px] justify-center shadow-sm">
                                        {{ $alat->stok_tersedia }}
                                    </div>
                                </td>
                                <td class="py-5 text-center px-6">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Tombol Lihat --}}
                                        <a href="{{ route('admin.alats.show', $alat->id) }}" 
                                           class="p-2.5 bg-gray-50 text-gray-400 hover:bg-blue-600 hover:text-white rounded-xl transition-all shadow-sm group">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>

                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('admin.alats.edit', $alat->id) }}" 
                                           class="p-2.5 bg-gray-50 text-gray-400 hover:bg-orange-500 hover:text-white rounded-xl transition-all shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('admin.alats.destroy', $alat->id) }}" 
                                              method="POST" 
                                              class="form-delete inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2.5 bg-gray-50 text-gray-400 hover:bg-red-600 hover:text-white rounded-xl transition-all shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <p class="text-center text-gray-300 text-[10px] mt-12 font-bold uppercase tracking-widest leading-loose">
                SIPRAS Inventory Engine &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('partials.admin-scripts')
</body>
</html>