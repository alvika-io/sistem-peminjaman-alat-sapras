<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, Indonesian">
    <title>Peminjaman Saya - SIPRAS</title>
    
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

        /* Wrapper utama setinggi layar monitor */
        .main-wrapper { 
            display: flex; 
            height: 100vh; 
            width: 100%;
        }

        /* Sidebar Wrapper tetap diam di posisi kiri */
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
        
        /* Custom Table Styling */
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
        .sipras-table tbody tr { transition: all 0.2s; border-bottom: 1px solid #f1f5f9; }
        .sipras-table tbody tr:hover { background-color: #f8fafc; }
    </style>
</head>
<body>

<div class="main-wrapper">
    <div class="sidebar-wrapper">
        @include('peminjam.partials.sidebar')
    </div>

    <div class="content-area">
        @include('peminjam.partials.navbar')

        <main class="p-8 lg:p-12">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
                <div>
                    <div class="flex items-center gap-3 mb-2 text-emerald-600">
                        <span class="h-1 w-8 bg-emerald-600 rounded-full"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em]">Personal Records</span>
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Riwayat Peminjaman</h1>
                    <p class="text-gray-500 font-medium mt-1">Pantau status pengajuan dan pengembalian alat Anda.</p>
                </div>

                <a href="{{ route('peminjam.peminjaman.create') }}" 
                   class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black rounded-2xl shadow-xl shadow-emerald-100 transition-all transform hover:-translate-y-1 active:scale-95 text-sm uppercase tracking-widest">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                    <span>Ajukan Pinjaman</span>
                </a>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(16,185,129,0.02)] border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto p-4 lg:p-8">
                    <table class="w-full text-left sipras-table datatable">
                        <thead>
                            <tr>
                                <th class="w-12 text-center">No</th>
                                <th>Jadwal Peminjaman</th>
                                <th>Alat yang Dipinjam</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Denda</th>
                                <th class="text-center">Status Denda</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium text-gray-600">
                            @forelse ($peminjamans as $peminjaman)
                            <tr>
                                <td class="py-5 text-center font-bold text-gray-400">{{ $loop->iteration }}</td>
                                <td class="py-5">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-bold text-gray-400 uppercase">Pinjam:</span>
                                            <span class="font-mono text-xs text-gray-800">{{ $peminjaman->tanggal_pinjam }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-bold text-gray-400 uppercase">Kembali:</span>
                                            <span class="font-mono text-xs text-emerald-600">{{ $peminjaman->tanggal_kembali }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($peminjaman->alats as $alat)
                                            <span class="bg-gray-50 border border-gray-100 text-gray-600 px-3 py-1 rounded-lg text-[10px] font-bold">
                                                {{ $alat->nama }} <span class="text-emerald-500 font-black ml-1">({{ $alat->pivot->jumlah }})</span>
                                            </span>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="py-5 text-center">
                                    @switch($peminjaman->status)
                                        @case('pending')
                                            <span class="px-3 py-1.5 bg-amber-50 text-amber-600 border border-amber-100 rounded-xl text-[10px] font-black uppercase tracking-widest italic animate-pulse">Menunggu</span>
                                            @break
                                        @case('disetujui')
                                            <span class="px-3 py-1.5 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-xl text-[10px] font-black uppercase tracking-widest italic">Dipinjam</span>
                                            @break
                                        @case('selesai')
                                            <span class="px-3 py-1.5 bg-gray-100 text-gray-400 border border-gray-200 rounded-xl text-[10px] font-black uppercase tracking-widest italic">Dikembalikan</span>
                                            @break
                                        @case('ditolak')
                                            <span class="px-3 py-1.5 bg-red-50 text-red-600 border border-red-100 rounded-xl text-[10px] font-black uppercase tracking-widest italic">Ditolak</span>
                                            @break
                                        @default
                                            <span class="text-gray-300">-</span>
                                    @endswitch
                                </td>

                                <td class="py-5 text-center font-black">
                                    @if ($peminjaman->status === 'ditolak')
                                        <span class="text-gray-300 line-through">N/A</span>
                                    @elseif ($peminjaman->pengembalian && $peminjaman->pengembalian->denda > 0)
                                        <span class="text-red-500">Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-gray-300">-</span>
                                    @endif
                                </td>

                                <td class="py-5 text-center">
                                    @if ($peminjaman->status === 'ditolak')
                                        <span class="text-gray-300 text-[10px] font-bold uppercase italic">Batal</span>
                                    @elseif ($peminjaman->pengembalian)
                                        @if ($peminjaman->pengembalian->denda_status === 'lunas')
                                            <span class="inline-flex items-center gap-1.5 text-green-500 font-black text-[10px] uppercase tracking-tighter">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                                Lunas
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 text-red-500 font-black text-[10px] uppercase tracking-tighter">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 001.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                                Belum Bayar
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-gray-300 text-[10px] font-bold uppercase italic">Aktif</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-20 text-center">
                                    <div class="opacity-20 flex flex-col items-center">
                                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                        <p class="text-xs font-black uppercase tracking-widest italic">Belum ada aktivitas peminjaman</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8 p-6 bg-emerald-50 rounded-[2rem] border border-emerald-100 flex items-center gap-4">
                <div class="bg-white p-2 rounded-xl text-emerald-600 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-[11px] font-bold text-emerald-800 uppercase tracking-wide leading-relaxed">
                    Pengembalian alat hanya bisa diproses oleh petugas. Pastikan membawa alat ke ruang sapras tepat waktu.
                </p>
            </div>

            <p class="text-center text-gray-300 text-[10px] mt-12 font-bold uppercase tracking-widest">
                SIPRAS Member Portal &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('peminjam.partials.scripts')

</body>
</html>