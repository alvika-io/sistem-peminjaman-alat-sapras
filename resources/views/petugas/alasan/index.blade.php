<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Alasan Penolakan - SIPRAS</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <style>
        body, html { 
            height: 100%; margin: 0; overflow: hidden; 
            font-family: 'Instrument Sans', sans-serif; 
            background-color: #f8fafc; 
        }
        .main-wrapper { display: flex; height: 100vh; width: 100%; }
        .sidebar-wrapper { height: 100vh; flex-shrink: 0; z-index: 50; }
        .content-area { flex: 1; display: flex; flex-direction: column; height: 100vh; overflow-y: auto; }
        
        /* Input focus warna Indigo sesuai tema Petugas */
        .form-input-custom { transition: all 0.3s ease; border: 1px solid #f1f5f9; }
        .form-input-custom:focus { border-color: #4f46e5; box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }
        
        .sipras-table thead th {
            background-color: #f1f5f9;
            color: #64748b;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            font-weight: 800;
            padding: 1.25rem 1rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }
    </style>
</head>
<body>

<div class="main-wrapper">
    <div class="sidebar-wrapper">
        @include('petugas.partials.sidebar')
    </div>

    <div class="content-area">
        @include('petugas.partials.navbar')

        <main class="p-8 lg:p-12">
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-2 text-indigo-600">
                    <span class="h-1 w-8 bg-indigo-600 rounded-full"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em]">Staff Operations</span>
                </div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Panel Master Alasan</h1>
                <p class="text-gray-500 font-medium mt-1 text-sm">Kelola daftar alasan otomatis untuk menolak pengajuan peminjaman alat.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1">
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-[0_20px_50px_rgba(79,70,229,0.03)] border border-gray-100 sticky top-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 shadow-sm border border-indigo-100/50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                            </div>
                            <h3 class="text-xs font-black text-gray-900 uppercase tracking-widest">Tambah Alasan</h3>
                        </div>
                        
                        <form action="{{ route('petugas.alasan-penolakan.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Deskripsi Alasan</label>
                                <textarea name="alasan" rows="4" required placeholder="Contoh: Stok alat saat ini sedang tidak tersedia..."
                                    class="form-input-custom w-full px-5 py-4 bg-gray-50 rounded-3xl outline-none font-bold text-gray-800 text-sm resize-none"></textarea>
                                @error('alasan')
                                    <p class="text-[10px] text-red-500 font-bold mt-1 ml-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="w-full py-5 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-3xl uppercase tracking-widest text-[10px] transition-all shadow-xl shadow-indigo-100 transform hover:-translate-y-1 active:scale-95">
                                Simpan Ke Daftar
                            </button>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.02)] border border-gray-100 overflow-hidden">
                        <div class="p-4 lg:p-8">
                            <table class="w-full text-left sipras-table">
                                <thead>
                                    <tr>
                                        <th class="px-8 py-6">Daftar Alasan Penolakan</th>
                                        <th class="px-8 py-6 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50 text-sm">
                                    @forelse($alasans as $alasan)
                                        <tr class="group hover:bg-indigo-50/20 transition-colors">
                                            <td class="px-8 py-6">
                                                <div class="flex items-start gap-4">
                                                    <div class="w-2 h-2 bg-indigo-400 rounded-full mt-2 flex-shrink-0 shadow-sm shadow-indigo-200"></div>
                                                    <span class="font-bold text-gray-700 leading-relaxed">{{ $alasan->alasan }}</span>
                                                </div>
                                            </td>
                                            <td class="px-8 py-6 text-right text-nowrap">
                                                <form action="{{ route('petugas.alasan-penolakan.destroy', $alasan->id) }}" method="POST" class="form-delete-alasan inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-3 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-2xl transition-all">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="px-8 py-24 text-center">
                                                <div class="w-20 h-20 bg-gray-50 rounded-[2rem] flex items-center justify-center mx-auto mb-6">
                                                    <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                                                </div>
                                                <p class="text-gray-400 font-black text-[10px] uppercase tracking-[0.2em]">Belum ada daftar alasan penolakan</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-center text-gray-300 text-[10px] mt-12 font-bold uppercase tracking-widest leading-loose">
                SIPRAS Staff Portal &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('petugas.partials.scripts')

<script>
    $(document).on('submit', '.form-delete-alasan', function(e) {
        e.preventDefault();
        let form = this;
        
        Swal.fire({
            title: 'Hapus Alasan?',
            text: "Alasan ini tidak akan muncul lagi di pilihan petugas saat menolak.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#ef4444',
            customClass: {
                popup: 'sipras-swal-popup',
                confirmButton: 'sipras-swal-confirm',
                cancelButton: 'sipras-swal-cancel'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>

</body>
</html>