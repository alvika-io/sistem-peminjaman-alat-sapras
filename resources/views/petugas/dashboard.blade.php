<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas - SIPRAS</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        body { 
            font-family: 'Instrument Sans', sans-serif; 
            background-color: #f8fafc; 
            margin: 0;
        }
        /* Layout Wrapper agar Sidebar & Konten berdampingan */
        .main-wrapper {
            display: flex;
            min-height: 100vh;
        }
        .content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        .petugas-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .petugas-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>

<div class="main-wrapper flex">
    @include('petugas.partials.sidebar')

    <div class="content-area flex-1 flex flex-col h-screen overflow-hidden">
        @include('petugas.partials.navbar')

        <div class="content flex-1 overflow-y-auto p-8 lg:p-12">
            
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-2 text-indigo-600">
                    <span class="h-1 w-8 bg-indigo-600 rounded-full"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em]">Operational Dashboard</span>
                </div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tighter italic">Halo, {{ auth()->user()->name }}!</h1>
                <p class="text-gray-500 font-medium mt-1">Status operasional hari ini: <span class="text-green-500 font-bold">Sistem Aktif & Aman</span>.</p>
            </div>

            <div class="petugas-card bg-white p-10 rounded-[3rem] shadow-[0_20px_50px_rgba(79,70,229,0.05)] border border-gray-50 mb-10 relative overflow-hidden group">
                <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-indigo-50 rounded-full opacity-50 transition-transform group-hover:scale-150 duration-700"></div>
                
                <div class="relative z-10">
                    <h3 class="text-2xl font-black text-gray-800 mb-4 flex items-center gap-3">
                        <span class="text-3xl">👋</span> Anda login sebagai <span class="text-indigo-600 tracking-tighter">Petugas</span>
                    </h3>
                    <p class="text-gray-500 text-lg max-w-2xl leading-relaxed mb-8 font-medium italic">
                        Pantau dan kelola aset sapras dengan efisien. Gunakan kontrol navigasi di samping untuk mengakses fitur utama:
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-100 transition-colors hover:bg-indigo-50">
                            <div class="p-2 bg-white rounded-xl shadow-sm text-indigo-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </div>
                            <span class="text-sm font-bold text-gray-700">Data Peminjaman</span>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-100 transition-colors hover:bg-indigo-50">
                            <div class="p-2 bg-white rounded-xl shadow-sm text-indigo-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m13 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            </div>
                            <span class="text-sm font-bold text-gray-700">Pengembalian Alat</span>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-100 transition-colors hover:bg-indigo-50">
                            <div class="p-2 bg-white rounded-xl shadow-sm text-indigo-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <span class="text-sm font-bold text-gray-700">Laporan Aktivitas</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-6 p-6 bg-indigo-600 rounded-[2rem] text-white shadow-xl shadow-indigo-100 overflow-hidden relative">
                <div class="absolute -right-4 -bottom-4 opacity-10 rotate-12">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
                </div>
                <div class="bg-white/20 p-4 rounded-2xl backdrop-blur-md">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-black tracking-tight text-lg underline decoration-white/30 underline-offset-4">Protokol Keamanan</h4>
                    <p class="text-indigo-100 text-sm font-medium mt-1 leading-relaxed">Pastikan setiap peminjaman diproses dengan validasi data yang benar. Cek kondisi fisik alat saat pengembalian dan hitung denda secara otomatis melalui sistem.</p>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-100 text-center">
                <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest leading-loose">
                    SIPRAS Petugas Environment &copy; 2026 - Security Protocol Integrated
                </p>
            </div>
        </div>
    </div>
</div>

@include('petugas.partials.scripts')

</body>
</html>