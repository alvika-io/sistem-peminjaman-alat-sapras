<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

<style>
    #sipras-sidebar-petugas { font-family: 'Instrument Sans', sans-serif; }
    .nav-item-active-petugas {
        background-color: #f5f3ff !important; /* indigo-50 */
        color: #4f46e5 !important; /* indigo-600 */
    }
    /* Dark mode active state */
    .dark .nav-item-active-petugas {
        background-color: rgba(79, 70, 229, 0.1) !important;
        color: #818cf8 !important; /* indigo-400 */
    }
    .sidebar-transition {
        transition: all 0.3s ease;
    }
    .sidebar-transition:hover {
        background-color: #f8fafc;
        padding-left: 1.25rem;
    }
    .dark .sidebar-transition:hover {
        background-color: #1e293b; /* slate-800 */
    }
</style>

<aside id="sipras-sidebar-petugas" class="flex flex-col w-72 h-screen bg-white dark:bg-slate-900 border-r border-gray-100 dark:border-slate-800 shadow-sm overflow-y-auto transition-colors duration-300">
    
    <div class="p-8 flex flex-col">
        <div class="flex items-center gap-3 mb-2">
            <div class="flex-shrink-0 bg-indigo-600 p-2.5 rounded-2xl shadow-lg shadow-indigo-100 dark:shadow-indigo-900/20">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <span class="text-2xl font-black tracking-tighter text-gray-900 dark:text-white">SIPRAS<span class="text-indigo-600 dark:text-indigo-400">.</span></span>
        </div>
        <p class="text-[10px] font-black text-gray-400 dark:text-slate-500 uppercase tracking-[0.2em] ml-1 text-indigo-400/60">Staff Panel</p>
    </div>

    <div class="flex-1 px-4 py-4 overflow-y-auto">
        <p class="px-4 mb-4 text-[11px] font-black text-gray-300 dark:text-slate-700 uppercase tracking-widest">Main Menu</p>
        
        <nav class="space-y-2">
            <a href="{{ route('petugas.dashboard') }}" 
               class="sidebar-transition flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-sm {{ request()->is('petugas/dashboard') ? 'nav-item-active-petugas shadow-sm' : 'text-gray-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('petugas.peminjaman.index') }}" 
               class="sidebar-transition flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-sm {{ request()->is('petugas/peminjaman*') ? 'nav-item-active-petugas shadow-sm' : 'text-gray-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                <span>Peminjaman</span>
            </a>

            <a href="{{ route('petugas.pengembalian.index') }}" 
               class="sidebar-transition flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-sm {{ request()->is('petugas/pengembalian*') ? 'nav-item-active-petugas shadow-sm' : 'text-gray-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                <span>Pengembalian</span>
            </a>

            <a href="{{ route('petugas.laporan.pengembalian') }}" 
               class="sidebar-transition flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-sm {{ request()->is('petugas/laporan*') ? 'nav-item-active-petugas shadow-sm' : 'text-gray-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span>Laporan Log</span>
            </a>

            <div class="my-4 border-t border-gray-100 dark:border-slate-800 mx-4"></div>

            <a href="{{ route('petugas.denda.index') }}" 
               class="sidebar-transition flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-sm {{ request()->routeIs('petugas.denda.*') ? 'nav-item-active-petugas shadow-sm' : 'text-gray-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>Kebijakan Denda</span>
            </a>
        </nav>
    </div>

    <div class="p-6 mt-auto">
        <div class="bg-indigo-50/50 dark:bg-slate-800/50 rounded-[2rem] p-4 flex items-center gap-3 border border-indigo-100/50 dark:border-slate-700">
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-600 border-2 border-white dark:border-slate-900 flex items-center justify-center text-white font-black text-xs shadow-sm">
                PT
            </div>
            <div class="overflow-hidden">
                <p class="text-[12px] font-black text-gray-800 dark:text-white truncate uppercase tracking-tighter">Petugas Sapras</p>
                <div class="flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                    <p class="text-[9px] text-gray-400 dark:text-slate-500 font-bold uppercase tracking-widest">Active Session</p>
                </div>
            </div>
        </div>
    </div>
</aside>