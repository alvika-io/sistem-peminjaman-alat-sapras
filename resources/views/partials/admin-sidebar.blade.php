<style>
    #sipras-sidebar { font-family: 'Instrument Sans', sans-serif; }
    .nav-item-active {
        background-color: #eff6ff !important; /* blue-50 */
        color: #2563eb !important; /* blue-600 */
    }
    /* Dark mode active state */
    .dark .nav-item-active {
        background-color: rgba(37, 99, 235, 0.1) !important;
        color: #60a5fa !important; /* blue-400 */
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

<aside id="sipras-sidebar" class="flex flex-col w-72 h-screen bg-white dark:bg-slate-900 border-r border-gray-100 dark:border-slate-800 shadow-sm overflow-y-auto transition-colors duration-300">
    
    <div class="p-8 flex flex-col">
        <div class="flex items-center gap-3 mb-2">
            <div class="flex-shrink-0 bg-blue-600 p-2.5 rounded-2xl shadow-lg shadow-blue-100 dark:shadow-blue-900/20">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <span class="text-2xl font-black tracking-tighter text-gray-900 dark:text-slate-100">SIPRAS<span class="text-blue-600 dark:text-blue-400">.</span></span>
        </div>
        <p class="text-[10px] font-bold text-gray-400 dark:text-slate-500 uppercase tracking-[0.2em] ml-1">Admin Panel</p>
    </div>

    <div class="flex-1 px-4 py-4 overflow-y-auto">
        <p class="px-4 mb-4 text-[11px] font-black text-gray-300 dark:text-slate-700 uppercase tracking-widest">Main Menu</p>
        
        <nav class="space-y-2">
            @php
                $navItems = [
                    ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z'],
                    ['route' => 'admin.users.index', 'label' => 'Data User', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                    ['route' => 'admin.kategoris.index', 'label' => 'Data Kategori', 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
                    ['route' => 'admin.alats.index', 'label' => 'Data Alat', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 11m8 4V5M4 11v10l8 4'],
                    ['route' => 'admin.log-aktivitas.index', 'label' => 'Log Aktivitas', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                ];
            @endphp

            @foreach($navItems as $item)
            <a href="{{ route($item['route']) }}" 
               class="sidebar-transition flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-sm {{ request()->routeIs($item['route'] . '*') ? 'nav-item-active shadow-sm' : 'text-gray-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path></svg>
                <span>{{ $item['label'] }}</span>
            </a>
            @endforeach
        </nav>
    </div>

    <div class="p-6 mt-auto">
        <div class="bg-gray-50 dark:bg-slate-800 rounded-[2rem] p-4 flex items-center gap-3 border border-gray-100 dark:border-slate-700 transition-colors">
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-600 border-2 border-white dark:border-slate-900 flex items-center justify-center text-white font-black text-xs shadow-sm">
                AD
            </div>
            <div class="overflow-hidden">
                <p class="text-[12px] font-black text-gray-800 dark:text-slate-100 truncate uppercase tracking-tighter">Administrator</p>
                <div class="flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                    <p class="text-[9px] text-gray-400 dark:text-slate-500 font-bold uppercase tracking-widest">Sistem Online</p>
                </div>
            </div>
        </div>
    </div>
</aside>