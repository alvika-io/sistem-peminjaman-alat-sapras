<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

<style>
    #sipras-sidebar-peminjam { font-family: 'Instrument Sans', sans-serif; }
    .nav-item-active-peminjam {
        background-color: #ecfdf5 !important; /* emerald-50 */
        color: #059669 !important; /* emerald-600 */
    }
    .sidebar-transition {
        transition: all 0.3s ease;
    }
    .sidebar-transition:hover {
        background-color: #f8fafc;
        padding-left: 1.25rem;
    }
</style>

<aside id="sipras-sidebar-peminjam" class="flex flex-col w-72 h-screen bg-white border-r border-gray-100 shadow-sm overflow-y-auto">
    
    <div class="p-8 flex flex-col">
        <div class="flex items-center gap-3 mb-2">
            <div class="flex-shrink-0 bg-emerald-600 p-2.5 rounded-2xl shadow-lg shadow-emerald-100">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <span class="text-2xl font-black tracking-tighter text-gray-900">SIPRAS<span class="text-emerald-600">.</span></span>
        </div>
        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-1">Member Area</p>
    </div>

    <div class="flex-1 px-4 py-4 overflow-y-auto">
        <p class="px-4 mb-4 text-[11px] font-black text-gray-300 uppercase tracking-widest">Navigation</p>
        
        <nav class="space-y-2">
            <a href="{{ route('peminjam.dashboard') }}" 
               class="sidebar-transition flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-sm {{ request()->routeIs('peminjam.dashboard') ? 'nav-item-active-peminjam shadow-sm' : 'text-gray-500 hover:text-emerald-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('peminjam.peminjaman.index') }}" 
               class="sidebar-transition flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-sm {{ request()->routeIs('peminjam.peminjaman.*') ? 'nav-item-active-peminjam shadow-sm' : 'text-gray-500 hover:text-emerald-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span>Pinjam Alat</span>
            </a>
        </nav>
    </div>

    <div class="p-6 mt-auto">
        <div class="bg-emerald-50/50 rounded-[2rem] p-4 flex items-center gap-3 border border-emerald-100/50">
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-emerald-600 border-2 border-white flex items-center justify-center text-white font-black text-xs shadow-sm">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-[12px] font-black text-gray-800 truncate uppercase tracking-tighter">{{ auth()->user()->name }}</p>
                <div class="flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                    <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest italic">Peminjam</p>
                </div>
            </div>
        </div>
    </div>
</aside>