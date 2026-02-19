<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, Indonesian">
    <title>SIPRAS - Smart Inventory & Lending System</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body { 
            font-family: 'Instrument Sans', sans-serif; 
            background-color: #f8fafc;
            background-image: radial-gradient(#e2e8f0 0.5px, transparent 0.5px);
            background-size: 24px 24px;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .hero-gradient {
            background: linear-gradient(135deg, #2563eb 0%, #4f46e5 50%, #10b981 100%);
        }
        .text-gradient {
            background: linear-gradient(to right, #2563eb, #4f46e5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 5s ease-in-out infinite;
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen p-6 lg:p-8">
    
    <header class="w-full lg:max-w-6xl mb-8">
        <nav class="glass-effect flex items-center justify-between gap-4 px-6 py-4 rounded-[2rem] border border-white shadow-sm">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 p-2.5 rounded-2xl shadow-lg shadow-blue-100">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <span class="text-2xl font-black tracking-tighter text-gray-900 uppercase">SIPRAS<span class="text-blue-600">.</span></span>
            </div>

            <div class="flex items-center gap-2">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-gray-900 text-white rounded-xl hover:bg-black transition-all font-bold text-xs uppercase tracking-widest shadow-lg">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 text-gray-500 hover:text-blue-600 transition-all font-bold text-xs uppercase tracking-widest">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all font-bold text-xs uppercase tracking-widest shadow-xl shadow-blue-100">Daftar</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>
    </header>

    <main class="w-full lg:max-w-6xl flex flex-col lg:flex-row bg-white rounded-[3rem] shadow-[0_40px_100px_rgba(0,0,0,0.04)] overflow-hidden border border-gray-50">
        
        <div class="flex-1 p-10 lg:p-20 flex flex-col justify-center">
            <div class="flex items-center gap-3 mb-6">
                <span class="h-1 w-10 hero-gradient rounded-full"></span>
                <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em]">Asset Management System</span>
            </div>
            
            <h1 class="text-5xl lg:text-7xl font-black mb-8 leading-[0.9] text-gray-900 tracking-tighter">
                Pinjam Alat <br><span class="text-gradient">Tanpa Ribet.</span>
            </h1>
            
            <p class="text-gray-500 text-lg mb-10 leading-relaxed font-medium max-w-md italic underline decoration-blue-50 underline-offset-8">
                Solusi cerdas manajemen sarana prasarana. Pantau stok secara real-time, ajukan peminjaman mandiri, dan kelola denda otomatis dalam satu platform.
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                <div class="group p-4 bg-gray-50 rounded-[2rem] border border-transparent hover:border-blue-100 hover:bg-white transition-all">
                    <div class="bg-white group-hover:bg-blue-600 group-hover:text-white w-10 h-10 rounded-xl flex items-center justify-center text-blue-600 shadow-sm transition-all mb-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <p class="font-black text-gray-800 text-sm tracking-tight uppercase">Monitoring Real-time</p>
                    <p class="text-[11px] text-gray-400 font-medium">Cek stok alat langsung dari perangkat Anda.</p>
                </div>
                
                <div class="group p-4 bg-gray-50 rounded-[2rem] border border-transparent hover:border-emerald-100 hover:bg-white transition-all">
                    <div class="bg-white group-hover:bg-emerald-500 group-hover:text-white w-10 h-10 rounded-xl flex items-center justify-center text-emerald-500 shadow-sm transition-all mb-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="font-black text-gray-800 text-sm tracking-tight uppercase">Denda Transparan</p>
                    <p class="text-[11px] text-gray-400 font-medium">Sistem hitung denda status pelunasan terdata.</p>
                </div>
            </div>

            <div class="flex flex-wrap gap-4">
                <a href="{{ route('login') }}" class="px-10 py-5 hero-gradient text-white rounded-2xl transition-all font-black text-xs uppercase tracking-[0.2em] shadow-2xl shadow-blue-200 transform hover:-translate-y-1 active:scale-95">
                    Mulai Eksplorasi Alat
                </a>
            </div>
        </div>

        <div class="lg:w-2/5 hero-gradient p-12 flex items-center justify-center relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-black/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            
            <div class="relative z-10 w-full animate-float">
                <div class="bg-white/10 backdrop-blur-2xl p-6 rounded-[2.5rem] border border-white/20 shadow-2xl mb-6 transform -rotate-3 transition-transform hover:rotate-0 duration-500">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div class="flex-1 h-2 bg-white/20 rounded-full">
                            <div class="w-3/4 h-full bg-white rounded-full"></div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="h-10 bg-white/5 rounded-2xl flex items-center px-4 justify-between border border-white/10">
                            <span class="text-[10px] font-black text-white/80 uppercase">Proyektor LED</span>
                            <span class="text-[10px] font-black text-emerald-400">READY</span>
                        </div>
                        <div class="h-10 bg-white/5 rounded-2xl flex items-center px-4 justify-between border border-white/10">
                            <span class="text-[10px] font-black text-white/80 uppercase">Sound System</span>
                            <span class="text-[10px] font-black text-amber-400">BORROWED</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] shadow-2xl border border-gray-100 absolute -right-4 top-1/2 transform translate-y-4 translate-x-4 hidden lg:block">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Fine Status</p>
                            <p class="text-xs font-black text-gray-900 tracking-tight">Rp 0 (Clean)</p>
                        </div>
                    </div>
                </div>
                
                <div class="text-white text-center mt-8">
                    <h3 class="text-2xl font-black tracking-tighter uppercase italic">Precision Tracking</h3>
                    <p class="text-blue-100 text-[10px] font-bold uppercase tracking-[0.4em] opacity-70">
                        Secure & Managed Assets
                    </p>
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-10 flex flex-col items-center gap-4">
        <div class="flex items-center gap-4 text-gray-300">
            <span class="w-10 h-px bg-gray-200"></span>
            <p class="text-[10px] font-black uppercase tracking-[0.5em]">Inventory Protocol 2.0</p>
            <span class="w-10 h-px bg-gray-200"></span>
        </div>
        <p class="text-gray-400 text-[9px] font-bold uppercase tracking-widest">
            &copy; 2026 SIPRAS System - Dikelola oleh Tim Sarana Prasarana
        </p>
    </footer>

</body>
</html>