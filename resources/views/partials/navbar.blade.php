<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

<nav class="bg-white/90 backdrop-blur-md border-b border-gray-100 sticky top-0 z-40 w-full px-8 py-5">
    <div class="flex items-center justify-between">
        
        <div class="flex items-center gap-5">
            <div class="lg:hidden bg-blue-600 p-2.5 rounded-2xl shadow-lg shadow-blue-100 cursor-pointer active:scale-90 transition-all">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </div>
            
            <div class="hidden sm:block">
                <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.3em] leading-none mb-1">Sistem Peminjaman</p>
                <h1 class="text-lg font-black text-gray-800 tracking-tighter">Sarana & Prasarana <span class="text-blue-600">SIPRAS</span></h1>
            </div>
        </div>

        <div class="flex items-center gap-2">
            
            <div class="hidden md:flex flex-col items-end px-6 border-r border-gray-100 transition-all">
                <span class="text-sm font-black text-gray-900 leading-tight">
                    {{ auth()->user()->name }}
                </span>
                <div class="flex items-center gap-1.5 mt-0.5">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-extrabold text-blue-600 uppercase tracking-widest">
                        {{ auth()->user()->role }}
                    </span>
                </div>
            </div>

            <div class="pl-2">
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" 
                        class="group flex items-center gap-3 px-6 py-2.5 bg-white border border-gray-100 text-gray-500 hover:text-red-600 hover:border-red-100 hover:bg-red-50 rounded-2xl font-bold text-sm transition-all duration-300 shadow-sm active:scale-95">
                        <span class="tracking-wide">Keluar</span>
                        <div class="p-1 bg-gray-100 group-hover:bg-red-600 group-hover:text-white rounded-lg transition-all duration-300 shadow-inner">
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

<style>
    nav { font-family: 'Instrument Sans', sans-serif; }
</style>