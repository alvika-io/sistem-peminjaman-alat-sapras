<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIPRAS</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        body { 
            font-family: 'Instrument Sans', sans-serif; 
            margin: 0;
        }
        .main-wrapper {
            display: flex;
            height: 100vh;
            width: 100%;
        }
        .content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        .dashboard-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1);
        }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-slate-950 transition-colors duration-300">

<div class="main-wrapper flex">
    @include('partials.admin-sidebar')

    <div class="content-area flex-1 flex flex-col h-screen overflow-hidden">
        @include('partials.navbar')

        <div class="content flex-1 overflow-y-auto p-8 lg:p-12">
            
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-2">
                    <span class="h-1 w-8 bg-blue-600 rounded-full"></span>
                    <span class="text-[10px] font-black text-blue-600 dark:text-blue-400 uppercase tracking-[0.3em]">Ringkasan Data</span>
                </div>
                <h1 class="text-4xl font-black text-gray-900 dark:text-white tracking-tighter">Dashboard Admin</h1>
                <p class="text-gray-500 dark:text-slate-400 font-medium mt-1">Sistem Pemantauan Sarana & Prasarana Digital.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                
                <div class="dashboard-card bg-white dark:bg-slate-900 p-6 rounded-[2.5rem] border border-gray-100 dark:border-slate-800 shadow-sm flex flex-col gap-4">
                    <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 11m8 4V5M4 11v10l8 4" /></svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-gray-400 dark:text-slate-500 uppercase tracking-widest mb-1">Jumlah Alat</p>
                        <h2 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">{{ number_format($totalAlat) }} <span class="text-xs text-gray-300 dark:text-slate-600 font-medium italic uppercase tracking-widest ml-1">Unit</span></h2>
                    </div>
                </div>

                <div class="dashboard-card bg-white dark:bg-slate-900 p-6 rounded-[2.5rem] border border-gray-100 dark:border-slate-800 shadow-sm flex flex-col gap-4">
                    <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-gray-400 dark:text-slate-500 uppercase tracking-widest mb-1">Stok Tersedia</p>
                        <h2 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">{{ number_format($totalAlat - $alatDipinjam) }} <span class="text-xs text-gray-300 dark:text-slate-600 font-medium italic uppercase tracking-widest ml-1">Unit</span></h2>
                    </div>
                </div>

                <div class="dashboard-card bg-white dark:bg-slate-900 p-6 rounded-[2.5rem] border border-gray-100 dark:border-slate-800 shadow-sm flex flex-col gap-4">
                    <div class="w-12 h-12 bg-orange-50 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-gray-400 dark:text-slate-500 uppercase tracking-widest mb-1">Sedang Dipinjam</p>
                        <h2 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">{{ number_format($alatDipinjam) }} <span class="text-xs text-gray-300 dark:text-slate-600 font-medium italic uppercase tracking-widest ml-1">Unit</span></h2>
                    </div>
                </div>

                <div class="dashboard-card bg-white dark:bg-slate-900 p-6 rounded-[2.5rem] border border-gray-100 dark:border-slate-800 shadow-sm flex flex-col gap-4">
                    <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857" /></svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-gray-400 dark:text-slate-500 uppercase tracking-widest mb-1">Peminjam Aktif</p>
                        <h2 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">{{ number_format($peminjamAktif) }} <span class="text-xs text-gray-300 dark:text-slate-600 font-medium italic uppercase tracking-widest ml-1">User</span></h2>
                    </div>
                </div>

                <div class="dashboard-card bg-white dark:bg-slate-900 p-6 rounded-[2.5rem] border border-gray-100 dark:border-slate-800 shadow-sm flex flex-col gap-4">
                    <div class="w-12 h-12 bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-gray-400 dark:text-slate-500 uppercase tracking-widest mb-1">Total Petugas</p>
                        <h2 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">{{ number_format($totalPetugas) }} <span class="text-xs text-gray-300 dark:text-slate-600 font-medium italic uppercase tracking-widest ml-1">Staff</span></h2>
                    </div>
                </div>

            </div>

            <div class="mt-12 pt-8 border-t border-gray-100 dark:border-slate-800">
                <p class="text-center text-gray-300 dark:text-slate-700 text-[10px] font-bold uppercase tracking-widest">
                    &copy; 2026 SIPRAS - Audit Trail & Resource Analytics
                </p>
            </div>
        </div>
    </div>
</div>

</body>
</html>