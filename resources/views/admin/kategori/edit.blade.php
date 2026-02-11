<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori - SIPRAS</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        /* Mencegah scroll di body utama agar sidebar tidak ikut terangkat */
        body, html { 
            height: 100%; 
            margin: 0; 
            overflow: hidden; 
            font-family: 'Instrument Sans', sans-serif; 
            background-color: #f8fafc; 
        }

        /* Wrapper utama setinggi layar penuh */
        .main-wrapper { 
            display: flex; 
            height: 100vh; 
            width: 100%;
        }

        /* Sidebar Wrapper tetap diam di kiri */
        .sidebar-wrapper {
            height: 100vh;
            flex-shrink: 0;
            z-index: 50;
        }

        /* Area konten yang bisa di-scroll secara mandiri */
        .content-area { 
            flex: 1; 
            display: flex; 
            flex-direction: column; 
            height: 100vh; 
            overflow-y: auto; 
            min-width: 0; 
            scroll-behavior: smooth;
        }
        
        .form-input-custom {
            transition: all 0.3s ease;
        }
        .form-input-custom:focus {
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }
    </style>
</head>
<body>

<div class="main-wrapper">
    <div class="sidebar-wrapper">
        @include('partials.admin-sidebar')
    </div>

    <div class="content-area">
        @include('partials.navbar')

        <main class="p-8 lg:p-12 flex flex-col items-center justify-start">
            
            <div class="w-full max-w-xl mb-10 text-center lg:text-left">
                <div class="flex items-center gap-3 mb-2 justify-center lg:justify-start">
                    <span class="h-1 w-8 bg-blue-600 rounded-full"></span>
                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.3em]">Update Master Data</span>
                </div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Edit Kategori</h1>
                <p class="text-gray-500 font-medium mt-1">Mengubah identitas kategori <span class="text-blue-600 font-bold">"{{ $kategori->nama }}"</span>.</p>
            </div>

            <div class="w-full max-w-xl bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.03)] border border-gray-100 overflow-hidden mb-12">
                <div class="p-8 lg:p-12">
                    <form method="POST" 
                          action="{{ route('admin.kategoris.update', $kategori->id) }}" 
                          class="form-confirm space-y-8" 
                          data-message="Yakin ingin memperbarui kategori ini?">
                        @csrf
                        @method('PUT')

                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-gray-700 ml-1 uppercase tracking-[0.2em]">Nama Kategori Baru</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </span>
                                <input type="text" name="nama" value="{{ $kategori->nama }}" required 
                                    class="form-input-custom w-full pl-12 pr-4 py-5 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-blue-500 focus:bg-white transition-all font-bold text-gray-800 text-lg">
                            </div>
                        </div>

                        <div class="pt-4 flex flex-col gap-3">
                            <button type="submit" 
                                class="w-full py-5 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl shadow-xl shadow-blue-100 transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest text-xs">
                                Perbarui Kategori
                            </button>
                            <a href="{{ route('admin.kategoris.index') }}" 
                               class="w-full py-4 bg-white hover:bg-gray-50 text-gray-500 font-bold rounded-2xl text-center transition-all uppercase tracking-widest text-[10px] border border-gray-100">
                                Batal & Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-4 flex items-center gap-3 text-gray-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-[11px] font-bold uppercase tracking-widest text-center">Perubahan ini akan berdampak pada semua alat yang terhubung.</p>
            </div>
        </main>
    </div>
</div>

@include('partials.admin-scripts')
</body>
</html>