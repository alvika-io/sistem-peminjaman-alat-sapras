<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Pengembalian - SIPRAS Petugas</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        /* Mencegah scroll di body utama */
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

        /* Sidebar Wrapper tetap di posisi kiri */
        .sidebar-wrapper {
            height: 100vh;
            flex-shrink: 0;
            z-index: 50;
        }

        /* Area konten dengan scroll mandiri */
        .content-area { 
            flex: 1; 
            display: flex; 
            flex-direction: column; 
            height: 100vh; 
            overflow-y: auto; 
            min-width: 0; 
            scroll-behavior: smooth;
        }
        
        .form-input-custom { transition: all 0.3s ease; }
        .form-input-custom:focus { box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); border-color: #6366f1; }
        .readonly-input { background-color: #f1f5f9; cursor: not-allowed; color: #64748b; }

        /* Custom Flatpickr Indigo Style */
        .flatpickr-day.selected { background: #4f46e5 !important; border-color: #4f46e5 !important; }
        .flatpickr-calendar { border-radius: 1.5rem !important; border: 1px solid #e2e8f0 !important; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05) !important; }
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
            
            <div class="mb-10 text-center lg:text-left">
                <div class="flex items-center gap-3 mb-2 justify-center lg:justify-start text-indigo-600">
                    <span class="h-1 w-8 bg-indigo-600 rounded-full"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em]">Validation Process</span>
                </div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Proses Pengembalian</h1>
                <p class="text-gray-500 font-medium mt-1">Verifikasi kondisi alat dan hitung denda keterlambatan.</p>
            </div>

            <form action="{{ route('petugas.pengembalian.store') }}" method="POST" class="space-y-8">
                @csrf
                <input type="hidden" name="peminjaman_id" value="{{ $peminjaman->id }}">

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 pb-12">
                    
                    <div class="lg:col-span-5 space-y-6">
                        <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
                            <h3 class="text-xs font-black text-indigo-600 uppercase tracking-widest mb-6 border-b border-indigo-50 pb-4">Data Peminjaman</h3>
                            
                            <div class="space-y-5">
                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Peminjam</label>
                                    <input type="text" value="{{ $peminjaman->user->name }}" readonly class="w-full px-5 py-3 mt-1 rounded-xl border border-gray-100 font-bold text-gray-800 readonly-input">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Tgl Pinjam</label>
                                        <input type="text" value="{{ $peminjaman->tanggal_pinjam }}" readonly class="w-full px-5 py-3 mt-1 rounded-xl border border-gray-100 font-bold text-gray-800 readonly-input text-xs">
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Batas Kembali</label>
                                        <input type="text" value="{{ $peminjaman->tanggal_kembali }}" readonly class="w-full px-5 py-3 mt-1 rounded-xl border border-gray-100 font-bold text-gray-800 readonly-input text-xs">
                                    </div>
                                </div>

                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Alat Yang Dipinjam</label>
                                    <div class="mt-2 space-y-2">
                                        @foreach ($peminjaman->alats as $alat)
                                            <div class="flex items-center justify-between p-3 bg-indigo-50/50 rounded-xl border border-indigo-100">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-2 h-2 rounded-full bg-indigo-400"></div>
                                                    <span class="text-xs font-bold text-indigo-900">{{ $alat->nama }}</span>
                                                </div>
                                                <span class="text-[10px] font-black bg-indigo-600 text-white px-2 py-0.5 rounded-md uppercase">x{{ $alat->pivot->jumlah }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-7 space-y-6">
                        <div class="bg-white p-8 lg:p-10 rounded-[2.5rem] border border-gray-100 shadow-[0_20px_50px_rgba(79,70,229,0.03)]">
                            <h3 class="text-xs font-black text-indigo-600 uppercase tracking-widest mb-6 border-b border-indigo-50 pb-4">Form Verifikasi</h3>
                            
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-700 ml-1 uppercase tracking-widest">Tanggal Dikembalikan (Hari Ini)</label>
                                    <div class="relative">
                                        <input type="text" id="tanggal_kembali_real" name="tanggal_kembali_real" required 
                                            class="form-input-custom w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:bg-white font-bold text-gray-800 cursor-pointer">
                                        <div class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-700 ml-1 uppercase tracking-widest">Kondisi Barang</label>
                                    <div class="relative">
                                        <select name="kondisi" required 
                                            class="form-input-custom w-full pl-5 pr-10 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:bg-white font-bold text-gray-800 appearance-none cursor-pointer">
                                            <option value="baik">✅ Baik / Layak</option>
                                            <option value="rusak">⚠️ Rusak</option>
                                            <option value="hilang">❌ Hilang</option>
                                        </select>
                                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-700 ml-1 uppercase tracking-widest">Biaya Ganti Rugi / Denda Tambahan</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-5 font-bold text-gray-400">Rp</span>
                                        <input type="number" name="denda" value="0" min="0" 
                                            class="form-input-custom w-full pl-12 pr-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:bg-white font-bold text-gray-800">
                                    </div>
                                    <p class="text-[9px] text-gray-400 italic ml-2 leading-relaxed">*Gunakan kolom ini untuk denda kerusakan fisik. Denda keterlambatan akan dihitung otomatis oleh sistem.</p>
                                </div>

                                <div class="pt-6 flex flex-col sm:flex-row gap-4">
                                    <button type="submit" 
                                        class="flex-1 py-5 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl shadow-xl shadow-indigo-100 transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest text-[10px]">
                                        Konfirmasi Pengembalian
                                    </button>
                                    <a href="{{ route('petugas.peminjaman.index') }}" 
                                       class="flex-1 py-5 bg-white hover:bg-gray-50 text-gray-400 font-bold rounded-2xl text-center transition-all uppercase tracking-widest text-[10px] border border-gray-100">
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
            <p class="text-center text-gray-300 text-[10px] mt-4 font-bold uppercase tracking-widest">
                SIPRAS Traffic Control &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('petugas.partials.scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script> 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#tanggal_kembali_real", {
            locale: "id",
            altInput: true,
            altFormat: "d F Y",
            dateFormat: "Y-m-d",
            defaultDate: "today", // Otomatis isi tanggal hari ini
            static: true
        });
    });
</script>
</body>
</html>