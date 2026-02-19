<nav class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border-b border-gray-100 dark:border-slate-800 sticky top-0 z-40 w-full px-8 py-5 transition-colors duration-300">
    <div class="flex items-center justify-between">
        
        <div class="flex items-center gap-5">
            <div class="lg:hidden bg-blue-600 p-2.5 rounded-2xl shadow-lg shadow-blue-100 cursor-pointer active:scale-90 transition-all">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </div>
            
            <div class="hidden sm:block">
                <p class="text-[10px] font-black text-blue-600 dark:text-blue-400 uppercase tracking-[0.3em] leading-none mb-1">Sistem Peminjaman</p>
                <h1 class="text-lg font-black text-gray-800 dark:text-slate-100 tracking-tighter">Sarana & Prasarana <span class="text-blue-600 dark:text-blue-400">SIPRAS</span></h1>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button onclick="toggleDarkMode()" class="p-2.5 bg-gray-50 dark:bg-slate-800 text-gray-500 dark:text-slate-400 rounded-2xl border border-gray-100 dark:border-slate-700 hover:text-blue-600 transition-all duration-300 shadow-sm active:scale-90">
                <svg id="sun-icon" class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.95 16.95l.707.707M7.757 7.757l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/></svg>
                <svg id="moon-icon" class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            </button>
            
            <div class="hidden md:flex flex-col items-end px-6 border-r border-gray-100 dark:border-slate-800 transition-all">
                <span class="text-sm font-black text-gray-900 dark:text-slate-100 leading-tight">
                    {{ auth()->user()->name }}
                </span>
                <div class="flex items-center gap-1.5 mt-0.5">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-extrabold text-blue-600 dark:text-blue-400 uppercase tracking-widest">
                        {{ auth()->user()->role }}
                    </span>
                </div>
            </div>

            <div class="pl-2">
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" 
                        class="group flex items-center gap-3 px-6 py-2.5 bg-white dark:bg-slate-800 border border-gray-100 dark:border-slate-700 text-gray-500 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-400 hover:border-red-100 dark:hover:border-red-900/30 hover:bg-red-50 dark:hover:bg-red-900/10 rounded-2xl font-bold text-sm transition-all duration-300 shadow-sm active:scale-95">
                        <span class="tracking-wide">Keluar</span>
                        <div class="p-1 bg-gray-100 dark:bg-slate-700 group-hover:bg-red-600 group-hover:text-white rounded-lg transition-all duration-300 shadow-inner">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</nav>

<script>
    // Inisialisasi Dark Mode dari LocalStorage
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    function toggleDarkMode() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
        } else {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
        }
    }
</script>