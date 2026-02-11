<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, Indonesian">
    <title>Dashboard Peminjam - SIPRAS</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        /* Mencegah scroll di body utama agar sidebar tidak ikut tergulung */
        body, html { 
            height: 100%; 
            margin: 0; 
            overflow: hidden; 
            font-family: 'Instrument Sans', sans-serif; 
            background-color: #f8fafc; 
        }

        /* Wrapper utama setinggi layar monitor */
        .main-wrapper { 
            display: flex; 
            height: 100vh; 
            width: 100%;
        }

        /* Sidebar Wrapper tetap diam di posisi kiri */
        .sidebar-wrapper {
            height: 100vh;
            flex-shrink: 0;
            z-index: 50;
        }

        /* Area konten dengan scroll mandiri */
        .content-area { 
            flex: 1; 
            display: flex; 
            flex-direction: column; 
            height: 100vh; 
            overflow-y: auto; 
            min-width: 0; 
            scroll-behavior: smooth;
        }

        .user-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .user-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>

<div class="main-wrapper">
    <div class="sidebar-wrapper">
        @include('peminjam.partials.sidebar')
    </div>

    <div class="content-area">
        @include('peminjam.partials.navbar')

        <main class="p-8 lg:p-12">
            
            <div class="mb-10 text-center lg:text-left">
                <div class="flex items-center gap-3 mb-2 justify-center lg:justify-start text-emerald-600">
                    <span class="h-1 w-8 bg-emerald-600 rounded-full"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em]">User Dashboard</span>
                </div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Selamat Datang, {{ auth()->user()->name }}!</h1>
                <p class="text-gray-500 font-medium mt-1">Gunakan platform ini untuk meminjam fasilitas sarana prasarana dengan mudah.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 user-card bg-white p-10 rounded-[3rem] shadow-[0_20px_50px_rgba(16,185,129,0.05)] border border-gray-50 relative overflow-hidden group text-center lg:text-left">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-emerald-50 rounded-full opacity-50 transition-transform group-hover:scale-125 duration-700"></div>
                    
                    <div class="relative z-10">
                        <h3 class="text-2xl font-black text-gray-800 mb-4 flex items-center justify-center lg:justify-start gap-3">
                            <span class="text-3xl">🚀</span> Siap untuk Meminjam?
                        </h3>
                        <p class="text-gray-500 text-lg leading-relaxed mb-8 font-medium">
                            Anda dapat mengajukan peminjaman alat secara mandiri. Pastikan untuk selalu menjaga kondisi barang yang Anda pinjam.
                        </p>

                        <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                            <a href="{{ route('peminjam.peminjaman.index') }}" 
                               class="px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black rounded-2xl shadow-xl shadow-emerald-100 transition-all transform active:scale-95 text-xs uppercase tracking-widest">
                                Ajukan Peminjaman
                            </a>
                            <div class="px-8 py-4 bg-gray-50 text-emerald-600 font-bold rounded-2xl text-xs uppercase tracking-widest border border-emerald-50">
                                Status: Member Aktif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="user-card bg-emerald-600 p-10 rounded-[3rem] shadow-xl shadow-emerald-100 text-white relative overflow-hidden">
                    <div class="absolute -left-5 -bottom-5 opacity-10">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                    </div>
                    
                    <div class="relative z-10">
                        <h4 class="text-lg font-black tracking-tight mb-4 italic">Tips Peminjaman</h4>
                        <ul class="space-y-4 text-left">
                            <li class="flex items-start gap-3">
                                <span class="bg-white/20 p-1 rounded-md text-[8px] flex-shrink-0 mt-1">01</span>
                                <p class="text-xs font-bold leading-normal text-emerald-50">Cek ketersediaan stok alat di daftar peminjaman.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="bg-white/20 p-1 rounded-md text-[8px] flex-shrink-0 mt-1">02</span>
                                <p class="text-xs font-bold leading-normal text-emerald-50">Kembalikan alat tepat waktu untuk menghindari denda.</p>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="bg-white/20 p-1 rounded-md text-[8px] flex-shrink-0 mt-1">03</span>
                                <p class="text-xs font-bold leading-normal text-emerald-50">Segera lapor jika ada kerusakan pada alat.</p>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="mt-16 text-center">
                <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.3em] leading-loose italic">
                    SIPRAS Member Experience &copy; 2026 - Layanan Fasilitas Digital
                </p>
            </div>

        </main>
    </div>
</div>

</body>
</html>