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
            background-color: #f8fafc; 
            margin: 0;
        }
        /* Layout Wrapper */
        .main-wrapper {
            display: flex;
            min-height: 100vh;
        }
        .content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        /* Efek Kartu */
        .dashboard-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.05);
        }
    </style>
</head>
<body>

<div class="main-wrapper flex">
    @include('partials.admin-sidebar')

    <div class="content-area flex-1 flex flex-col h-screen overflow-hidden">
        @include('partials.navbar')

        <div class="content flex-1 overflow-y-auto p-8 lg:p-12">
            
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-2">
                    <span class="h-1 w-8 bg-blue-600 rounded-full"></span>
                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.3em]">Ringkasan Data</span>
                </div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Dashboard Admin</h1>
                <p class="text-gray-500 font-medium mt-1">Selamat datang kembali, <span class="text-blue-600 font-bold">{{ auth()->user()->name }}</span>.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <div class="dashboard-card bg-white p-6 rounded-[2.5rem] border border-gray-100 shadow-sm flex flex-col gap-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 11m8 4V5M4 11v10l8 4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Alat</p>
                        <h2 class="text-3xl font-black text-gray-900 tracking-tighter">{{ number_format($totalAlat) }} <span class="text-sm text-gray-300 font-medium italic">Unit</span></h2>
                    </div>
                </div>

                <div class="dashboard-card bg-white p-6 rounded-[2.5rem] border border-gray-100 shadow-sm flex flex-col gap-4">
                    <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-1">Alat Dipinjam</p>
                        <h2 class="text-3xl font-black text-gray-900 tracking-tighter">{{ number_format($alatDipinjam) }} <span class="text-sm text-gray-300 font-medium italic">Unit</span></h2>
                    </div>
                </div>

                <div class="dashboard-card bg-white p-6 rounded-[2.5rem] border border-gray-100 shadow-sm flex flex-col gap-4">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-1">Peminjam Aktif</p>
                        <h2 class="text-3xl font-black text-gray-900 tracking-tighter">{{ number_format($peminjamAktif) }} <span class="text-sm text-gray-300 font-medium italic">Orang</span></h2>
                    </div>
                </div>

                <div class="dashboard-card bg-white p-6 rounded-[2.5rem] border border-gray-100 shadow-sm flex flex-col gap-4">
                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest mb-1">Petugas</p>
                        <h2 class="text-3xl font-black text-gray-900 tracking-tighter">{{ number_format($totalPetugas) }} <span class="text-sm text-gray-300 font-medium italic">User</span></h2>
                    </div>
                </div>

            </div>

            <div class="mt-12 pt-8 border-t border-gray-100">
                <p class="text-center text-gray-300 text-[10px] font-bold uppercase tracking-widest underline decoration-blue-100 underline-offset-4">
                    &copy; 2026 SIPRAS - Management Sarana & Prasarana
                </p>
            </div>
        </div>
    </div>
</div>

</body>
</html>