<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Alat - SIPRAS</title>
    
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
        
        /* Custom File Input */
        input[type="file"]::file-selector-button {
            background-color: #eff6ff;
            color: #2563eb;
            font-weight: 700;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.75rem;
            margin-right: 1rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        input[type="file"]::file-selector-button:hover {
            background-color: #2563eb;
            color: white;
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

        <main class="p-8 lg:p-12 flex flex-col items-center">
            
            <div class="w-full max-w-4xl mb-10">
                <div class="flex items-center gap-3 mb-2 justify-center lg:justify-start text-blue-600">
                    <span class="h-1 w-8 bg-blue-600 rounded-full"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em]">Update Inventaris</span>
                </div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tighter text-center lg:text-left">Edit Alat</h1>
                <p class="text-gray-500 font-medium mt-1 text-center lg:text-left">Memperbarui informasi dan spesifikasi barang inventaris <span class="text-blue-600 font-bold">#AL-{{ $alat->id }}</span>.</p>
            </div>

            <div class="w-full max-w-4xl bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.03)] border border-gray-100 overflow-hidden mb-12">
                <div class="p-8 lg:p-12">
                    <form method="POST" 
                          action="{{ route('admin.alats.update', $alat->id) }}" 
                          class="form-confirm space-y-8" 
                          enctype="multipart/form-data"
                          data-message="Yakin ingin memperbarui data alat ini?">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-700 ml-1 uppercase tracking-widest">Nama Alat</label>
                                    <input type="text" name="nama" value="{{ $alat->nama }}" required 
                                        class="form-input-custom w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-blue-500 focus:bg-white transition-all font-bold text-gray-800">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-700 ml-1 uppercase tracking-widest">Kategori Alat</label>
                                    <div class="relative">
                                        <select name="kategori_id" required 
                                            class="form-input-custom w-full pl-5 pr-10 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-blue-500 focus:bg-white transition-all font-bold text-gray-800 appearance-none cursor-pointer">
                                            @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}" {{ $alat->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                                            @endforeach
                                        </select>
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-700 ml-1 uppercase tracking-widest">Stok Total</label>
                                    <input type="number" name="stok_total" min="0" value="{{ $alat->stok_total }}" required 
                                        class="form-input-custom w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-blue-500 focus:bg-white transition-all font-bold text-gray-800">
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div class="space-y-4">
                                    <label class="text-[10px] font-black text-gray-700 ml-1 uppercase tracking-widest">Foto Alat</label>
                                    
                                    <div class="flex flex-col items-center gap-4 p-6 bg-gray-50 border border-gray-100 rounded-[2rem]">
                                        <p class="text-[9px] font-black text-blue-600 uppercase tracking-widest">Preview Saat Ini</p>
                                        @if($alat->gambar)
                                            <img src="{{ asset('storage/'.$alat->gambar) }}" alt="{{ $alat->nama }}" 
                                                 class="w-40 h-40 object-cover rounded-2xl shadow-md border-4 border-white">
                                        @else
                                            <div class="w-40 h-40 bg-gray-200 rounded-2xl flex items-center justify-center text-gray-400 italic text-xs font-bold">
                                                No Image
                                            </div>
                                        @endif
                                        
                                        <div class="mt-2 w-full text-center">
                                            <label class="block w-full text-center py-3 bg-white border border-gray-200 rounded-xl text-[11px] font-bold text-gray-500 cursor-pointer hover:bg-gray-100 transition-all">
                                                <span>Ganti Gambar</span>
                                                <input type="file" name="gambar" accept="image/*" class="hidden">
                                            </label>
                                            <p class="text-[8px] text-gray-400 mt-2 italic">*Biarkan kosong jika tidak ingin mengubah foto</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-8 flex flex-col sm:flex-row gap-4 border-t border-gray-50">
                            <button type="submit" 
                                class="flex-1 py-5 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl shadow-xl shadow-blue-100 transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest text-xs">
                                Perbarui Data Alat
                            </button>
                            <a href="{{ route('admin.alats.index') }}" 
                               class="flex-1 py-5 bg-white hover:bg-gray-50 text-gray-400 font-bold rounded-2xl text-center transition-all uppercase tracking-widest text-xs border border-gray-100">
                                Batalkan
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center text-gray-300 text-[10px] mt-4 font-bold uppercase tracking-widest leading-loose">
                System Registry Updated &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('partials.admin-scripts')
</body>
</html>