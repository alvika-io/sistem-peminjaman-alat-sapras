<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, Indonesian">
    <title>Pengaturan Denda - SIPRAS Petugas</title>
    
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

        /* Sidebar Wrapper tetap di posisi kiri */
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

        /* Input Card Styling */
        .config-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .config-card:focus-within {
            border-color: #4f46e5;
            box-shadow: 0 10px 30px -10px rgba(79, 70, 229, 0.1);
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

        <main class="p-8 lg:p-12">
            
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-2 text-orange-600">
                    <span class="h-1 w-8 bg-orange-600 rounded-full"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] dark:text-orange-400">System Configuration</span>
                </div>
                <h1 class="text-4xl font-black text-gray-900 dark:text-white tracking-tighter">Pengaturan Denda</h1>
                <p class="text-gray-500 dark:text-slate-400 font-medium mt-1">Sesuaikan nominal denda otomatis berdasarkan keterlambatan dan kondisi alat.</p>
            </div>

            <div class="max-w-4xl">
                <form action="{{ route('petugas.denda.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="config-card bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] border border-gray-100 dark:border-slate-800 shadow-sm">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4 block">Denda Telat (Per Hari)</label>
                            <div class="flex items-center gap-4">
                                <div class="p-4 bg-orange-50 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400 rounded-2xl">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <span class="text-xl font-black text-gray-300 mr-2">Rp</span>
                                        <input type="number" name="denda_telat_per_hari" value="{{ $pengaturan->denda_telat_per_hari }}" 
                                            class="w-full bg-transparent border-none text-2xl font-black text-gray-900 dark:text-white outline-none focus:ring-0 p-0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="config-card bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] border border-gray-100 dark:border-slate-800 shadow-sm">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4 block">Denda Kondisi Rusak</label>
                            <div class="flex items-center gap-4">
                                <div class="p-4 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-2xl">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <span class="text-xl font-black text-gray-300 mr-2">Rp</span>
                                        <input type="number" name="denda_rusak" value="{{ $pengaturan->denda_rusak }}" 
                                            class="w-full bg-transparent border-none text-2xl font-black text-gray-900 dark:text-white outline-none focus:ring-0 p-0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="config-card md:col-span-2 bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] border border-gray-100 dark:border-slate-800 shadow-sm">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                                <div class="flex items-center gap-6">
                                    <div class="p-4 bg-gray-900 dark:bg-slate-800 text-white rounded-2xl">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1 block">Denda Kondisi Hilang</label>
                                        <div class="flex items-center">
                                            <span class="text-2xl font-black text-gray-300 mr-3">Rp</span>
                                            <input type="number" name="denda_hilang" value="{{ $pengaturan->denda_hilang }}" 
                                                class="w-full bg-transparent border-none text-4xl font-black text-gray-900 dark:text-white outline-none focus:ring-0 p-0 tracking-tighter">
                                        </div>
                                    </div>
                                </div>
                                <div class="max-w-xs text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-relaxed bg-gray-50 dark:bg-slate-800/50 p-4 rounded-2xl">
                                    Nilai ini akan diterapkan otomatis saat petugas memilih status "Hilang" pada proses pengembalian alat.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full md:w-auto px-12 py-5 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-3xl shadow-xl shadow-indigo-100 transition-all text-xs uppercase tracking-[0.2em] active:scale-95">
                            Simpan Kebijakan Denda
                        </button>
                    </div>
                </form>
            </div>
            
            <p class="text-center text-gray-300 text-[10px] mt-12 font-bold uppercase tracking-widest">
                SIPRAS Policy Manager &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('petugas.partials.scripts')

</body>
</html>