<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, Indonesian">
    <title>Detail Pengembalian - SIPRAS Petugas</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        body, html { 
            height: 100%; 
            margin: 0; 
            overflow: hidden; 
            font-family: 'Instrument Sans', sans-serif; 
            background-color: #f8fafc; 
        }

        .main-wrapper { 
            display: flex; 
            height: 100vh; 
            width: 100%;
        }

        .sidebar-wrapper {
            height: 100vh;
            flex-shrink: 0;
            z-index: 50;
        }

        .content-area { 
            flex: 1; 
            display: flex; 
            flex-direction: column; 
            height: 100vh; 
            overflow-y: auto; 
            min-width: 0; 
            scroll-behavior: smooth;
        }

        @media print {
            .sidebar-wrapper, .btn-no-print, nav { display: none !important; }
            .main-wrapper { display: block !important; }
            .content-area { overflow: visible !important; height: auto !important; width: 100% !important; }
            body { background-color: white !important; }
            .card-print { border: none !important; box-shadow: none !important; margin: 0 !important; width: 100% !important; }
            .card-print-body { padding: 0 !important; }
        }
    </style>
</head>
<body class="dark:bg-slate-950 transition-colors duration-300">

<div class="main-wrapper">
    <div class="sidebar-wrapper">
        @include('petugas.partials.sidebar')
    </div>

    <div class="content-area dark:bg-slate-950">
        @include('petugas.partials.navbar')

        <main class="p-8 lg:p-12 flex flex-col items-center">
            
            <div class="w-full max-w-2xl mb-10 flex items-center justify-between btn-no-print">
                <div>
                    <div class="flex items-center gap-3 mb-2 text-indigo-600">
                        <span class="h-1 w-8 bg-indigo-600 rounded-full"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] dark:text-indigo-400">Official Receipt</span>
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 dark:text-white tracking-tighter">Detail Pengembalian</h1>
                </div>
                <a href="{{ route('petugas.pengembalian.index') }}" class="p-3 bg-white dark:bg-slate-800 border border-gray-100 dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-700 text-gray-400 rounded-2xl transition-all shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </a>
            </div>

            <div class="w-full max-w-2xl bg-white dark:bg-slate-900 rounded-[3rem] shadow-[0_20px_50px_rgba(79,70,229,0.03)] border border-gray-50 dark:border-slate-800 overflow-hidden card-print">
                <div class="bg-indigo-600 p-10 text-center text-white relative">
                    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none" style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 20px 20px;"></div>
                    <h2 class="text-2xl font-black tracking-tighter mb-1 uppercase">SIPRAS <span class="text-indigo-200">Inventory</span></h2>
                    <p class="text-[10px] font-bold uppercase tracking-[0.4em] opacity-80">Bukti Pengembalian Alat Resmi</p>
                </div>

                <div class="p-10 lg:p-14 space-y-10 card-print-body">
                    <div class="flex justify-between items-start border-b border-gray-50 dark:border-slate-800 pb-8">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Peminjam</p>
                            <p class="text-xl font-black text-gray-900 dark:text-white">{{ $pengembalian->peminjaman->user->name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">ID Transaksi</p>
                            <p class="text-xs font-mono font-bold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/20 px-3 py-1 rounded-lg">#RTN-{{ $pengembalian->id }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-6">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Barang / Alat</p>
                                <div class="space-y-1">
                                    @foreach($pengembalian->peminjaman->alats as $alat)
                                        <p class="text-sm font-bold text-gray-800 dark:text-slate-200 flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                                            {{ $alat->nama }} ({{ $alat->pivot->jumlah }} pcs)
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Waktu Kembali</p>
                                <p class="text-sm font-bold text-gray-800 dark:text-slate-200 font-mono">{{ \Carbon\Carbon::parse($pengembalian->tanggal_kembali_real)->format('d F Y') }}</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Kondisi Barang</p>
                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 dark:bg-slate-800 text-gray-700 dark:text-slate-300 rounded-lg text-[10px] font-black uppercase tracking-widest">
                                    {{ ucfirst($pengembalian->kondisi) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Status Denda</p>
                                <div class="flex flex-col">
                                    <p class="text-xl font-black {{ $pengembalian->denda > 0 ? 'text-red-500' : 'text-green-500' }}">
                                        @if($pengembalian->denda > 0)
                                            Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                                        @else
                                            BEBAS DENDA
                                        @endif
                                    </p>
                                    @if($pengembalian->denda > 0)
                                        <span class="text-[9px] font-black uppercase tracking-widest {{ $pengembalian->denda_status === 'lunas' ? 'text-green-500' : 'text-orange-500' }}">
                                            Status: {{ strtoupper($pengembalian->denda_status) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-10 border-t border-dashed border-gray-200 dark:border-slate-800 text-center">
                        <div class="inline-block px-6 py-2 bg-slate-50 dark:bg-slate-800/50 rounded-full mb-4">
                            <p class="text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.3em]">Dicetak pada: {{ \Carbon\Carbon::now()->timezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB</p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 btn-no-print">
                        <div class="flex gap-4">
                            <button onclick="window.print()" class="flex-1 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl shadow-xl shadow-indigo-100 dark:shadow-none transition-all flex items-center justify-center gap-3 uppercase tracking-widest text-xs transform hover:-translate-y-1 active:scale-95">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2-2H7a2 2 0 00-2 2v4h12z"/></svg>
                                Cetak Bukti
                            </button>
                            
                            @if($pengembalian->denda > 0 && $pengembalian->denda_status === 'belum_dibayar')
                                <form action="{{ route('petugas.pengembalian.updateStatusDenda', $pengembalian->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="w-full py-4 bg-green-500 hover:bg-green-600 text-white font-black rounded-2xl shadow-xl shadow-green-100 dark:shadow-none transition-all flex items-center justify-center gap-3 uppercase tracking-widest text-xs transform hover:-translate-y-1 active:scale-95">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Tandai Lunas
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-center text-gray-300 dark:text-slate-700 text-[10px] mt-12 font-bold uppercase tracking-widest btn-no-print">
                SIPRAS Official Documentation &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('petugas.partials.scripts')
</body>
</html>