<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Alat - SIPRAS</title>
    
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
        
        /* Custom File Input Styling */
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
            
            <div class="w-full max-w-3xl mb-10">
                <div class="flex items-center gap-3 mb-2 justify-center lg:justify-start">
                    <span class="h-1 w-8 bg-blue-600 rounded-full"></span>
                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.3em]">Inventaris Baru</span>
                </div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tighter text-center lg:text-left">Tambah Alat</h1>
                <p class="text-gray-500 font-medium mt-1 text-center lg:text-left">Masukkan detail spesifikasi alat untuk didaftarkan ke sistem.</p>
            </div>

            <div class="w-full max-w-3xl bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.03)] border border-gray-100 overflow-hidden mb-12">
                <div class="p-8 lg:p-12">
                    <form method="POST" 
                          action="{{ route('admin.alats.store') }}" 
                          class="form-confirm space-y-8" 
                          enctype="multipart/form-data"
                          data-message="Yakin ingin menambahkan alat ini?">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-700 ml-1 uppercase tracking-widest">Nama Alat</label>
                                    <input type="text" name="nama" required 
                                        class="form-input-custom w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-blue-500 focus:bg-white transition-all font-bold text-gray-800 placeholder:text-gray-300"
                                        placeholder="Contoh: Proyektor Epson EB-X100">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-700 ml-1 uppercase tracking-widest">Kategori Alat</label>
                                    <div class="relative">
                                        <select name="kategori_id" required 
                                            class="form-input-custom w-full pl-5 pr-10 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-blue-500 focus:bg-white transition-all font-bold text-gray-800 appearance-none cursor-pointer">
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                            @endforeach
                                        </select>
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-700 ml-1 uppercase tracking-widest">Stok Awal</label>
                                    <input type="number" name="stok_total" min="0" required 
                                        class="form-input-custom w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-blue-500 focus:bg-white transition-all font-bold text-gray-800 placeholder:text-gray-300"
                                        placeholder="0">
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-700 ml-1 uppercase tracking-widest">Foto Produk / Alat</label>
                                    <div class="relative group">
                                        <div class="w-full h-64 bg-gray-50 border-2 border-dashed border-gray-200 rounded-[2rem] flex flex-col items-center justify-center p-2 transition-all group-hover:border-blue-300 group-hover:bg-blue-50/30 overflow-hidden relative">
                                            
                                            <img id="imagePreview" src="#" alt="Preview" class="hidden w-full h-full object-cover rounded-[1.8rem]">

                                            <div id="placeholderContent" class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-3 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <p class="text-[11px] font-bold text-gray-400 text-center uppercase tracking-tighter">Klik untuk unggah gambar alat</p>
                                            </div>

                                            <input type="file" name="gambar" id="imageInput" accept="image/*" 
                                                class="absolute inset-0 opacity-0 cursor-pointer h-full w-full z-20">
                                        </div>
                                    </div>
                                    <p class="text-[9px] text-gray-400 italic ml-2">Format: JPG, PNG, WEBP (Maks 2MB)</p>
                                </div>
                            </div>
                        </div>

                        <div class="pt-8 flex flex-col sm:flex-row gap-4 border-t border-gray-50">
                            <button type="submit" 
                                class="flex-1 py-5 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl shadow-xl shadow-blue-100 transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest text-xs">
                                Simpan Alat 
                            </button>
                            <a href="{{ route('admin.alats.index') }}" 
                               class="flex-1 py-5 bg-gray-50 hover:bg-gray-100 text-gray-500 font-bold rounded-2xl text-center transition-all uppercase tracking-widest text-xs border border-gray-100">
                                Batalkan
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center text-gray-300 text-[10px] mt-4 font-bold uppercase tracking-widest leading-loose">
                SIPRAS Inventory Management Protocol &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('partials.admin-scripts')

<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        const placeholder = document.getElementById('placeholderContent');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden'); // Tampilkan gambar
                placeholder.classList.add('hidden'); // Sembunyikan ikon default
            }

            reader.readAsDataURL(file);
        } else {
            preview.src = "#";
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }
    });
</script>

</body>
</html>