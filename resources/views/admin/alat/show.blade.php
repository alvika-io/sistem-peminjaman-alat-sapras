<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Alat - SIPRAS</title>
    
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
        
        .info-label {
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #94a3b8; /* slate-400 */
        }
        .info-value {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1e293b; /* slate-800 */
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

        <main class="p-8 lg:p-12 flex flex-col items-center">
            
            <div class="w-full max-w-4xl mb-10 flex flex-col md:flex-row justify-between items-end gap-6 text-center md:text-left">
                <div>
                    <div class="flex items-center gap-3 mb-2 justify-center md:justify-start">
                        <span class="h-1 w-8 bg-blue-600 rounded-full"></span>
                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.3em]">Spesifikasi Inventaris</span>
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Detail Alat</h1>
                    <p class="text-gray-500 font-medium mt-1 uppercase text-xs tracking-widest">ID Barang: #AL-{{ $alat->id }}</p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('admin.alats.index') }}" 
                       class="px-6 py-3 bg-white border border-gray-100 text-gray-500 font-bold rounded-2xl text-xs transition-all hover:bg-gray-50 uppercase tracking-widest shadow-sm">
                        Kembali
                    </a>
                    <a href="{{ route('admin.alats.edit', $alat->id) }}" 
                       class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-2xl shadow-lg shadow-orange-100 transition-all transform hover:-translate-y-1 active:scale-95 text-xs uppercase tracking-widest">
                        Edit Data
                    </a>
                </div>
            </div>

            <div class="w-full max-w-4xl bg-white rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.03)] border border-gray-50 overflow-hidden mb-12">
                <div class="flex flex-col lg:flex-row">
                    
                    <div class="lg:w-1/2 p-8 bg-gray-50/50 flex items-center justify-center border-b lg:border-b-0 lg:border-r border-gray-100">
                        @if($alat->gambar)
                            <div class="relative group">
                                <div class="absolute inset-0 bg-blue-600 rounded-3xl blur-2xl opacity-10 group-hover:opacity-20 transition-opacity"></div>
                                <img src="{{ asset('storage/'.$alat->gambar) }}" alt="{{ $alat->name }}" 
                                     class="relative w-full max-w-[320px] aspect-square object-cover rounded-[2rem] shadow-2xl border-8 border-white transition-transform hover:scale-105 duration-500">
                            </div>
                        @else
                            <div class="w-64 h-64 bg-gray-200 rounded-[2rem] flex flex-col items-center justify-center text-gray-400 gap-3 border-4 border-dashed border-gray-300">
                                <svg class="w-16 h-16 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span class="text-[10px] font-black uppercase tracking-widest">Tidak Ada Foto</span>
                            </div>
                        @endif
                    </div>

                    <div class="lg:w-1/2 p-10 lg:p-14 space-y-8">
                        <div class="pb-6 border-b border-gray-100">
                            <p class="info-label mb-1">Informasi Nama</p>
                            <h3 class="text-3xl font-black text-gray-900 tracking-tight">{{ $alat->nama }}</h3>
                        </div>

                        <div class="grid grid-cols-2 gap-8">
                            <div>
                                <p class="info-label mb-1">Kategori</p>
                                <div class="flex items-center gap-2">
                                    <span class="p-1.5 bg-blue-50 text-blue-600 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                    </span>
                                    <span class="info-value text-sm">{{ $alat->kategori->nama ?? '-' }}</span>
                                </div>
                            </div>

                            <div>
                                <p class="info-label mb-1">Status Ketersediaan</p>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $alat->stok_tersedia > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $alat->stok_tersedia > 0 ? 'Tersedia' : 'Kosong' }}
                                </span>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-[2rem] p-6 flex justify-around items-center border border-gray-100 shadow-inner">
                            <div class="text-center">
                                <p class="info-label mb-1">Stok Total</p>
                                <p class="text-2xl font-black text-gray-800">{{ $alat->stok_total }}</p>
                            </div>
                            <div class="h-10 w-px bg-gray-200"></div>
                            <div class="text-center">
                                <p class="info-label mb-1">Sisa Stok</p>
                                <p class="text-2xl font-black text-blue-600">{{ $alat->stok_tersedia }}</p>
                            </div>
                        </div>

                        <div class="pt-6 flex items-center gap-3 opacity-50">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <p class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Data inventaris telah diverifikasi oleh sistem SIPRAS.</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-center text-gray-300 text-[10px] mt-4 font-bold uppercase tracking-widest">
                SIPRAS Registry &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('partials.admin-scripts')
</body>
</html>