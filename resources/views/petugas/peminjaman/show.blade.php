<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peminjaman #{{ $peminjaman->id }} - SIPRAS</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

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

        /* Sidebar tetap diam di kiri */
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
        
        .status-badge {
            padding: 4px 12px;
            border-radius: 99px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
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
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
                <div>
                    <div class="flex items-center gap-3 mb-2 text-indigo-600">
                        <span class="h-1 w-8 bg-indigo-600 rounded-full"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em]">Transaction Detail</span>
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Peminjaman #{{ $peminjaman->id }}</h1>
                </div>
                
                <a href="{{ route('petugas.peminjaman.index') }}" class="flex items-center gap-2 px-6 py-3 bg-white border border-gray-200 text-gray-500 font-bold rounded-2xl hover:bg-gray-50 transition-all text-sm w-fit shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Kembali ke Daftar
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
                        <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 italic underline underline-offset-8 decoration-indigo-100">Informasi Peminjam</h3>
                        
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-sm">
                                {{ substr($peminjaman->user->name ?? '?', 0, 2) }}
                            </div>
                            <div>
                                <p class="text-sm font-black text-gray-900">{{ $peminjaman->user->name ?? '-' }}</p>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight">{{ $peminjaman->user->email ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">Status Saat Ini</p>
                                @switch($peminjaman->status)
                                    @case('pending')
                                        <span class="status-badge bg-amber-50 text-amber-600">Menunggu Persetujuan</span>
                                        @break
                                    @case('disetujui')
                                        <span class="status-badge bg-indigo-50 text-indigo-600">Sedang Dipinjam</span>
                                        @break
                                    @case('selesai')
                                        <span class="status-badge bg-green-50 text-green-600">Selesai Kembali</span>
                                        @break
                                    @default
                                        <span class="status-badge bg-red-50 text-red-600">{{ $peminjaman->status }}</span>
                                @endswitch
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Tgl Pinjam</p>
                                    <p class="text-xs font-bold text-gray-800">{{ $peminjaman->tanggal_pinjam }}</p>
                                </div>
                                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Tgl Kembali</p>
                                    <p class="text-xs font-bold text-gray-800">{{ $peminjaman->tanggal_kembali }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
                        <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 italic underline underline-offset-8 decoration-indigo-100">Daftar Alat Sapras</h3>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-b border-gray-50">
                                        <th class="pb-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Alat</th>
                                        <th class="pb-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Jumlah</th>
                                        <th class="pb-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Stok Gudang</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach($peminjaman->alats as $alat)
                                    <tr>
                                        <td class="py-5">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl overflow-hidden bg-gray-50 border border-gray-100">
                                                    @if($alat->gambar)
                                                        <img src="{{ asset('storage/' . $alat->gambar) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full flex items-center justify-center text-[10px] font-black text-gray-200 uppercase">{{ substr($alat->nama, 0, 1) }}</div>
                                                    @endif
                                                </div>
                                                <span class="text-sm font-bold text-gray-900 tracking-tight">{{ $alat->nama }}</span>
                                            </div>
                                        </td>
                                        <td class="py-5 text-center">
                                            <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-black">{{ $alat->pivot->jumlah }}</span>
                                        </td>
                                        <td class="py-5 text-right">
                                            <span class="text-[10px] font-bold {{ $alat->stok_tersedia >= $alat->pivot->jumlah ? 'text-green-500' : 'text-red-500' }}">
                                                Tersedia: {{ $alat->stok_tersedia }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($peminjaman->status === 'pending')
                        <div class="mt-10 flex flex-col sm:flex-row gap-3">
                            <form action="{{ route('petugas.peminjaman.updateStatus', $peminjaman->id) }}" method="POST" class="flex-1">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="disetujui">
                                <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl transition-all shadow-lg shadow-indigo-100 uppercase tracking-widest text-[10px]">
                                    Setujui Peminjaman
                                </button>
                            </form>
                            
                            <form action="{{ route('petugas.peminjaman.updateStatus', $peminjaman->id) }}" method="POST" class="flex-1">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="ditolak">
                                <button type="submit" class="w-full py-4 bg-white border border-red-100 hover:bg-red-50 text-red-500 font-black rounded-2xl transition-all uppercase tracking-widest text-[10px]">
                                    Tolak Pengajuan
                                </button>
                            </form>
                        </div>
                        @elseif($peminjaman->status === 'disetujui')
                            <div class="mt-10">
                                <a href="{{ route('petugas.pengembalian.create', $peminjaman->id) }}" class="flex items-center justify-center w-full py-4 bg-orange-500 hover:bg-orange-600 text-white font-black rounded-2xl transition-all shadow-lg shadow-orange-100 uppercase tracking-widest text-[10px]">
                                    Proses Pengembalian Alat
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <p class="text-center text-gray-300 text-[10px] mt-12 font-bold uppercase tracking-widest">
                SIPRAS Traffic Control &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('petugas.partials.scripts')
</body>
</html>