<style>
    #sipras-sidebar-petugas { font-family: 'Instrument Sans', sans-serif; }
    .nav-item-active-petugas {
        background-color: #f5f3ff !important;
        color: #4f46e5 !important;
    }
    .sidebar-transition {
        transition: all 0.3s ease;
    }
    .sidebar-transition:hover {
        background-color: #f8fafc;
        padding-left: 1.25rem;
    }
    .sub-menu-active {
        color: #4f46e5 !important;
        font-weight: 800 !important;
    }
    /* Sembunyikan submenu secara default jika tidak aktif */
    .menu-hidden {
        display: none;
    }
</style>

<aside id="sipras-sidebar-petugas" class="flex flex-col w-72 h-screen bg-white border-r border-gray-100 shadow-sm overflow-y-auto">
    
    <div class="p-8 flex flex-col">
        <div class="flex items-center gap-3 mb-2">
            <div class="flex-shrink-0 bg-indigo-600 p-2.5 rounded-2xl shadow-lg shadow-indigo-100">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <span class="text-2xl font-black tracking-tighter text-gray-900">SIPRAS<span class="text-indigo-600">.</span></span>
        </div>
        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-1 text-indigo-400/60">Staff Panel</p>
    </div>

    <div class="flex-1 px-4 py-4 overflow-y-auto">
        <p class="px-4 mb-4 text-[11px] font-black text-gray-300 uppercase tracking-widest">Main Menu</p>
        
        <nav class="space-y-2">
            <a href="{{ route('petugas.dashboard') }}" 
               class="sidebar-transition flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-sm {{ request()->is('petugas/dashboard') ? 'nav-item-active-petugas shadow-sm' : 'text-gray-500 hover:text-indigo-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                <span>Dashboard</span>
            </a>

            <div class="space-y-1">
                <button type="button" 
                        onclick="toggleKelolaMenu()"
                        class="sidebar-transition w-full flex items-center justify-between gap-4 px-4 py-3.5 rounded-2xl font-bold text-sm {{ request()->is('petugas/peminjaman*') || request()->is('petugas/alasan-penolakan*') ? 'bg-indigo-50/50 text-indigo-600' : 'text-gray-500 hover:text-indigo-600' }}">
                    <div class="flex items-center gap-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        <span>Kelola Peminjaman</span>
                    </div>
                    <svg id="arrow-kelola" class="w-4 h-4 transition-transform duration-300 {{ request()->is('petugas/peminjaman*') || request()->is('petugas/alasan-penolakan*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div id="submenu-kelola" class="pl-12 space-y-1 pb-2 {{ request()->is('petugas/peminjaman*') || request()->is('petugas/alasan-penolakan*') ? '' : 'menu-hidden' }}">
                    <a href="{{ route('petugas.peminjaman.index') }}" 
                       class="block py-2 text-[13px] font-bold transition-colors {{ request()->is('petugas/peminjaman*') ? 'sub-menu-active' : 'text-gray-400 hover:text-indigo-500' }}">
                        Data Peminjaman
                    </a>
                    <a href="{{ route('petugas.alasan-penolakan.index') }}" 
                       class="block py-2 text-[13px] font-bold transition-colors {{ request()->is('petugas/alasan-penolakan*') ? 'sub-menu-active' : 'text-gray-400 hover:text-indigo-500' }}">
                        Alasan Penolakan
                    </a>
                </div>
            </div>

            <a href="{{ route('petugas.pengembalian.index') }}" 
               class="sidebar-transition flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-sm {{ request()->is('petugas/pengembalian*') ? 'nav-item-active-petugas shadow-sm' : 'text-gray-500 hover:text-indigo-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                <span>Pengembalian</span>
            </a>

            <a href="{{ route('petugas.laporan.pengembalian') }}" 
               class="sidebar-transition flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-sm {{ request()->is('petugas/laporan*') ? 'nav-item-active-petugas shadow-sm' : 'text-gray-500 hover:text-indigo-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span>Laporan Log</span>
            </a>

            <div class="my-4 border-t border-gray-100 mx-4"></div>
            
            <p class="px-4 mb-4 text-[11px] font-black text-gray-300 uppercase tracking-widest">Settings</p>

            <a href="{{ route('petugas.denda.index') }}" 
               class="sidebar-transition flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-sm {{ request()->routeIs('petugas.denda.*') ? 'nav-item-active-petugas shadow-sm' : 'text-gray-500 hover:text-indigo-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>Kebijakan Denda</span>
            </a>

            <a href="{{ route('profile.edit') }}" 
               class="sidebar-transition flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-sm {{ request()->routeIs('profile.*') ? 'nav-item-active-petugas shadow-sm' : 'text-gray-500 hover:text-indigo-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span>Profil Saya</span>
            </a>
        </nav>
    </div>

    <div class="p-6 mt-auto">
        <div class="bg-indigo-50/50 rounded-[2rem] p-4 flex items-center gap-3 border border-indigo-100/50">
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-600 border-2 border-white flex items-center justify-center text-white font-black text-xs shadow-sm uppercase">
                {{ substr(Auth::user()->name, 0, 2) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-[12px] font-black text-gray-800 truncate uppercase tracking-tighter">{{ Auth::user()->name }}</p>
                <div class="flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                    <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Active Session</p>
                </div>
            </div>
        </div>
    </div>
</aside>

<script>
    function toggleKelolaMenu() {
        const submenu = document.getElementById('submenu-kelola');
        const arrow = document.getElementById('arrow-kelola');
        
        if (submenu.classList.contains('menu-hidden')) {
            submenu.classList.remove('menu-hidden');
            arrow.classList.add('rotate-180');
        } else {
            submenu.classList.add('menu-hidden');
            arrow.classList.remove('rotate-180');
        }
    }
</script>