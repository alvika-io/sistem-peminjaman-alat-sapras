<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengembalian - SIPRAS Petugas</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        /* Mencegah scroll di body utama agar sidebar tidak ikut tergulung */
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
        
        /* Table Header Sticky agar judul kolom tetap terlihat saat scroll */
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
        @include('petugas.partials.sidebar')
    </div>

    <div class="content-area">
        @include('petugas.partials.navbar')

        <main class="p-8 lg:p-12">
            
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-2 text-indigo-600">
                    <span class="h-1 w-8 bg-indigo-600 rounded-full"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em]">Return Management</span>
                </div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Data Pengembalian</h1>
                <p class="text-gray-500 font-medium mt-1">Pantau riwayat pengembalian alat, kondisi barang, dan pelunasan denda.</p>
            </div>

            @if (session('success'))
                <div class="mb-8 p-4 bg-green-50 border-l-4 border-green-500 rounded-2xl flex items-center gap-3 animate-pulse shadow-sm">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-sm font-bold text-green-700">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(79,70,229,0.02)] border border-gray-100 overflow-hidden">
                <div class="p-8 overflow-x-auto">
                    <table class="w-full text-left sipras-table datatable">
                        <thead>
                            <tr>
                                <th class="w-12 text-center">No</th>
                                <th>Peminjam</th>
                                <th>Tgl Kembali</th>
                                <th>Kondisi</th>
                                <th>Denda</th>
                                <th class="text-center">Status Denda</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium text-gray-600">
                            @forelse ($pengembalians as $pengembalian)
                            <tr>
                                <td class="py-5 text-center font-bold text-gray-400">{{ $loop->iteration }}</td>
                                <td class="py-5">
                                    <span class="text-gray-900 font-bold tracking-tight">{{ $pengembalian->peminjaman->user->name }}</span>
                                </td>
                                <td class="py-5 font-mono text-xs">{{ $pengembalian->tanggal_kembali_real }}</td>
                                <td class="py-5">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-[10px] font-black uppercase tracking-widest">
                                        {{ $pengembalian->kondisi }}
                                    </span>
                                </td>
                                
                                <td class="py-5">
                                    <span class="font-black {{ $pengembalian->denda > 0 ? 'text-red-600' : 'text-gray-400' }}">
                                        @if ($pengembalian->denda > 0)
                                            Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </td>

                                <td class="py-5 text-center">
                                    @if ($pengembalian->denda <= 0)
                                        <span class="px-3 py-1 bg-slate-50 text-slate-400 border border-slate-100 rounded-lg text-[10px] font-black uppercase tracking-widest italic">Nihil</span>
                                    @elseif ($pengembalian->denda_status === 'belum_dibayar')
                                        <span class="px-3 py-1 bg-red-50 text-red-600 border border-red-100 rounded-lg text-[10px] font-black uppercase tracking-widest italic animate-pulse">Belum Bayar</span>
                                    @elseif ($pengembalian->denda_status === 'lunas')
                                        <span class="px-3 py-1 bg-green-50 text-green-600 border border-green-100 rounded-lg text-[10px] font-black uppercase tracking-widest italic">Lunas</span>
                                    @endif
                                </td>

                                <td class="py-5">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('petugas.pengembalian.show', $pengembalian->id) }}"
                                           class="px-4 py-2 bg-gray-50 text-gray-500 hover:bg-indigo-600 hover:text-white rounded-xl font-bold text-[11px] transition-all uppercase tracking-tighter border border-gray-100 shadow-sm">
                                            Detail
                                        </a>

                                        @if ($pengembalian->denda > 0 && $pengembalian->denda_status === 'belum_dibayar')
                                            <form action="{{ route('petugas.pengembalian.updateStatusDenda', $pengembalian->id) }}"
                                                  method="POST" class="inline-block"
                                                  onsubmit="return confirm('Yakin denda sudah dibayar?')">
                                                @csrf @method('PUT')
                                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white hover:bg-indigo-700 rounded-xl font-bold text-[11px] transition-all shadow-md shadow-indigo-100 uppercase tracking-tighter">
                                                    Bayar Denda
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-20 text-center text-gray-300 font-bold uppercase tracking-widest italic">
                                    Belum ada data pengembalian
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <p class="text-center text-gray-300 text-[10px] mt-12 font-bold uppercase tracking-widest">
                SIPRAS Audit & Return System &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('petugas.partials.scripts')
</body>
</html>